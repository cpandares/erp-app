<?php

namespace App\Http\Controllers\note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    //
    public function index(){
        return view('notes.index');
    }
}
