<?php

namespace App\Http\Controllers\Empleados;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $empleado = new Empleado();
        try {
            $empleado->name = $request->name;
            $empleado->lastname = $request->lastname;
            $empleado->email = $request->email;
            $empleado->phone = $request->phone;
            $empleado->age = $request->age;
            $empleado->start_at = $request->start_at;
            $empleado->status = 1;
            if($empleado->save()) {
                return response()->json([
                    'ok' => true,
                    'message' => 'Empleado creado correctamente'
                ]);
            }else{
                return response()->json([
                    'ok' => false,
                    'message' => 'Error al crear el empleado ' . $request->all()
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'message' => 'Error al crear el empleado ' . $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $empleado = Empleado::find($id);
        if(!$empleado){
            return response()->json([
                'ok' => false,
                'message' => 'Empleado no encontrado'
            ]);
        }
        $empleado->name = $request->name ;
        $empleado->lastname = $request->lastname;
        $empleado->email = $request->email;
        $empleado->phone = $request->phone;
        $empleado->age = $request->age;
        $empleado->start_at = $request->start_at;
        $empleado->status = $request->status;
        if($empleado->save()) {
            return response()->json([
                'ok' => true,
                'message' => 'Empleado actualizado correctamente'
            ]);
        }else{
            return response()->json([
                'ok' => false,
                'message' => 'Error al actualizar el empleado'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        if(!$empleado){
            return response()->json([
                'ok' => false,
                'message' => 'Empleado no encontrado'
            ]);
        }
        if($empleado->delete()) {
            return response()->json([
                'ok' => true,
                'message' => 'Empleado eliminado correctamente'
            ]);
        }else{
            return response()->json([
                'ok' => false,
                'message' => 'Error al eliminar el empleado'
            ]);
        }
    }
}
