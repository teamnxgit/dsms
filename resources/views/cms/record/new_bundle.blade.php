@extends('layouts.app')

@section('content')

@include('navbar.records')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-4">
                <div class="h3">New Bundle</div>
            </div>

        </div>
        <hr>
        {!! Form::open(['url' => '/record/bundle/add']) !!}
        <div class="p-3 bg-light border rounded row m-1">
        
            <div class="h5 col-12">Enter the details to add new Bundle</div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Serial No</span>
                </div>
                {{Form::text('serial_no',null,['class'=>'form-control','placeholder'=>'Serial Number of the Bundle',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Name</span>
                </div>
                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Name of the Bundle',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Number</span>
                </div>
                {{Form::text('number',null,['class'=>'form-control','placeholder'=>'Number of the Bundle',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Year</span>
                </div>
                {{Form::text('year',null,['class'=>'form-control','placeholder'=>'Year of the document in Bundle',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Branch</span>
                </div>
                {{Form::text('branch',null,['class'=>'form-control','placeholder'=>'Branch name Bundle belongs to ',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Color</span>
                </div>
                {{Form::color('color', "#FFFF00",['class'=>'form-control',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Note</span>
                </div>
                <textarea name="note" class="form-control" name="note" placeholder="Description of the bundle" rows="3"></textarea>
            </div>

            <div class="input-group mb-3">
                {{Form::submit('Save',['class'=>'btn btn-success ml-2 '])}}
            </div>
            
        </div>
        {!! Form::close() !!}
    </div>
@endsection
