<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assistance;
use App\Person;
use Session;
use Redirect;

class AssistanceController extends Controller
{
    
    public function assistance(){
        $data['assistances']=Assistance::all();
        return view('cms.system.person.assistance')->with($data);
    }
    
    public function addAssistance(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'value'=>'required',
        ]);

        $assistance = new Assistance;
        $assistance->name = $request->input('name');
        $assistance->description = $request->input('description');
        $assistance->value = $request->input('value');
        $assistance->save();

        session()->flash('success', 'Assistance Program created');
        return redirect()->back();
    }

    

    public function atachAssistance(Request $request){
        $request->validate([
            'person_id' => 'required',
            'assistance_id'=>'required',
            'from'=>'required',
            'status'=>'required'
        ]);

        $assistance = Assistance::findOrFail($request->input('assistance_id'));
        $person = Person::findOrFail($request->input('person_id'));

        $person->assistances()->attach($assistance->id,[
            'from'=>$request->input('from'),
            'to'=>$request->input('to'),
            'status'=>$request->input('status'),
            'note'=>$request->input('note')
        ]);

        Session::flash('success', 'Person assistance record created');
        return Redirect::back();
    }

    public function detachAssistance(Request $request){
        $request->validate([
            'person_id' => 'required',
            'assistance_id'=>'required'
        ]);

        $assistance = Assistance::findOrFail($request->input('assistance_id'));
        $person = Person::findOrFail($request->input('person_id'));

        $person->assistances()->detach($assistance);

        Session::flash('success', 'Person assistance record removed');
        return Redirect::back();
    }
}
