<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Household;
use App\Town;
use App\FacilityType;
use App\Facility;
use Redirect;
use Session;

class HouseholdController extends Controller
{
    public function index(){
        $data['households'] = Household::all();
        return view('cms.household.households')->with($data);
    }

    public function new(){
        $data['gn_divisions'] = GnDivision::all();
        return view('cms.household.new_household')->with($data);
    }

    public function household($id){
        $data['household'] = Household::findOrFail($id);
        $data['facility_types'] = FacilityType::all();
        $data['facilities'] = Facility::all();
        return view('cms.household.household')->with($data);
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
        //return Redirect('/household/view/essential/'. $household->id .'');
        return Redirect::back();
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

    public function addFacility(Request $request){
        $validatedData = $request->validate([
            'household_id' => 'required',
            'facility_id' => 'required',
            'description' => 'required',
        ]);

        $household=Household::findOrFail($request->input('household_id'));
        $facility = Facility::findOrFail($request->input('facility_id'));
        $household->facilities()->attach($facility,['description'=> $request->input('description')]);
        session()->flash('success', 'Facilities added');
        return redirect::back();
    }

}