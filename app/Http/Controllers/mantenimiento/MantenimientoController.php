<?php

namespace App\Http\Controllers\mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Mantenimiento;
use App\Models\Servicio;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mantenimientos = Mantenimiento::with(['coche','cliente','empleado'])
                ->whereNotNull('cliente_id')
                ->orderByDesc('id')
                ->get();

       /*  dd($mantenimientos); */
        return view('mantenimiento.index', compact('mantenimientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $servicios = Servicio::select('id', 'name', 'price')->get();
        return view('mantenimiento.create',[
            'servicios' => $servicios
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'coche' => 'required|exists:coches,id',
            'fecha_ingreso' => 'required|date',
            'description' => 'nullable|string',
            'empleado_id' => 'required|exists:empleados,id',
            'servicios' => 'required|array',
            'servicios.*' => 'exists:servicios,id',
            'price' => 'required|numeric',
            'estado' => 'required|string'
        ]); */
        $mantenimiento = new Mantenimiento();
       
        
       
        try {
            $mantenimiento->coche_id = $request->coche;
            $mantenimiento->start_at = $request->fecha_ingreso;
            $mantenimiento->description = $request->descripcion ?? 'N/A';
            $mantenimiento->empleado_id = $request->encargado;
            $mantenimiento->cliente_id = $request->cliente;
            $mantenimiento->value = $request->price;
            $mantenimiento->status = $request->estado;

            if($mantenimiento->save()){
                $mantenimiento->servicios()->attach($request->servicios);
                return response()->json([
                    'ok' => true,
                    'message' => 'Mantenimiento creado con éxito'
                ]);
            }else{
                return response()->json([
                    'ok' => false,
                    'message' => 'Error al crear el mantenimiento ' . $mantenimiento->errors()
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'ok' => false,
                'message' => 'Error al crear el mantenimiento ' . $th->getMessage()
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $mantenimiento = Mantenimiento::with(['coche', 'servicios','empleado'])->find($id);
       /*  dd($mantenimiento); */

        return view('mantenimiento.show', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $mantenimiento = Mantenimiento::with(['coche', 'servicios','empleado'])->find($id);
        $servicios = Servicio::select('id', 'name', 'price')->get();
        return view('mantenimiento.edit',[
            'mantenimiento' => $mantenimiento,
            'servicios' => $servicios
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mantenimiento = Mantenimiento::find($id);
        if($mantenimiento->delete()){
            return response()->json([
                'ok' => true,
                'message' => 'Mantenimiento eliminado con éxito'
            ]);
        }else{
            return response()->json([
                'ok' => false,
                'message' => 'Error al eliminar el mantenimiento'
            ]);
        }
    }


    public function factura(string $id)
    {
        $mantenimiento = Mantenimiento::with(['coche', 'servicios','empleado'])->find($id);
        return view('mantenimiento.factura', compact('mantenimiento'));
    }


}
