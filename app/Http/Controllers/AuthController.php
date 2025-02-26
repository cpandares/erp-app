<?php

namespace App\Http\Controllers;

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
        return view('index');
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        /* if($validatedData->fails()){
            return response()->json(['message' => 'Validation failed'], 422);
        } */

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
            return redirect()->route('login')->with(['message' => 'Invalid credentials']);
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

