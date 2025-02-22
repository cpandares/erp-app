<?php

namespace App\Http\Controllers\coches;

use App\Http\Controllers\Controller;
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
        $coches = Coche::all();
       /*  dd($coches); */
        return view('coches.index', compact('coches'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
