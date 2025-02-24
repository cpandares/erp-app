<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'coche_id',
        'cliente_id',
        'tipo_servicio_id',
        'start_at',
        'end_at',
        'status',
        'value',
        'descripcion',
        'empleado_id'
    ];

    
    public function coche()
    {
        return $this->belongsTo(Coche::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tipoServicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    
    
}
