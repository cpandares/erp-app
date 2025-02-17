<?php

namespace App\Http\Controllers\todo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //

    public function index(){
        return view('todos.index');
    }
}
