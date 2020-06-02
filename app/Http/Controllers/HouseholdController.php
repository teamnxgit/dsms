<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Town;

class HouseholdController extends Controller
{
    public function index(){
        return view('cms.household.household');
    }

    public function new(){
        $data['gn_divisions'] = GnDivision::all();
        $data['towns'] = Town::all();
        return view('cms.household.new_household')->with($data);
    }
}
