<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Town;
use Redirect;
use Session;

class HouseholdController extends Controller
{
    public function index(){
        return view('cms.household.household');
    }

    public function new(){
        $data['gn_divisions'] = GnDivision::all();
        return view('cms.household.new_household')->with($data);
    }

    public function add(Request $request){
        $validatedData = $request->validate([
            'house_no' => 'required',
            'gn_division_id' => 'required',
            'town_id' => 'required',
            'street_id' => 'required'
        ]);
        
        $house_no = $request->input('house_no');
        $gn_division_id = GnDivision::findOrFail($request->input('gn_division_id'))->id;
        $town_id = Town::findOrFail($request->input('town_id'))->id;
        $owner_nic = $request->input('owner_nic');
        $gps = $request->input('gps');

        $houseHold = updateOrCreate([
            "house_no"=>$house_no,
            "gn_division_id"=>$gn_division_id,
            "town_id"=>$town_id,
            "street_id"=>$street_id,
            "owner"=>$owner_nic,
            "gps"=>$gps
        ]);
    }
}
