<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    // 
    public function index(){
        return view('cms.person.person');
    }

    public function new(){
        return view('cms.person.new_person');
    }
    public function essential(){
        return view('cms.person.person_essential_details');
    }

    public function occupation(){
        return view('cms.person.person_occupation_details');
    }

    public function house(){
        return view('cms.person.person_house_details');
    }

    public function disability(){
        return view('cms.person.person_disability_details');
    }
}
