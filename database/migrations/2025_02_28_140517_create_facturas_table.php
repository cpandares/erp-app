<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mantenimiento_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('empleado_id');
            $table->string('numero_factura')->unique();
            $table->decimal('total', 10, 2)->nullable();
            $table->enum('estado', ['pendiente', 'pagado']);
            $table->date('fecha_pago')->nullable();
            $table->string('metodo_pago')->nullable();            
            $table->string('comprobante_numero')->nullable();
            $table->timestamps();

            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
