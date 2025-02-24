<?php

namespace App\Http\Controllers\Servicios;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $servicios = Servicio::all();
       /*  dd($servicios); */
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $input = $request->all();
        /* dd($input); */

        if(!$input['name']) {
            return response()->json([
                'ok' => false,
                'message' => 'El campo nombre es requerido'
            ]);
        }

        if(Servicio::where('name', $input['name'])->exists()) {
            return response()->json([
                'ok' => false,
                'message' => 'El nombre del servicio ya existe'
            ]);
        }

        
        if(!$input['price']) {
            return response()->json([
                'ok' => false,
                'message' => 'El campo precio es requerido'
            ]);
        }

        try {
            $newServico = new Servicio();
            $newServico->name = $input['name'];
            $newServico->description = $input['description'];
            $newServico->price = $input['price']; 
            if($newServico->save()){
                return response()->json([
                    'ok' => true,
                    'message' => 'Servicio creado correctamente'
                ]);
            }else{
                return response()->json([
                    'ok' => false,
                    'message' => 'Error al crear el servicio'
                ]);
            }           
            

        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'message' => 'Error al crear el servicio ' . $th->getMessage()
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        
        $input = $request->all();

        if(!$input['name']) {
            return response()->json([
                'ok' => false,
                'message' => 'El campo nombre es requerido'
            ]);
        }

        if(Servicio::where('name', $input['name'])->where('id', '!=', $servicio->id)->exists()) {
            return response()->json([
                'ok' => false,
                'message' => 'El nombre del servicio ya existe'
            ]);
        }

        

        if(!$input['price']) {
            return response()->json([
                'ok' => false,
                'message' => 'El campo precio es requerido'
            ]);
        }

        try {
            $servicio->name = $input['name'];
            $servicio->description = $input['description'];
            $servicio->price = $input['price']; 
            if($servicio->save()){
                return response()->json([
                    'ok' => true,
                    'message' => 'Servicio actualizado correctamente'
                ]);
            }else{
                return response()->json([
                    'ok' => false,
                    'message' => 'Error al actualizar el servicio'
                ]);
            }           
            

        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'message' => 'Error al actualizar el servicio ' . $th->getMessage()
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        if(!$servicio){
            return response()->json([
                'ok' => false,
                'message' => 'Servicio no encontrado'
            ]);
        }
        if(!$servicio->delete()){
            return response()->json([
                'ok' => false,
                'message' => 'Error al eliminar el servicio'
            ]);
        }


        try {
            return response()->json([
                'ok' => true,
                'message' => 'Servicio eliminado correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'message' => 'Error al eliminar el servicio ' . $th->getMessage()
            ]);
        }


    }
}
