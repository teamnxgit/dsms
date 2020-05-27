<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    public function index(){
        return view('cms.household.household');
    }

    public function new(){
        return view('cms.household.new_household');
    }
}
