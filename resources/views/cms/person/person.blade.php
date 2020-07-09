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
                    
                    <button class="btn btn-outline-warning ml-2 text-dark" data-toggle="modal" data-target="#Household-Person-Modal">GN Division Transfer</button>
                    

                    {!! Form::open(['url' => '/household/delete']) !!}
                        <input type="hidden" name="id" value="{{$person->id}}">
                        {{Form::submit('Delete',['class'=>'btn btn-danger ml-2 '])}}
                    {!! Form::close() !!}
                    @endcan
                </div>
                
        </div>
@endcan

@endsection
