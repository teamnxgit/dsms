@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">New Person</div>
            </div>
        </div>
        <hr>
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Enter the details to add new person</div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Full Name</span>
                    </div>
                    {{Form::text('fullname',null,['class'=>'form-control','placeholder'=>'Full Name of the person',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Gender...</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="O">Other</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">GN Division</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Grama Niladhari Division...</option>
                        <option value="207">207 - Meeravodai West</option>
                        <option value="207A">207A - Mancholai</option>
                        <option value="207B">207B - Meeravodai East</option>
                        <option value="208">208 - Oddamavadi 03</option>
                        <option value="208B">208B - Oddamavadi 01 South</option>
                        <option value="208B/2">208B/2 - Oddamavadi 01 North</option>
                        <option value="208C">208C - Oddamavadi 02</option>
                        <option value="210B">210B - Paper Town</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Village / Town</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose village / town...</option>
                        <option value="207">207 - Meeravodai West</option>
                        <option value="207A">207A - Mancholai</option>
                        <option value="207B">207B - Meeravodai East</option>
                        <option value="208">208 - Oddamavadi 03</option>
                        <option value="208B">208B - Oddamavadi 01 South</option>
                        <option value="208B/2">208B/2 - Oddamavadi 01 North</option>
                        <option value="208C">208C - Oddamavadi 02</option>
                        <option value="210B">210B - Paper Town</option>
                    </select>
                </div>
            
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">NIC</span>
                    </div>
                    {{Form::text('fullname',null,['class'=>'form-control','placeholder'=>'NIC Number',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>
                <div class="input-group mb-3">
                    {{Form::submit('Save & + New Person',['class'=>'btn btn-secondary '])}}
                    {{Form::submit('Save',['class'=>'btn btn-success ml-2 '])}}
                    <a class="btn btn-primary ml-2" href="/person/update/essential/123">Next</a>
                </div>
            
        </div>
    </div>
@endsection
