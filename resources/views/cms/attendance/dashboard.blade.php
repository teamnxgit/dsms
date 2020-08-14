@extends('layouts.app')

@section('content')

@include('navbar.attendance')


    <div class="col-lg-12 p-3">
        @can('Attendance Operator')
        <div class="row">
        
            <div class="col-12">
                <div class="h3">Attendace & Leave</div>
            </div>
        </div>
        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
           
           
        </div>
        @endcan
    </div>
    <style>

    </style>
@endsection


