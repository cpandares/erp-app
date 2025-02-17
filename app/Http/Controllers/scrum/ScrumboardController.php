<?php

namespace App\Http\Controllers\scrum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScrumboardController extends Controller
{
    //

    public function index(){
        return view('scrum.index');
    }
}
