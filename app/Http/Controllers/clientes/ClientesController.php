<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Countries;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDOException;


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::orderBy('id', 'desc')->get();
        $countries = Countries::all();
        return view('clientes.index', compact('clientes', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
      /*   dd($request->all()); */
        $cliente = new Cliente();
        
        if(Cliente::where('email', $request->email)->exists()){
            return response()->json(['ok' => false, 'message' => 'El email ya existe']);
        }

        if(Cliente::where('document', $request->document)->exists()){
            return response()->json(['ok' => false, 'message' => 'El documento ya existe']);
        }


        try {
            //code...
            $phone = $request->codigo_telefono_pais . $request->phone;
            $cliente->name = $request->name;
            $cliente->lastname = $request->lastname;
            $cliente->email = $request->email;
            $cliente->phone = $phone;
            $cliente->country = $request->country;
            $cliente->city = $request->city;
            $cliente->address = $request->address;
            $cliente->document = $request->document;
            $cliente->ocuppation = $request->ocuppation;
            $cliente->save();

            return response()->json(['ok' => true, 'message' => 'Cliente creado correctamente', 'data' => $cliente]);
        } catch (ValidationException $e) {
            return response()->json(['ok' => false, 'message' => 'Error al validar los datos', 'errors' => $e->errors()]);
        } catch (\Throwable $th) {
            return response()->json(['ok' => false, 'message' => 'Error al crear el cliente']);
        }
       



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cliente = Cliente::with('coches', 'mantenimientos')->find($id);
        if(!$cliente){
            return view('clientes.index')->with('error', 'Cliente no encontrado');
        }
        foreach ($cliente->coches as $coche) {
            foreach ($coche->mantenimientos as $mantenimiento) {
                $mantenimiento->formatted_start_at = Carbon::parse($mantenimiento->start_at)->diffForHumans();
            }
        }

        return view('clientes.show', compact('cliente'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json(['ok' => false, 'message' => 'Cliente no encontrado']);
        }

        if(Cliente::where('email', $request->email)->where('id', '!=', $id)->exists()){
            return response()->json(['ok' => false, 'message' => 'El email ya existe']);
        }

        if(Cliente::where('document', $request->document)->where('id', '!=', $id)->exists()){
            return response()->json(['ok' => false, 'message' => 'El documento ya existe']);
        }

        try {
            //code...
            $phone = $request->codigo_telefono_pais . $request->phone;
            $cliente->name = $request->name;
            $cliente->email = $request->email;
            $cliente->phone = $phone;
            $cliente->country = $request->country;
            $cliente->address = $request->address;
            $cliente->document = $request->document;
            $cliente->ocuppation = $request->ocuppation;
            $cliente->city = $request->city;

            $cliente->save();

            return response()->json(['ok' => true, 'message' => 'Cliente actualizado correctamente', 'data' => $cliente]);
        } catch (ValidationException $e) {
            return response()->json(['ok' => false, 'message' => 'Error al validar los datos', 'errors' => $e->errors()]);
        } catch (\Throwable $th) {
            return response()->json(['ok' => false, 'message' => 'Error al actualizar el cliente']);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        if(!Cliente::find($id)){
            return response()->json(['ok' => false, 'message' => 'Cliente no encontrado']);
        }

        try {
            //code...
            Cliente::destroy($id);
            return response()->json(['ok' => true, 'message' => 'Cliente eliminado correctamente']);
        } catch (\Throwable $th) {
            return response()->json(['ok' => false, 'message' => 'Error al eliminar el cliente']);
        }

    }


    public function getCochesClientes (Request $request){
        $id = $request->cliente_id;
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json(['ok' => false, 'message' => 'Cliente no encontrado']);
        }

        if($cliente->coches->count() == 0){
            return response()->json(['ok' => false, 'message' => 'El cliente no tiene coches']);
        }

        return response()->json(['ok' => true, 'data' => $cliente->coches]);
    }

    public function data(Request $request, $id = null){
        $input = $request->all();
        $data = [];
        
        if(isset($id)){
          
            $cliente = Cliente::find($id);
            if(!$cliente){
                return response()->json(['ok' => false, 'message' => 'Cliente no encontrado']);
            }
            $texto = $cliente->document . ' ' . $cliente->name;
            return \Response::json(['id' => $cliente->id, 'text' => $texto, 'phone' => $cliente->phone]);
        }

        if (isset($input['search'])) {
            $keyword = strtolower($input['search']);

            $prm = str_replace(' ', '%', $keyword);
            try {
                
                $clientes = DB::table('clientes')
                   
                    ->whereRaw("LOWER(CONCAT_WS(' ', document, name)) LIKE ?", '%' .($prm) . '%')
                    
                    ->get();
            } catch (PDOException $e) {
                return response()->json(['ok' => false, 'message' => 'Error al buscar los clientes']);
            }



            foreach ($clientes as $id => $item) {

                // dd($item);
                $texto = $item->document . ' ' . $item->name ;

                if (strpos(strtolower($texto), $input['search']) !== false) {
                    $data[] = ['id' => $item->id, 'text' => ($texto), 'phone' =>$item->phone];
                }
            }


            // dd($data);
            return \Response::json(array_slice($data, 0, 1000));
        } else
            return \Response::json(null);
    }


}
