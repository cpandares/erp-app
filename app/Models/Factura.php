<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    /* mantenimiento_id
cliente_id
empleado_id
numero_factura
total
estado
fecha_pago
metodo_pago
comprobante_numero */
    protected $fillable = [
        'mantenimiento_id',
        'cliente_id',
        'empleado_id',
        'numero_factura',
        'total',
        'estado',
        'fecha_pago',
        'metodo_pago',
        'comprobante_numero'
    ];

    public function mantenimiento()
    {
        return $this->belongsTo(Mantenimiento::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
   
}
