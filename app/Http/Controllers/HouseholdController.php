<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Household;
use App\Town;
use Redirect;
use Session;

class HouseholdController extends Controller
{
    public function index(){
        $data['households'] = Household::all();
        return view('cms.household.household')->with($data);
    }

    public function new(){
        $data['gn_divisions'] = GnDivision::all();
        return view('cms.household.new_household')->with($data);
    }

    public function essential($id){
        $data['household'] = Household::findOrFail($id);
        return view('cms.household.essentials')->with($data);
    }

    public function add(Request $request){
        $validatedData = $request->validate([
            'house_no' => 'required',
            'gn_division_id' => 'required',
            'town_id' => 'required',
            'street_id' => 'required',
            'submit'=>'required'
        ]);
        
        $house_no = $request->input('house_no');
        $street_id = $request->input('street_id');
        $gn_division_id = GnDivision::findOrFail($request->input('gn_division_id'))->id;
        $town_id = Town::findOrFail($request->input('town_id'))->id;
        $owner_nic = $request->input('owner_nic');
        $gps = $request->input('gps');

        $household = Household::where('house_no',$house_no)->where('gn_division_id',$gn_division_id)->first();

        if ($household===null) {
            $household = Household::updateOrCreate([
                "house_no"=>$house_no,
                "gn_division_id"=>$gn_division_id,
                "town_id"=>$town_id,
                "street_id"=>$street_id,
                "owner"=>$owner_nic,
                "gps"=>$gps
            ]);
            session()->flash('success', 'Household created');
        }
        else {
            session()->flash('danger', 'Household already exist');
        }
        return redirect('/household/view/essential/'. $household->id .'');
    }

    public function delete(Request $request){
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $household = Household::findOrFail($request->input('id'));
        $household->delete();
        session()->flash('success', 'Household deleted');
        return redirect::back();
    }

    public function view($id){

        $household = Household::findOrFail($id);
        /*
        $data['disasters'] = $household->disasters();
        $data['water_sources'] = HouseholdWaterSource::where('house_id',$id);
        $data['toilet_facilities'] = HouseholdToiletFacility::where('house_id',$id);
        $data['cooking_facilities'] = HouseholdCookingFacility::where('house_id',$id);
        $data['wastemanagements'] = HouseholdWasteManagement::where('house_id',$id);
        $data['notes'] = HouseholdNote::where('house_id',$id);
        */
    }
}