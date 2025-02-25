<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            // Crear una nueva columna de tipo JSON
            $table->json('tipo_servicios')->nullable();
        });

        // Copiar los datos de la columna antigua a la nueva columna
        DB::statement('UPDATE mantenimientos SET tipo_servicios = tipo_servicio_id');

        Schema::table('mantenimientos', function (Blueprint $table) {
            // Eliminar la restricción de clave foránea
            $table->dropForeign(['tipo_servicio_id']);

            // Eliminar la columna antigua
            $table->dropColumn('tipo_servicio_id');

            // Renombrar la nueva columna a la antigua
            $table->renameColumn('tipo_servicios', 'tipo_servicio_id');

            // Eliminar la columna 'servicios'
            $table->dropColumn('servicios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            // Crear una columna temporal para revertir los datos
            $table->string('tipo_servicios_temp')->nullable();
        });

        // Copiar los datos de la columna JSON a la columna temporal
        DB::statement('UPDATE mantenimientos SET tipo_servicios_temp = tipo_servicio_id');

        Schema::table('mantenimientos', function (Blueprint $table) {
            // Eliminar la columna JSON
            $table->dropColumn('tipo_servicio_id');

            // Renombrar la columna temporal a la antigua
            $table->renameColumn('tipo_servicios_temp', 'tipo_servicio_id');

            // Revertir la columna 'servicios'
            $table->string('servicios')->nullable();
        });
    }
};