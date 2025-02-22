<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'country', 'address', 'document'];

    public function coches()
    {
        return $this->hasMany(Coche::class);
    }

    public function mantenimientos()
    {
        return $this->hasManyThrough(Mantenimiento::class, Coche::class);
    }
    
}
