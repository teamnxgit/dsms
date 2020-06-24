<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;
use App\FacilityType;

class FacilityController extends Controller
{
    public function veiwFacilityType(){
        $gnDivisions = FacilityType::all();
        $data['facilities'] = $gnDivisions;
        return view('cms.system.household.facility_types')->with($data);
    }

    public function addFacilityType(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'shorthand' => 'required',
            'icon' => 'required'
        ]);
        FacilityType::updateOrCreate([
            'name'=>$request->input('name'),
            'shorthand'=>$request->input('shorthand'),
            'icon'=>$request->input('icon') 
        ]);
        session()->flash('success', 'Facility Type created');
        return redirect()->back();
    }

    public function remFacilityType(Request $request){
        $facility= FacilityType::findOrFail($request->input('id'));
        $facility->delete();
        session()->flash('success', 'Facility Type deleted');
        return redirect()->back();
    }

    public function veiwFacilities($shorthand){
        $facility_type = FacilityType::where('shorthand',$shorthand)->get()->first();
        $data['facility_type'] = $facility_type;
        $data['facilities'] = Facility::where('type',$facility_type->id)->get();
        return view('cms.system.household.facility')->with($data);
    }

    public function addFacility(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);
        Facility::updateOrCreate([
            'name'=>$request->input('name'),
            'type'=>$request->input('type')
        ]);
        session()->flash('success', 'Facility created');
        return redirect()->back();
    }

    public function remFacility(Request $request){
        $facility= Facility::findOrFail($request->input('id'));
        $facility->delete();
        session()->flash('success', 'Facility deleted');
        return redirect()->back();
    }
    
}