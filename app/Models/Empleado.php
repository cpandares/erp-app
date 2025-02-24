<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'lastname', 'email', 'phone', 'age', 'start_at', 'status'];


    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }

}
