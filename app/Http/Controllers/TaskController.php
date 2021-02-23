<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request){
        $request->valiate([
            'user_id'=>'required'
        ]);
    }
}
