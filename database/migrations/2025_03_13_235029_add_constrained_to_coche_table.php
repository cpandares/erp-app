<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
          
            $table->dropForeign(['cliente_id']);
            $table->dropForeign(['coche_id']);

            
            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes')
                  ->onDelete('cascade');

            $table->foreign('coche_id')
                  ->references('id')
                  ->on('coches')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            // Elimina las llaves foráneas agregadas en up()
            $table->dropForeign(['cliente_id']);
            $table->dropForeign(['coche_id']);
        });
    }
};