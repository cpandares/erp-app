<?php

namespace App\Http\Controllers\Empleados;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function data(Request $request)
    {
        {
            $input = $request->all();
            $data = [];
    
    
            if (isset($input['search'])) {
                $keyword = strtolower($input['search']);
    
                $prm = str_replace(' ', '%', $keyword);
                try {
                    
                    $clientes = DB::table('empleados')
                        //->whereRaw("CONCAT_WS(cliente_documento,' ',cliente_nombres,' ',cliente_apellido1,' ',cliente_apellido2) like ?", '%' . $prm . '%')
                        //->whereRaw("LOWER(CONCAT_WS(' ',cliente_documento,cliente_nombres,cliente_apellido1,cliente_apellido2) like ?", '%' . strtolower($prm) . '%)')
                        ->whereRaw("LOWER(CONCAT_WS(' ', dni, name, lastname)) LIKE ?", '%' .($prm) . '%')
                        
                        ->get();
                } catch (Exception $e) {
                    return \Response::json("error");
                }
    
    
    
                foreach ($clientes as $id => $item) {
    
                    // dd($item);
                    $texto = $item->dni . ' ' . $item->name . ' ' . $item->lastname;
    
                    if (strpos(strtolower($texto), $input['search']) !== false) {
                        $data[] = ['id' => $item->id, 'text' => ($texto)];
                    }
                }
    
    
                // dd($data);
                return \Response::json(array_slice($data, 0, 1000));
            } else
                return \Response::json(null);
        }
    }
}
