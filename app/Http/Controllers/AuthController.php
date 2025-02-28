<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    /* public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    } */

    public function index(){
        $mantenimientosEnProces = Mantenimiento::where('status', 'En Proceso')->count();
        $mantenimientosPendientes = Mantenimiento::where('status', 'Pendiente')->count();
        $mantenimientosFinalizados = Mantenimiento::where('status', 'Finalizado')->count();
        $mantenimientosCancelados = Mantenimiento::where('status', 'Reproceso')->count();
        $mantenimientos = Mantenimiento::all();
        $totalMantenimientos = count($mantenimientos);

        $totalRecaudadoServiciosFinalizados = Mantenimiento::where('status', 'Finalizado')->sum('value');

        $ultimosMantenimientos = Mantenimiento::with('cliente', 'servicios')->orderBy('created_at', 'desc')->take(10)->get();

        return view('index', [
            'mantenimientos' => $mantenimientos,
            'mantenimientosEnProces' => $mantenimientosEnProces,
            'mantenimientosPendientes' => $mantenimientosPendientes,
            'mantenimientosFinalizados' => $mantenimientosFinalizados,
            'mantenimientosCancelados' => $mantenimientosCancelados,
            'totalMantenimientos' => $totalMantenimientos,
            'totalRecaudadoServiciosFinalizados' => $totalRecaudadoServiciosFinalizados,
            'ultimosMantenimientos' => $ultimosMantenimientos
        ]);
    }

    public function signup(){
        return view('auth.register');
    }

    public function signin(){
        return view('auth.login');
    }

    public function register(Request $request)
    {
       /*  dd($request->all()); */
        $validatedData = $request->all();

        if(User::where('email', $validatedData['email'])->exists()){
            return redirect()->route('register')->with(['message' => 'El correo ya se encuentra registrado']);
        }

        if(strlen($validatedData['password']) < 8){
            return redirect()->route('register')->with(['message' => 'La contraseña debe tener al menos 8 caracteres']);
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        try {
            //code...
            $token = $user->createToken('authToken')->plainTextToken;
    
            return redirect('/')->with('token', $token);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            //return response()->json(['message' => 'Invalid credentials'], 401);
            return redirect()->route('login')->with(['message' => 'Credeciales Incorrectas']);
        }

        try {
            //code...
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
    
           // return redirect('/clientes')->with('token', $token);
           return redirect('/')->with('token', $token);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Credenciales Incorrectas'], 401);
        }
      
    }

    public function logout(Request $request)
    {
        
        try {
            //code...
            
            return redirect()->route('login');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

    }
}

