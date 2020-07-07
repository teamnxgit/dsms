@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-4">
                <div class="h3">Persons</div>
            </div>
            <div class="col-8 text-right">
                <a class="btn btn-primary text-light" href="/person/new/">+ Add New Person</a>
            </div>
        </div>
        <hr>
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Search Persons</div>
            {{Form::label('search',null,['class'=>'col-lg-1 pt-1'])}}
            {{Form::text('search',null,['class'=>'form-control col-lg-9 mb-2','placeholder'=>'Search NIC | Name | House No'])}}
            
            {{Form::submit('Search',['class'=>'btn btn-primary col-lg-1 ml-lg-2 mb-2'])}}
        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
           <div class="table-responsive">
                <table class="table" id="household">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">GN Division</th>
                            <th class="text-center">Town / Village</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">NIC</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($people as $person)
                            <tr>
                                <td class="text-center">{{$person->id}}</td>
                                <td class="text-center">{{$person->gndivision->name}}</td>
                                <td class="text-center">{{$person->town->name}}</td>
                                <td class="">{{$person->full_name}}</td>
                                <td class="text-center">{{$person->nic}}</td>

                                <td class="text-center">
                                    {!! Form::open(['url' => '/person/delete/']) !!}
                                        <a class="btn ml-lg-2 px-2 text-primary" href="/person/view/{{$person->id}}">
                                            <i class="fas fa-2x fa-chevron-circle-right"></i>
                                        </a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
        </div>
    </div>
@endsection
