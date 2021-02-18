<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assistance;
use App\Person;
use App\Session;

class AssistanceController extends Controller
{
    public function addAssistance(Request $request){
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
}
