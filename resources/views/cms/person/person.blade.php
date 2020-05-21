@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-4">
                <div class="h3">Persons</div>
            </div>
            <div class="col-8 text-right">
                <a class="btn btn-success text-light">+ Add New Person</a>
            </div>
        </div>
        <hr>
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Search Persons</div>
            {{Form::label('search',null,['class'=>'col-lg-1 pt-1'])}}
            {{Form::text('search',null,['class'=>'form-control col-lg-5','placeholder'=>'Search NIC | Name | House No'])}}
        </div>
    </div>
@endsection
