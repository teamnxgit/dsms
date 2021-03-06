<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Town;
use App\Street;

class StreetController extends Controller
{
    public function veiwStreet(){
        $data['gndivisions'] = GnDivision::all();
        $streets = Street::all()->sortBy('gn_division_id')->sortBy('town_id')->sortBy('id');
        foreach ($streets as $street) {
            $street->gndivision = GnDivision::find($street->gn_division_id);
            $street->town = Town::find($street->town_id);
        }
        $data['streets'] = $streets;
        return view('cms.system.household.streets')->with($data);
    }

    public function addStreet(Request $request){
        $validatedData = $request->validate([
            'gndivision_id' => 'required',
            'town_id' => 'required',
            'name' => 'required',
        ]);
        
        $gn_div_id = GnDivision::findOrFail($request->input('gndivision_id'))->id;
        $town_id = Town::findOrFail($request->input('town_id'))->id;
        $street_name = $request->input('name');
        Street::updateOrCreate(['name'=>$street_name,'gn_division_id'=>$gn_div_id,'town_id'=>$town_id]);
        session()->flash('success', 'Street/Lane Created');
        return redirect()->back();
    }

    public function remStreet(Request $request){
        $town= Town::findOrFail($request->input('town_id'));
        $town->delete();
        session()->flash('success', 'Town / Village Deleted');
        return redirect()->back();
    }

    public function listStreet(Request $request){
        $town = Town::find($request->input('town_id'));
        $data['streets'] = Street::where('town_id',$town->id)->get();
        return view('cms.system.household.fetch_streets')->with($data);
    }
}
