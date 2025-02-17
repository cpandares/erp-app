<?php

namespace App\Http\Controllers\contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    //

    public function index(){
        return view('contacts.index');
    }
}
