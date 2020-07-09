<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Person;
use App\Town;
use App\PersonDetail;
use App\Household;
use Redirect;
use Session;

class PersonController extends Controller
{
    // 
    public function index(){
        $data['people'] = Person::where('status','Alive')->orderBy('created_at','desc')->paginate(20);
        return view('cms.person.persons')->with($data);
    }

    public function new(){
        $data['gn_divisions'] = GnDivision::all();
        return view('cms.person.new_person')->with($data);
    }

    public function person($id){
        $person = Person::findOrFail($id);
        $data['towns'] = Town::where('gn_division_id',$person->gn_division_id)->get();
        $data['households'] = Household::where('gn_division_id',$person->gn_division_id)->get();
        $data['person']=$person;
        return view('cms.person.person')->with($data);
    }

    public function add(Request $request){
        $request->validate([
            'gn_division_id'=>'required',
            'town_id'=>'required',
            'fullname'=>'required',
            'gender'=>'required',
        ]);

        $is_person_exist = Person::where('nic',$request->input('nic'))->count();

        if ($is_person_exist==0) {
            $person = New Person;
            $person->full_name = $request->input('fullname');
            $person->gender = $request->input('gender');
            $person->gn_division_id = $request->input('gn_division_id');
            $person->town_id = $request->input('town_id');
            $person->nic = $request->input('nic');
            $person->household_id = $request->input('household_id');
            $person->save();

            $personDetail = New PersonDetail;
            $personDetail->person_id = $person->id;
            $personDetail->vote_list_serial = $request->input('vote_list_no');
            $personDetail->save();

            Session::flash('success', 'Person added to database');
        }

        else{

            Session::flash('danger', $request->input('nic').' Already exist');
            return Redirect::back();
        }
        

        return Redirect('/person');
    }

    public function attachPersonToHousehold(Request $request){
        
        $request->validate([
            'household_id'=>'required',
            'person_id'=>'required'
        ]);
        
        $person = Person::findOrFail($request->input('person_id'));
        $household = Household::findOrFail($request->input('household_id'));

        $person->household_id = $household->id;
        $person->save();

        Session::flash('success', $person->nic. 'added to '.$household->house_no);
        return Redirect::back();
    }

    public function deAttachPersonFromHousehold(Request $request){
        
        $request->validate([
            'person_id'=>'required'
        ]);
        
        $person = Person::findOrFail($request->input('person_id'));

        $person->household_id = null;
        $person->save();

        Session::flash('success', $person->nic. ' removed from household');
        return Redirect::back();
    }

    
}
