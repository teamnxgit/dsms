<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Town;
use App\Street;
use App\FacilityType;
use App\Facility;
use App\VulnerabilityType;
use App\Job;
use Redirect;
use Session;
use DB;

class SystemController extends Controller
{
    public function index(){
        return view('cms.system.system');
    }

    public function household(){
        $data['gn_divisions_count'] = GnDivision::all()->count();
        $data['towns_count'] = Town::all()->count();
        $data['streets_count'] = Street::all()->count();
        $data['facility_types_count'] = FacilityType::all()->count();
        $data['facility_types'] = FacilityType::all();

        $data['facilities_count'] = DB::table('facilities')
                 ->select('type', DB::raw('count(*) as total'))
                 ->groupBy('type')
                 ->get();
        return view('cms.system.household')->with($data);
    }

    public function person(){
        $data['gn_divisions_count'] = GnDivision::all()->count();
        $data['towns_count'] = Town::all()->count();
        $data['streets_count'] = Street::all()->count();
        return view('cms.system.person')->with($data);
    }

    public function HouseholdVulnerabilityTypes(){
        $data['vulnerability_types'] = VulnerabilityType::all();
        return view('cms.system.household.vulnerability')->with($data);
    }

    public function addHouseholdVulnerabilityTypes(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $vulnerability_type = VulnerabilityType::updateOrCreate(
            ['category'=>'household','name'=>$request->input('name'),'icon'=>$request->input('icon')]
        );
        session()->flash('success', 'Household Vulnerability Type Created');
        return redirect()->back();
    }

    public function remHouseholdVulnerabilityTypes(Request $request){
        $request->validate([
            'type_id'=>'required'
        ]);
        $vulnerable_type = VulnerabilityType::findOrFail($request->input('type_id'));
        $vulnerable_type->delete();
        session()->flash('success', 'Household Vulnerability Type Deleted');
        return redirect()->back();
    }

    public function job(){
        $data['jobs']=Job::all();
        return view('cms.system.person.job')->with($data);
    }

    public function addJob(Request $request){
        $request->validate([
            'name'=>'required'
        ]);

        $job = new Job;
        $job->name = $request->input('name');
        $job->save();

        session()->flash('success', 'Job created');
        return redirect()->back();
    }

    public function remJob(Request $request){
        $request->validate([
            'job_id'=>'required',
        ]);

        $job = Job::findOrFail($request->input('job_id'));
        $job->delete();

        session()->flash('success', 'Job removed');
        return redirect()->back();
    }
}
