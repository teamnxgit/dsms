<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Person;
use App\Town;
use App\PersonDetail;
use App\Household;
use App\Job;
use App\Benefit;
use App\Assistance;
use Redirect;
use Session;

class PersonController extends Controller
{
    // 
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $data['keyword']=$keyword;
        if ($keyword==null||$keyword=='') {
            $data['people'] = Person::where('status','Alive')->orderBy('created_at','desc')->paginate(20);
        }
        else {
            $data['people'] = Person::where('status','Alive')->where('nic','like','%'.$keyword.'%')->orWhere('full_name','like','%'.$keyword.'%')->orderBy('created_at','desc')->paginate(100);
        }
        
        return view('cms.person.people')->with($data);
    }

    public function new(){
        $data['gn_divisions'] = GnDivision::all();
        return view('cms.person.new_person')->with($data);
    }

    public function person($id){
    /* Getting details of a person */
        // Creating object & validating id
        $person = Person::findOrFail($id);
        // Getting details of person's Town
        $data['town'] = Town::where('gn_division_id',$person->gn_division_id)->get();
        // Getting details of person's Household
        $data['household'] = Household::where('gn_division_id',$person->gn_division_id)->get();
        // Getting details of Person
        $data['person']=$person;
        // Getting details of Jobs
        $data['jobs']=Job::all();
        // Getting details of Benefits
        $data['benefits']=Benefit::all();
        // Getting details of Assitances
        $data['assistances']=Assistance::all();
        // Returning View with data
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

    public function remove(Request $request){
    /*-- Deleting a Person --*/
        // Presence Check
        $request->validate([
            'person_id'=>'required'
        ]);
        // Creating object & validating person_id
        $person = Person::findOrFail($request->input('person_id'));
        // Removing other details
        $person->persondetail->delete();
        // Deleting Person
        $person->delete();
        // Flasing Message
        Session::flash('success', $person->nic. ' removed from database');
        // Redirecting to --> People
        return Redirect('/people');
    }

    public function update(Request $request){
    /*- Updating Person's essential details -*/
        // Presence Check
        $request->validate([
            'person_id'=>'required',
            'town_id'=>'required',
            'household_id'=>'required',
            'fullname'=>'required',
            'gender'=>'required',
            'status'=>'required',
        ]);
        // Creating Object & Validating input
        $person = Person::findOrFail($request->input('person_id'));
        // Assigning values to object
        $person->town_id=$request->input('town_id');
        $person->household_id=$request->input('household_id');
        $person->nic=$request->input('nic');
        $person->full_name=$request->input('fullname');
        $person->gender=$request->input('gender');
        $person->status=$request->input('status');
        // Saving Obejct
        $person->save();
        // Flashing message
        Session::flash('success', 'Person basic details updated');
        // Redirecting to previous page
        return Redirect::back();
    }

    public function updatePersonDetails(Request $request){
    /*-------- Updating Person's other details ----------*/
        // Presence Check
        $request->validate([
            'person_id'=>'required',
        ]);
        // Creating object & validating person_id
        $personDetail = PersonDetail::findOrFail($request->input('person_id'));
        // Assigning values to object
        $personDetail->name_with_initials = $request->input('name_with_initials');
        $personDetail->full_name_t = $request->input('full_name_t');
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
        $personDetail->vote_list_serial = $request->input('vote_list_serial');
        $personDetail->residence_status = $request->input('residence_status');
        if ($request->input('is_head_of_family')) {
            $personDetail->is_head_of_family = 1;
        }
        else {
            $personDetail->is_head_of_family = 0;
        }
        // Saving objects
        $personDetail->save();
        // Flashing Message
        Session::flash('success', 'Person other details updated');
        // Redirecting to previous page
        return Redirect::back();
    }

    public function attachJob(Request $request){
    /*------- Attaching Job to a Person --------*/
        // Presence Check
        $request->validate([
            'person_id'=>'required',
            'job_id'=>'required'
        ]);
        // Creating Objects & validating person_id, job_id
        $person = Person::findOrFail($request->input('person_id'));
        $job = Job::findOrFail($request->input('job_id'));
        // Attaching job
        $person->jobs()->attach($job->id,[
            'income'=>$request->input('income'),
            'note'=>$request->input('note')
        ]);
        // Flashing message
        Session::flash('success', 'Person job updated');
        // Redirecting to previous page
        return Redirect::back();
    }
    
    public function attachBenefit(Request $request){
    /*------- Attaching Benefits to Person -------*/
        // Presence check
        $request->validate([
            'person_id'=>'required',
            'benefit_id'=>'required'
        ]);
        // Creating Objects & Validaing person_id, benefit_id
        $person = Person::findOrFail($request->input('person_id'));
        $benefit = Benefit::findOrFail($request->input('benefit_id'));
        /*
        $person_benefit = $person->benefits->where('benefit_id',$request->input('benefit_id'));
        $person_benefit_count = $person_benefit->count();
        */
        // Attaching Benefit
        $person->benefits()->attach($benefit->id,[
            'note'=>$request->input('note'),
            'date'=>$request->input('date'),
            'current_status'=>$request->input('current_status')
        ]);
        // Flashing message  
        Session::flash('success', 'Person benefit record created');
        // Redirecting to previous page
        return Redirect::back();
    }
}
