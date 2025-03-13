<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Coche;

class CarService
{
    public function list()
    {
        return Coche::all();
    }

    public function store(array $data)
    {
        try {
            return Coche::create($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $e->getMessage();
        }
    }

    public function update(int $id, array $data)
    {
        $car = Coche::findOrFail($id);
        $car->update($data);
        return $car;
    }

    public function destroy(int $id)
    {
        $car = Coche::findOrFail($id);
        return $car->delete();
    }

    public function show(int $id)
    {
        return Coche::findOrFail($id);
    }
}