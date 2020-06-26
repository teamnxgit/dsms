<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Household;
use App\Town;
use App\Street;
use App\FacilityType;
use App\Facility;
use Redirect;
use Session;
use Auth;

class HouseholdController extends Controller
{
    public function index(){
        $data['households'] = Household::all();
        return view('cms.household.households')->with($data);
    }

    public function new(){
        $data['gn_divisions'] = GnDivision::all();
        return view('cms.household.new_household')->with($data);
    }

    public function household($id){

        $household = Household::findOrFail($id);
        $household->fieldnotes = $household->fieldnotes()->orderBy('created_at', 'desc')->paginate(10);
        $data['household'] = $household;
        $data['division_streets']=Street::where('gn_division_id',$household->gn_division_id)->get();
        $data['division_towns']=Town::where('gn_division_id',$household->gn_division_id)->get();
        $data['facility_types'] = FacilityType::all();
        $data['facilities'] = Facility::all();
        return view('cms.household.household')->with($data);
    }

    public function add(Request $request){
        $validatedData = $request->validate([
            'house_no' => 'required',
            'gn_division_id' => 'required',
            'town_id' => 'required',
            'street_id' => 'required',
            'submit'=>'required'
        ]);
        
        $house_no = $request->input('house_no');
        $street_id = $request->input('street_id');
        $gn_division_id = GnDivision::findOrFail($request->input('gn_division_id'))->id;
        $town_id = Town::findOrFail($request->input('town_id'))->id;
        $owner_nic = $request->input('owner_nic');
        $gps = $request->input('gps');

        $household = Household::where('house_no',$house_no)->where('gn_division_id',$gn_division_id)->first();

        if ($household===null) {
            $household = Household::updateOrCreate([
                "house_no"=>$house_no,
                "gn_division_id"=>$gn_division_id,
                "town_id"=>$town_id,
                "street_id"=>$street_id,
                "owner"=>$owner_nic,
                "gps"=>$gps
            ]);
            session()->flash('success', 'Household created');
        }
        else {
            session()->flash('danger', 'Household already exist');
        }
        //return Redirect('/household/view/essential/'. $household->id .'');
        return Redirect::back();
    }

    public function delete(Request $request){
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $household = Household::findOrFail($request->input('id'));
        $household->delete();
        session()->flash('success', 'Household deleted');
        return redirect::back();
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'house_no' => 'required',
            'town_id' => 'required',
            'street_id' => 'required',
        ]);

        $household=Household::findOrFail($request->input('id'));
        
        if ($household->house_no==$request->input('house_no')){

        }
        else {
            if (Household::where('gn_division_id',$household->gn_division_id)->where('house_no',$household->house_no)->count()==0) {
                $household->house_no = $request->input('house_no');
            }
            else{
                session()->flash('danger', 'House number already exist');
                return redirect::back();
            }
        }
        
        $household->town_id = $request->input('town_id');
        $household->street_id = $request->input('street_id');
        $household->owner = $request->input('owner');
        $household->gps = $request->input('gps');
        $household->save();
        session()->flash('success', 'Household updated');
        return redirect::back();
    }

    public function addFacility(Request $request){
        $validatedData = $request->validate([
            'household_id' => 'required',
            'facility_id' => 'required',
            'description' => 'required',
        ]);

        $household=Household::findOrFail($request->input('household_id'));
        $facility = Facility::findOrFail($request->input('facility_id'));
        $household->facilities()->attach($facility,['description'=> $request->input('description')]);
        session()->flash('success', 'Facilities added');
        return redirect::back();
    }

    public function remFacility(Request $request){
        $validatedData = $request->validate([
            'household_id' => 'required',
            'facility_id' => 'required',
        ]);

        $household=Household::findOrFail($request->input('household_id'));
        $facility = Facility::findOrFail($request->input('facility_id'));
        $household->facilities()->detach($facility);
        session()->flash('success', 'Facilities deleted');
        return redirect::back();
    }

    public function addFieldNote(Request $request){
        $request->validate([
            'household_id' => 'required',
            'field_date' => 'required',
            'heading' => 'required',
            'note' => 'required'
        ]);

        $household=Household::findOrFail($request->input('household_id'));
        $current_user = Auth::user();

        $household->fieldnotes()->create([
            'heading'=>$request->input('heading'),
            'field_date'=>$request->input('field_date'),
            'note'=>$request->input('note'),
            'notable_id'=>$request->input('household_id'),
            'user_id'=>$current_user->id,
            'notable_type'=>Household::class
        ]);

        session()->flash('success', 'Note Added');
        return redirect::back();
    }

}