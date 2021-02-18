<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Benefit;

class BenefitController extends Controller
{
    public function addBenefit(Request $request){

        $request->validate([
            'person_id'=>'required',
            'benefit_id'=>'required'
        ]);

        $person = Person::findOrFail($request->input('person_id'));
        $benefit = Benefit::findOrFail($request->input('benefit_id'));

        $person_benefit = $person->benefits->where('benefit_id',$request->input('benefit_id'));
        $person_benefit_count = $person_benefit->count();
        
        $person->benefits()->attach($benefit->id,[
            'note'=>$request->input('note'),
            'date'=>$request->input('date'),
            'current_status'=>$request->input('current_status')
        ]);

        Session::flash('success', 'Person benefit record created');
        return Redirect::back();
    }
}
