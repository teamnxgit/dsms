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
        return view('cms.person.people')->with($data);
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

        if ($is_person_exist==0 || $request->input('nic')==null) {
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
        return Redirect('/people');
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

    public function rem(Request $request){
        $request->validate([
            'person_id'=>'required'
        ]);
        $person = Person::findOrFail($request->input('person_id'));
        $person->persondetail->delete();
        $person->delete();

        Session::flash('success', $person->nic. ' removed from database');
        return Redirect('/people');
    }

    public function update(Request $request){
        $nic_count = Person::where('nic',$request->input('nic'))->count();
        if ($nic_count==0 ||$request->input('nic')==null) {
            $request->validate([
                'person_id'=>'required',
                'town_id'=>'required',
                'household_id'=>'required',
                'fullname'=>'required',
                'gender'=>'required',
                'status'=>'required',
            ]);
    
            $person = Person::findOrFail($request->input('person_id'));
            $person->town_id=$request->input('town_id');
            $person->household_id=$request->input('household_id');
            $person->nic=$request->input('nic');
            $person->full_name=$request->input('fullname');
            $person->gender=$request->input('gender');
            $person->status=$request->input('status');
    
            $person->save();
    
            Session::flash('success', 'Person basic details updated');
            return Redirect::back();
        }
        else {
            Session::flash('danger', $request->input('nic'). ' NIC alredy exist');
            return Redirect::back();
        }
    }

    public function updatePersonDetails(Request $request){
        $request->validate([
            'person_id'=>'required',
        ]);
        
        $personDetail = PersonDetail::findOrFail($request->input('person_id'));

        $personDetail->name_with_initials = $request->input('name_with_initials');
        $personDetail->driving_license = $request->input('driving_license');
        $personDetail->passport = $request->input('passport');
        $personDetail->maritial_status = $request->input('maritial_status');
        $personDetail->dob = $request->input('dob');
        $personDetail->ethnicity = $request->input('ethnicity');
        $personDetail->religion = $request->input('religion');
        $personDetail->education_level = $request->input('education_level');
        $personDetail->mobile_no = $request->input('mobile_no');
        $personDetail->land_phone_no = $request->input('land_phone_no');
        $personDetail->email = $request->input('email');
        if ($request->input('is_head_of_family')) {
            $personDetail->is_head_of_family = 1;
        }
        else {
            $personDetail->is_head_of_family = 0;
        }
        $personDetail->vote_list_serial = $request->input('vote_list_serial');
        $personDetail->residence_status = $request->input('residence_status');


        $personDetail->save();

        Session::flash('success', 'Person other details updated');
        return Redirect::back();
    }


    
}
