<?php

namespace App\Http\Controllers\coches;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Coche;
use App\Models\Mantenimiento;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CochesController extends Controller
{
    protected $cocheService;
    public function __construct(CarService $cocheService) {
        $this->cocheService = $cocheService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $coches = Coche::with('cliente','images')->orderByDesc('id')->get();
        
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
        if( Coche::where('placa', $request->placa)->exists() ){
            return response()->json(['ok' => false, 'message' => 'La placa ya existe'], 400);            
        }       
      
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'marca' => 'required',
                'model' => 'required',
                'placa' => 'required',
                'color' => 'required',
                'year' => 'required',
                'cliente_id' => 'required'
            ]);
                       
           $coche = $this->cocheService->store($data);
        
            if ($request->hasFile('images')) {
                $this->uploadImage($request, $coche->id);
            }
            DB::commit();
            return response()->json(['ok' => true, 'message' => 'Coche creado correctamente'], 201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['ok' => false, 'message' => 'Error al crear el coche'], 500);
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
        $coche = Coche::find($id);
        if(!$coche){
            return response()->json(['ok' => false, 'message' => 'Coche no encontrado']);
        }
        if( Coche::where('placa', $request->placa)->where('id', '!=', $id)->exists() ){
            return response()->json(['ok' => false, 'message' => 'La placa ya existe en otro coche']);
            
        }

        try {
            $coche->marca = $request->marca;
            $coche->model = $request->model;
            $coche->placa = $request->placa;
            $coche->color = $request->color;
            $coche->year = $request->year;
            $coche->cliente_id = $request->cliente_id;

            if(isset($request->file)){
                

                $this->uploadImage($request, $id);

            }

            $coche->save();
            return response()->json(['ok' => true, 'message' => 'Coche actualizado correctamente']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['ok' => false, 'message' => 'Error al actualizar el coche']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coche = Coche::find($id);
        if(!$coche){
            return response()->json(['ok' => false, 'message' => 'Coche no encontrado']);
        }
        $mantenimiento = Mantenimiento::where('coche_id', $id)->where('status', 'En Proceso')->get();
        if(count($mantenimiento) > 0){
            return response()->json(['ok' => false, 'message' => 'No se puede eliminar el coche, tiene mantenimientos en proceso']);
        }

        try {
            DB::beginTransaction();
            /* eliminar mantenimiento */
            /* $mantenimientos = Mantenimiento::where('coche_id', $id)->get();
            foreach ($mantenimientos as $mantenimiento) {
                $mantenimiento->delete();
            } */
            /* eliminar imagenes */
            $imagenes = $coche->images;
            if(count($imagenes) > 0){
                foreach ($imagenes as $imagen) {
                    $imagen->delete();
                }
            }
                        /* eliminar coche */
            $coche->delete();
            DB::commit();
            return response()->json(['ok' => true, 'message' => 'Coche eliminado correctamente']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['ok' => false, 'message' => 'Error al eliminar el coche' . $th->getMessage()]);
        }

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

    public function uploadImage(Request $request, $id)
        {
            $coche = Coche::findOrFail($id);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    /* valida que exista el path coches sino lo crea */
                    if(!file_exists(public_path('images/coches'))){
                        mkdir(public_path('images/coches'), 0777, true);
                    }
                   
                        $name = time().'.'.$file->extension();
                        $file->move(public_path('images/coches'), $name);
                        $path = 'images/coches/'.$name;
                        $coche->images()->create(['path' => $path]);
                       
                  
                    

                   
                }
            }
            return back()->with('success', 'Imágenes subidas correctamente.');
           
        }

        public function info($id){
            $coche = Coche::find($id);
            if(!$coche){
                return response()->json(['ok' => false, 'message' => 'Coche no encontrado']);
            }
            return response()->json(['ok' => true, 'data' => $coche]);
        }

}
