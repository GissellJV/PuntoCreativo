<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            /*
             * Con cuenta: guarda el id del usuario.
             * Como invitado: guarda null.
             */
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('numero_pedido')->unique();

            /*
             * Guardamos estos datos tanto para usuarios
             * registrados como para invitados.
             */
            $table->string('nombre_cliente');
            $table->string('email_cliente');

            $table->string('estado')->default('pendiente');
            $table->string('metodo_pago')->nullable();
            $table->string('referencia_pago')->nullable();
            $table->string('cupon')->nullable();

            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('impuesto', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            $table->text('notas')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
