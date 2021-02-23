<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Benefit;

class BenefitController extends Controller
{
    public function benefits(){
        $data['benefits']=Benefit::all();
        return view('cms.system.person.benefit')->with($data);
    }

    public function addBenefit(Request $request){
        $request->validate([
            'name'=>'required',
            'program'=>'required',
            'description'=>'required',
            'value'=>'required',
        ]);

        $benefit = new Benefit;
        $benefit->name = $request->input('name');
        $benefit->program = $request->input('program');
        $benefit->description = $request->input('description');
        $benefit->value = $request->input('value');
        $benefit->save();

        session()->flash('success', 'Benefit created');
        return redirect()->back();
    }

    public function remBenefit(Request $request){
        $request->validate([
            'benefit_id'=>'required',
        ]);

        $benefit = Benefit::findOrFail($request->input('benefit_id'));
        $benefit->delete();

        session()->flash('success', 'Benefit removed');
        return redirect()->back();
    }

    
}
