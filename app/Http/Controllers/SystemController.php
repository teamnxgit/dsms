<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GnDivision;
use App\Town;
use App\Street;
use App\ElectricitySource;
use App\FacilityType;
use App\Facility;
use Redirect;
use Session;

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

        /*
        $data['facility_counts'] = DB::table('facilities')
                 ->select('facility_id', DB::raw('count(*) as total'))
                 ->groupBy('facility_id')
                 ->get();
        */
        
        return view('cms.system.household')->with($data);
    }

    public function person(){
        $data['gn_divisions_count'] = GnDivision::all()->count();
        $data['towns_count'] = Town::all()->count();
        $data['streets_count'] = Street::all()->count();
        return view('cms.system.person')->with($data);
    }


}
