<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;

class AttendanceController extends Controller
{
    public function index(){

    }

    public function calendar(){
        $data['January']=Calendar::whereBetween('date',[date('Y-01-01'),date('Y-01-31')])->get();;
        $data['February']=Calendar::whereBetween('date',[date('Y-02-01'),date('Y-02-29')])->get();;
        $data['March']=Calendar::whereBetween('date',[date('Y-03-01'),date('Y-03-31')])->get();;
        $data['April']=Calendar::whereBetween('date',[date('Y-04-01'),date('Y-04-30')])->get();;
        $data['May']=Calendar::whereBetween('date',[date('Y-05-01'),date('Y-05-31')])->get();;
        $data['June']=Calendar::whereBetween('date',[date('Y-06-01'),date('Y-06-30')])->get();;
        $data['July']=Calendar::whereBetween('date',[date('Y-07-01'),date('Y-07-31')])->get();;
        $data['August']=Calendar::whereBetween('date',[date('Y-08-01'),date('Y-08-31')])->get();;
        $data['September']=Calendar::whereBetween('date',[date('Y-09-01'),date('Y-09-30')])->get();;
        $data['October']=Calendar::whereBetween('date',[date('Y-10-01'),date('Y-10-31')])->get();;
        $data['November']=Calendar::whereBetween('date',[date('Y-11-01'),date('Y-11-30')])->get();;
        $data['December']=Calendar::whereBetween('date',[date('Y-12-01'),date('Y-12-31')])->get();;
        
        return view('cms.attendance.calendar')->with($data);
    }

    public function addAttendance(Request $request){

    }

    public function updateAttendance(Request $request){

    }

    public function deleteAttendance(Request $request){

    }

    public function uploadLogFile(Request $request){

    }

    public function addYearLeave(Request $request){

    }

    public function updateYearLeave(Request $request){

    }
}
