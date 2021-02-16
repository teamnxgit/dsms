<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    public function addBenefit(Request $request){
        $request->validate([
            'person_id' => 'required',
            'assistance_id'=>'required',
            'from'=>'required',
            'status'=>'required'
        ]);
    }
}
