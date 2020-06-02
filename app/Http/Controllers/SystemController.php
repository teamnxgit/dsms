<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Town;
use Redirect;
use Session;
class SystemController extends Controller
{
    public function index(){
        $data['gn_divisions_count'] = GnDivision::all()->count();
        $data['towns_count'] = Town::all()->count();
        return view('cms.system.system')->with($data);
    }

    public function veiwGNDivision(){
        $gnDivisions = GnDivision::all();
        $data['gndivisions'] = $gnDivisions;
        return view('cms.system.gn_divisions')->with($data);
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

    public function veiwTown(){
        $gnDivisions = GnDivision::all();
        $data['gndivisions'] = $gnDivisions;
        $towns = Town::all()->sortBy('gn_division_id')->sortBy('id');
        foreach ($towns as $town) {
            $town->gndivision = GnDivision::find($town->gn_division_id);
        }
        $data['towns'] = $towns;
        return view('cms.system.towns')->with($data);
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
        return view('cms.system.fetch_towns')->with($data);
    }
}
