<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'model',
        'placa',
        'color',
        'year',
        'cliente_id'
    ];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
