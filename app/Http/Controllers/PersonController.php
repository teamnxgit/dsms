<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    // 
    public function index(){
        return view('cms.person.person');
    }
}
