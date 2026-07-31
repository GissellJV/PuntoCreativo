<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    /**
     * Dirección de PayPal según el modo configurado.
     */
    private function baseUrl(): string
    {
        return config('services.paypal.mode') === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }

    /**
     * Obtener token OAuth de PayPal.
     */
    private function accessToken(): string
    {
        $clientId = config('services.paypal.client_id');
        $secret = config('services.paypal.secret');

        if (!$clientId || !$secret) {
            throw new \RuntimeException(
                'Las credenciales de PayPal no están configuradas.'
            );
        }

        $response = Http::asForm()
            ->withBasicAuth($clientId, $secret)
            ->post(
                $this->baseUrl() . '/v1/oauth2/token',
                [
                    'grant_type' => 'client_credentials',
                ]
            );

        if ($response->failed()) {
            Log::error(
                'No se pudo obtener el token de PayPal.',
                [
                    'status' => $response->status(),
                    'response' => $response->json(),
                ]
            );

            throw new \RuntimeException(
                'No fue posible conectar con PayPal.'
            );
        }

        return $response->json('access_token');
    }

    /**
     * Crear una orden en PayPal.
     */
    public function createOrder(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'total' => ['required', 'numeric', 'min:0.01'],
        ]);

        /*
         * PayPal no procesa HNL directamente en todas las integraciones.
         * Para Sandbox utilizaremos USD.
         *
         * Para un proyecto real debes hacer la conversión en el servidor
         * con la tasa definida por el negocio.
         */
        $totalUsd = round((float) $datos['total'], 2);

        try {
            $response = Http::withToken($this->accessToken())
                ->acceptJson()
                ->post(
                    $this->baseUrl() . '/v2/checkout/orders',
                    [
                        'intent' => 'CAPTURE',

                        'purchase_units' => [
                            [
                                'description' =>
                                    'Servicios digitales de Punto Creativo',

                                'amount' => [
                                    'currency_code' => 'USD',
                                    'value' => number_format(
                                        $totalUsd,
                                        2,
                                        '.',
                                        ''
                                    ),
                                ],
                            ],
                        ],
                    ]
                );

            if ($response->failed()) {
                Log::error(
                    'PayPal no pudo crear la orden.',
                    [
                        'status' => $response->status(),
                        'response' => $response->json(),
                    ]
                );

                return response()->json([
                    'message' =>
                        'No fue posible crear la orden en PayPal.',
                ], 422);
            }

            return response()->json([
                'id' => $response->json('id'),
            ]);
        } catch (\Throwable $error) {
            Log::error(
                'Error creando la orden de PayPal.',
                [
                    'message' => $error->getMessage(),
                ]
            );

            return response()->json([
                'message' =>
                    'Ocurrió un error al conectar con PayPal.',
            ], 500);
        }
    }

    /**
     * Capturar el pago aprobado por el cliente.
     */
    public function captureOrder(
        Request $request,
        string $orderId
    ): JsonResponse {
        try {
            $response = Http::withToken($this->accessToken())
                ->acceptJson()
                ->withBody('{}', 'application/json')
                ->post(
                    $this->baseUrl()
                    . '/v2/checkout/orders/'
                    . $orderId
                    . '/capture'
                );

            if ($response->failed()) {
                Log::error(
                    'PayPal no pudo capturar la orden.',
                    [
                        'order_id' => $orderId,
                        'status' => $response->status(),
                        'response' => $response->json(),
                    ]
                );

                return response()->json([
                    'message' =>
                        'No fue posible confirmar el pago.',
                ], 422);
            }

            $estado = $response->json('status');

            if ($estado !== 'COMPLETED') {
                return response()->json([
                    'message' =>
                        'El pago todavía no está completado.',
                    'status' => $estado,
                ], 422);
            }

            return response()->json([
                'success' => true,
                'order' => $response->json(),
            ]);
        } catch (\Throwable $error) {
            Log::error(
                'Error capturando el pago de PayPal.',
                [
                    'order_id' => $orderId,
                    'message' => $error->getMessage(),
                ]
            );

            return response()->json([
                'message' =>
                    'Ocurrió un error al confirmar el pago.',
            ], 500);
        }
    }
}
