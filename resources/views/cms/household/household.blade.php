@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-4">
                <div class="h3">Households</div>
            </div>
            <div class="col-8 text-right">
                <a class="btn btn-primary text-light" href="/household/new/">+ Add New Household</a>
            </div>
        </div>
        <hr>
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Search Household</div>
            {{Form::label('search',null,['class'=>'col-lg-1 pt-1'])}}
            {{Form::text('search',null,['class'=>'form-control col-lg-5 mb-2','placeholder'=>'Search House No | Street Name'])}}
            
            {{Form::submit('Search',['class'=>'btn btn-primary col-lg-1 ml-lg-2 mb-2'])}}
        </div>
    </div>
@endsection
