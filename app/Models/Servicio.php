<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'active'];

    public function mantenimientos()
    {
        return $this->belongsToMany(Mantenimiento::class, 'mantenimiento_servicio', 'servicio_id', 'mantenimiento_id');
    }
}
