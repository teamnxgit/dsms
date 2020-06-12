@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Household Essential Details</div>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/household/update/essential']) !!}
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">View / Update Household Details</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">House No</span>
                    </div>
                    {{Form::text('house_no',$household->house_no,['class'=>'form-control','placeholder'=>'House No','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    {{Form::submit('Save & Next',['class'=>'btn btn-success ml-2 '])}}
                    <a class="btn btn-primary ml-2" href="/household/view/">Next</a>
                </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
