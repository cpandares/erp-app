<?php

namespace App\Http\Controllers\mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Mantenimiento;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

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
            $mantenimiento->start_at = $request->fecha_hora;
            $mantenimiento->description = $request->descripcion ?? 'N/A';
            $mantenimiento->empleado_id = $request->encargado;
            $mantenimiento->cliente_id = $request->cliente;
            $mantenimiento->value =0;
            $mantenimiento->status = $request->estado;

            if($mantenimiento->save()){
                $mantenimiento->servicios()->attach($request->servicios);
                /* save value with sum price servicios */
                $mantenimiento->value = $mantenimiento->servicios->sum('price');
                $mantenimiento->save();
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
        $formaPago = ['Efectivo', 'Tarjeta', 'Transferencia', 'Cheque'];

        return view('mantenimiento.show', compact('mantenimiento', 'formaPago'));
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
        $factura = Factura::where('mantenimiento_id', $id)->first();
        if($factura){
            return view('mantenimiento.factura', compact('mantenimiento', 'factura'));
        }
        return view('mantenimiento.factura', compact('mantenimiento'));
    }

    public function downloadPdfFactura($id)
    {
        $mantenimiento = Mantenimiento::with(['coche', 'servicios', 'empleado'])->find($id);
        $factura = Factura::where('mantenimiento_id', $id)->first();
        $pdf = PDF::loadView('mantenimiento.pdf.factura', compact('mantenimiento', 'factura'));
        $name= 'factura-' . $factura->numero_factura . '.pdf';
        /* solo abrir no descargar */
        return $pdf->stream($name);

        
    }

    public function sendFacturaByEmail($id){
        $mantenimiento = Mantenimiento::with(['coche', 'servicios', 'empleado'])->find($id);
        $factura = Factura::where('mantenimiento_id', $id)->first();
        $pdf = PDF::loadView('mantenimiento.pdf.factura', compact('mantenimiento', 'factura'));
        $name= 'factura-' . $factura->numero_factura . '.pdf';
        /* crea el directorio con los permisos */
        if (!file_exists(public_path('pdf'))) {
            mkdir(public_path('pdf'), 0777, true);
        }
        $pdf->save(public_path('pdf/' . $name));
        $path = public_path('pdf/' . $name);
        $to_name = $mantenimiento->cliente->name;
        $to_email = $mantenimiento->cliente->email;
        $data = array('name'=> $to_name, 'body' => 'Factura de mantenimiento', 'mantenimiento' => $mantenimiento);
        try {
            \Mail::send('mantenimiento.pdf.email', $data, function($message) use ($to_name, $to_email, $path) {
                $message->to('pandaresocesar@gmail.com', $to_name)
                        ->subject('Factura de mantenimiento');
                $message->attach($path);
                $message->from('pandaresocesar@gmail.com','Panda Repuestos');
            });
            return response()->json([
                'ok' => true,
                'message' => 'Factura enviada con éxito'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'message' => 'Error al enviar la factura ' . $th->getMessage()
            ]);
        }
    }


    public function showData(string $id)
    {
        $mantenimiento = Mantenimiento::with(['coche', 'servicios','empleado'])->find($id);
        return response()->json([
            'ok' => true,
            'data' => $mantenimiento
        ]);
    }

    public function updateMantenimiento(Request $request, string $id)
    {
        $mantenimiento = Mantenimiento::find($id);
        
        try {
            $mantenimiento->end_at = $request->end_at;
            $mantenimiento->status = $request->status;
            $mantenimiento->value = $request->value;
            if($mantenimiento->update()){
                return response()->json([
                    'ok' => true,
                    'message' => 'Mantenimiento actualizado con éxito'
                ]);
            }else{
                return response()->json([
                    'ok' => false,
                    'message' => 'Error al actualizar el mantenimiento ' . $mantenimiento->errors()
                ]);
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'ok' => false,
                'message' => 'Error al actualizar el mantenimiento ' . $th->getMessage()
            ]);
        }


    }

    public function reportarPago(Request $request, string $id)
    {

        $factura = new Factura();
        $mantenimiento = Mantenimiento::find($id);
        if(!$mantenimiento){
            return response()->json([
                'ok' => false,
                'message' => 'Mantenimiento no encontrado'
            ]);
        }
        if(!isset($request->payment_amount) || !isset($request->payment_date) || !isset($request->payment_method)){
            return response()->json([
                'ok' => false,
                'message' => 'Datos incompletos'
            ]);
        }
        DB::beginTransaction();
        try {
        
            $factura->mantenimiento_id = $id;
            $factura->cliente_id = $mantenimiento->cliente->id;
            $factura->empleado_id = $mantenimiento->empleado->id;
            $factura->numero_factura = rand(1000, 9999) . '-' . rand(1000, 9999);
            $factura->total = $request->payment_amount;
            $factura->estado = 'Pagado';
            $factura->fecha_pago = $request->payment_date;
            $factura->metodo_pago = $request->payment_method;
            $factura->comprobante_numero = isset($request->comprobante) ? $request->comprobante : null;
    
            if($factura->save()){
                
                $mantenimiento->status = 'Finalizado';
            }
    
            
            if($mantenimiento->update()){
                DB::commit();
                return response()->json([
                    'ok' => true,
                    'message' => 'Mantenimiento pagado con éxito'
                ]);
            }else{
                DB::rollBack();
                return response()->json([
                    'ok' => false,
                    'message' => 'Error al pagar el mantenimiento'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'ok' => false,
                'message' => 'Error al pagar el mantenimiento ' . $th->getMessage()
            ]);
        }
        
       
    }


}
