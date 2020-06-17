<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;

class GNDivisionController extends Controller
{
    public function veiwGNDivision(){
        $gnDivisions = GnDivision::all();
        $data['gndivisions'] = $gnDivisions;
        return view('cms.system.household.gn_divisions')->with($data);
    }

    public function addGNDivision(Request $request){
        $validatedData = $request->validate([
            'number' => 'required|unique:gn_divisions',
            'name' => 'required',
        ]);
        $gn_div_no = $request->input('number');
        $gn_div_name = $request->input('name');
        GnDivision::updateOrCreate(['number'=>$gn_div_no,'name'=>$gn_div_name]);
        session()->flash('success', 'GN Division Created');
        return redirect()->back();
    }

    public function remGNDivision(Request $request){
        $GNDivision= GnDivision::findOrFail($request->input('gn_division_id'));
        $GNDivision->delete();
        session()->flash('success', 'GN Division Deleted');
        return redirect()->back();
    }
}
