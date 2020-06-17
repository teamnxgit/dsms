<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Town;

class TownController extends Controller
{
    
    public function veiwTown(){
        $gnDivisions = GnDivision::all();
        $data['gndivisions'] = $gnDivisions;
        $towns = Town::all()->sortBy('gn_division_id')->sortBy('id');
        foreach ($towns as $town) {
            $town->gndivision = GnDivision::find($town->gn_division_id);
        }
        $data['towns'] = $towns;
        return view('cms.system.household.towns')->with($data);
    }

    public function addTown(Request $request){
        $validatedData = $request->validate([
            'gndivision_id' => 'required',
            'name' => 'required',
        ]);
        $gn_div_id = GnDivision::findOrFail($request->input('gndivision_id'))->id;
        $town_name = $request->input('name');
        Town::updateOrCreate(['name'=>$town_name,'gn_division_id'=>$gn_div_id]);
        session()->flash('success', 'Town / Village Created');
        return redirect()->back();
    }

    public function remTown(Request $request){
        $town= Town::findOrFail($request->input('town_id'));
        $town->delete();
        session()->flash('success', 'Town / Village Deleted');
        return redirect()->back();
    }

    public function listTown(Request $request){
        $gn_division = GnDivision::find($request->input('gn_division_id'));
        $data['towns'] = Town::where('gn_division_id',$gn_division->id)->get();
        return view('cms.system.household.fetch_towns')->with($data);
    }
}
