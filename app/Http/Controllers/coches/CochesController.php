<?php

namespace App\Http\Controllers\coches;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Coche;
use Illuminate\Http\Request;

class CochesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $coches = Coche::with('cliente')->get();
        
        return view('coches.index', compact('coches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clientes = Cliente::select('id', 'name', 'document')->get();
        return view('coches.create',[
            'clientes' => $clientes
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $coche = new Coche();
      /*   dd($request->all()); */
        try {
            $coche->marca = $request->marca;
            $coche->model = $request->model;
            $coche->placa = $request->placa;
            $coche->color = $request->color;
            $coche->year = $request->year;
            $coche->cliente_id = $request->cliente_id;

            if(isset($request->file)){
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $name = time().'.'.$request->image->extension();
                if(!file_exists(public_path('images/coches'))){
                    mkdir(public_path('images/coches'), 0777, true);
                }
                $request->image->move(public_path('images/coches'), $name);
                $coche->image = $name;

            }


            $coche->save();
            return redirect()->route('coches.show', $coche->id)->with('success', 'Coche creado correctamente');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return redirect()->route('coches.create')->with('error', 'Error al crear el coche');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $coche = Coche::find($id);
        if(!$coche){
            return redirect()->route('coches.index')->with('error', 'Coche no encontrado');
        }
        return view('coches.show', compact('coche'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $coche = Coche::find($id);
        if(!$coche){
            return redirect()->route('coches.index')->with('error', 'Coche no encontrado');
        }
        

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
    }


    public function data(Request $request)
    {
        $coche_id = $request->coche_id;
        $coche = Coche::find($coche_id);
        if(!$coche){
            return response()->json(['ok' => false, 'message' => 'Coche no encontrado']);
        }
        return response()->json(['ok' => true, 'data' => $coche]);
        
    }

}
