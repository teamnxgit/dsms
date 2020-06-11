@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Essential Details of Person</div>
            </div>
        </div>
        <hr>
        <div class="p-3 bg-light border rounded row m-1">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Full Name</span>
                    </div>
                    {{Form::text('fullname',null,['class'=>'form-control disabled',"aria-describedby"=>"basic-addon1","readonly"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name with Initials</span>
                    </div>
                    {{Form::text('namewi',null,['class'=>'form-control disabled',"aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Maritial Status</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Status...</option>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="2">Seperated</option>
                        <option value="3">Divorced</option>
                        <option value="3">Widow</option>
                        <option value="3">Widower</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Date of Birth</span>
                    </div>
                    {{Form::date('dob',null,['class'=>'form-control',"aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Driving Licence No</span>
                    </div>
                    {{Form::text('dl',null,['class'=>'form-control',"aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Passport No.</span>
                    </div>
                    {{Form::text('ppno',null,['class'=>'form-control',"aria-describedby"=>"basic-addon1"])}}
                </div>

                

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Ethnicity</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Ethnicity...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Religion</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Religion...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Education Level</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Education Level...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Current Education</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Current Education...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                    </div>
                    <label class="form-control" for="inputGroupSelect01">Computer Literacy</label>
                </div>
            
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Mobile No</span>
                    </div>
                    {{Form::tel('fullname',null,['class'=>'form-control','placeholder'=>'Mobile Number',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Land phone No</span>
                    </div>
                    {{Form::text('fullname',null,['class'=>'form-control','placeholder'=>'Land Phone No',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    {{Form::text('email',null,['class'=>'form-control','placeholder'=>'Email Address',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>

            {{Form::submit('Save',['class'=>'btn btn-success ml-2'])}}
            <a class="btn btn-primary ml-2" href="/person/update/house/123">Next</a>
            
        </div>
    </div>
@endsection
