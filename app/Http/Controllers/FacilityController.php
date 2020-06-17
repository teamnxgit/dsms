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
        session()->flash('success', 'Facility created');
        return redirect()->back();
    }

    public function remFacilityType(Request $request){
        $facility= FacilityType::findOrFail($request->input('id'));
        $facility->delete();
        session()->flash('success', 'Facility deleted');
        return redirect()->back();
    }
}
