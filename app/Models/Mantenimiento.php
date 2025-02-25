<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $casts = [
        'tipo_servicios' => 'array',
    ];

  

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

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'mantenimiento_servicio', 'mantenimiento_id', 'servicio_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    
    
}
