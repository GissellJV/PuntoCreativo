<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Servicio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PedidoController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        /*
         * Si no hay usuario autenticado, nombre y correo
         * son obligatorios.
         */
        $esInvitado = $request->user() === null;

        $datos = $request->validate([
            'nombre_cliente' => [
                Rule::requiredIf($esInvitado),
                'nullable',
                'string',
                'max:255',
            ],

            'email_cliente' => [
                Rule::requiredIf($esInvitado),
                'nullable',
                'email',
                'max:255',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.servicio_id' => [
                'required',
                'integer',
                'exists:servicios,id',
            ],

            'items.*.cantidad' => [
                'required',
                'integer',
                'min:1',
                'max:20',
            ],

            'metodo_pago' => [
                'required',
                'string',
                'in:paypal,prueba',
            ],

            'referencia_pago' => [
                'nullable',
                'string',
                'max:255',
            ],

            'cupon' => [
                'nullable',
                'string',
                'max:50',
            ],

            'notas' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nombre_cliente.required' =>
                'Debes ingresar tu nombre.',

            'email_cliente.required' =>
                'Debes ingresar tu correo electrónico.',

            'email_cliente.email' =>
                'Ingresa un correo electrónico válido.',

            'items.required' =>
                'El carrito está vacío.',

            'items.min' =>
                'Debes agregar al menos un servicio.',

            'items.*.servicio_id.exists' =>
                'Uno de los servicios ya no está disponible.',

            'metodo_pago.required' =>
                'Selecciona un método de pago.',
        ]);

        $usuario = $request->user();

        /*
         * Si hay sesión, tomamos los datos de la cuenta.
         * Si no hay sesión, usamos los datos del formulario.
         */
        $nombreCliente = $usuario
            ? $usuario->name
            : $datos['nombre_cliente'];

        $emailCliente = $usuario
            ? $usuario->email
            : $datos['email_cliente'];

        $pedido = DB::transaction(function () use (
            $datos,
            $usuario,
            $nombreCliente,
            $emailCliente
        ) {
            $idsServicios = collect($datos['items'])
                ->pluck('servicio_id')
                ->unique();

            $servicios = Servicio::query()
                ->whereIn('id', $idsServicios)
                ->get()
                ->keyBy('id');

            $subtotal = 0;
            $detalles = [];

            foreach ($datos['items'] as $item) {
                $servicio = $servicios->get(
                    (int) $item['servicio_id']
                );

                $cantidad = (int) $item['cantidad'];
                $precio = (float) $servicio->precio;

                $subtotalDetalle = round(
                    $precio * $cantidad,
                    2
                );

                $subtotal += $subtotalDetalle;

                $detalles[] = [
                    'servicio_id' => $servicio->id,
                    'nombre_servicio' => $servicio->nombre,
                    'precio_unitario' => $precio,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotalDetalle,
                ];
            }

            $subtotal = round($subtotal, 2);

            $cupon = strtoupper(
                trim($datos['cupon'] ?? '')
            );

            $descuento = 0;

            if ($cupon === 'CREATIVO10') {
                $descuento = round(
                    $subtotal * 0.10,
                    2
                );
            }

            $baseImponible = $subtotal - $descuento;

            $impuesto = round(
                $baseImponible * 0.15,
                2
            );

            $total = round(
                $baseImponible + $impuesto,
                2
            );

            $pedido = Pedido::create([
                /*
                 * Con cuenta guarda el id.
                 * Como invitado guarda null.
                 */
                'user_id' => $usuario?->id,

                'numero_pedido' =>
                    'PC-' . strtoupper(Str::random(10)),

                'nombre_cliente' => $nombreCliente,
                'email_cliente' => $emailCliente,

                'estado' => 'pendiente',

                'metodo_pago' =>
                    $datos['metodo_pago'],

                'referencia_pago' =>
                    $datos['referencia_pago'] ?? null,

                'cupon' =>
                    $cupon !== '' ? $cupon : null,

                'subtotal' => $subtotal,
                'descuento' => $descuento,
                'impuesto' => $impuesto,
                'total' => $total,

                'notas' => $datos['notas'] ?? null,
            ]);

            $pedido->detalles()->createMany(
                $detalles
            );

            return $pedido;
        });

        /*
         * Guardamos el último pedido en la sesión para
         * mostrarlo en la confirmación, incluso al invitado.
         */
        $request->session()->put(
            'ultimo_pedido_id',
            $pedido->id
        );

        return response()->json([
            'message' => 'Pedido guardado correctamente.',

            'pedido' => [
                'id' => $pedido->id,
                'numero_pedido' =>
                    $pedido->numero_pedido,
            ],

            'redirect' => route('confirmacion'),
        ], 201);
    }
}
