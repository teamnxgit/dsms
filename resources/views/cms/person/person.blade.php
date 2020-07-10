@extends('layouts.app')

@section('content')

@include('navbar.person')

@can('Person & Household')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Person Details</div>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/person/update']) !!}
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Person Basic Details</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">ID</span>
                    </div>
                    {{Form::text('id',$person->id,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">GN Division</span>
                    </div>
                    {{Form::text('gn_division',$person->gndivision->name,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Village / Town</span>
                    </div>
                    <select name="town_id" id="" class="form-control">
                        @foreach($towns as $town)
                            @if($town->id==$person->town_id)
                                <option value="{{$town->id}}" selected>{{$town->name}}</option>
                            @else
                            <option value="{{$town->id}}">{{$town->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">House No</span>
                    </div>
                    <select name="town_id" id="" class="form-control">
                        @foreach($households as $household)
                            @if($household->id==$person->household_id)
                                <option value="{{$household->id}}" selected>{{$household->house_no}}</option>
                            @else
                            <option value="{{$household->id}}">{{$household->house_no}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Full Name</span>
                    </div>
                    {{Form::text('fullname',$person->full_name,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">NIC</span>
                    </div>
                    {{Form::text('nic',$person->nic,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Gender</span>
                    </div>
                    <select name="gender" id="" class="form-control">
                        <option value="M" @if($person->gender=='M')selected @endif>Male</option>
                        <option value="F" @if($person->gender=='F')selected @endif>Female</option>
                        <option value="O" @if($person->gender=='O')selected @endif>Other</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    @can('Person & Household Operator')
                    {{Form::submit('Update',['class'=>'btn btn-success ml-2 '])}}
                    @endcan
                    {!! Form::close() !!}

                    @can('Person & Household Admin')
                    
                    <button class="btn btn-warning ml-2 text-dark" data-toggle="modal" data-target="#Household-Person-Modal">GN Division Transfer</button>
                    

                    {!! Form::open(['url' => '/household/delete']) !!}
                        <input type="hidden" name="id" value="{{$person->id}}">
                        {{Form::submit('Delete',['class'=>'btn btn-danger ml-2 '])}}
                    {!! Form::close() !!}
                    @endcan
                </div>
                
        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Person Other Details</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">ID</span>
                    </div>
                    {{Form::text('id',$person->id,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" name="is_head_of_family" aria-label="Checkbox for following text input">
                        </div>
                    </div>
                    <input type="text" class="form-control" value="Head of the Family" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name With Initials</span>
                    </div>
                    {{Form::text('name_with_initials',$person->persondetail->driving_license,['class'=>'form-control'])}}
                </div>

                

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Driving License Number</span>
                    </div>
                    {{Form::text('driving_license',$person->persondetail->driving_license,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Passport Number</span>
                    </div>
                    {{Form::text('passport',$person->persondetail->passport,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Maritial Status</span>
                    </div>
                    <select name="maritial_status" id="" class="form-control">
                        <option value="">Select Maritial Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="separated">Separated</option>
                        <option value="widow">Widow</option>
                        <option value="widower">Widower</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Date of Birth</span>
                    </div>
                    {{Form::date('dob',$person->persondetail->dob,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Ethnicity</span>
                    </div>
                    <select name="ethnicity" id="" class="form-control">
                        <option value="">Select Ethnicity</option>
                        <option value="sinhalese">Sinhalese</option>
                        <option value="srilankantamils">Sri Lankan Tamils</option>
                        <option value="srilankanmoors">Sri Lankan Moors</option>
                        <option value="indiantamils">Indian Tamils</option>
                        <option value="srilankanmalays">Sri Lankan Malays</option>
                        <option value="burghers">Burghers/Eurasian</option>
                        <option value="other">Others</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Religion</span>
                    </div>
                    <select name="religion" id="" class="form-control">
                        <option value="">Select Religion</option>
                        <option value="buddhist">Buddhist</option>
                        <option value="hindu">Hindu</option>
                        <option value="muslim">Muslim</option>
                        <option value="christian">Christian</option>
                        <option value="other">Others</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Education Level</span>
                    </div>
                    <select name="education_level" id="" class="form-control">
                        <option value="">Select Education Level</option>
                        <option value="noschooling">No Schooling</option>
                        <option value="grade1">Grade 1</option>
                        <option value="grade2">Grade 2</option>
                        <option value="grade3">Grade 3</option>
                        <option value="grade4">Grade 4</option>
                        <option value="grade5">Grade 5</option>
                        <option value="grade6">Grade 6</option>
                        <option value="grade7">Grade 7</option>
                        <option value="grade8">Grade 8</option>
                        <option value="grade9">Grade 9</option>
                        <option value="grade10">Grade 10</option>
                        <option value="grade11">Grade 11</option>
                        <option value="ol">G.C.E O/L</option>
                        <option value="al">G.C.E A/L</option>
                        <option value="diploma">Diploma</option>
                        <option value="hdiploma">Higher Diploma</option>
                        <option value="bdegree">Bachelor's Degree</option>
                        <option value="mdegree">Master's Degree</option>
                        <option value="mphil">MPhil</option>
                        <option value="phd">PhD</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Mobile No</span>
                    </div>
                    {{Form::text('mobile_no',$person->persondetail->mobile_no,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Land Phone No</span>
                    </div>
                    {{Form::text('land_phone_no',$person->persondetail->land_phone_no,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    {{Form::text('email',$person->persondetail->email,['class'=>'form-control'])}}
                </div>

                

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Vote List Serial Number</span>
                    </div>
                    {{Form::text('vote_list_serial',$person->persondetail->vote_list_serial,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Residence Status</span>
                    </div>
                    <select name="residence_status" id="" class="form-control">
                        <option value="">Residential Status</option>
                        <option value="permanent">Permanent</option>
                        <option value="rent">Rent</option>
                        <option value="temporary">Temporary</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    @can('Person & Household Operator')
                    {{Form::submit('Update',['class'=>'btn btn-success ml-2 '])}}
                    @endcan
                    {!! Form::close() !!}
                </div>
                
        </div>
@endcan

@endsection
