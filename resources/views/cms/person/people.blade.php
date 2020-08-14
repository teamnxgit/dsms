@extends('layouts.app')

@section('content')

@include('navbar.person')


    <div class="col-lg-12 p-3">
    
        <div class="row">
        @can('Person & Household')
            <div class="col-4">
                <div class="h3">People</div>
            </div>
            <div class="col-8 text-right">
                <a class="btn btn-primary text-light" href="/person/new/">+ Add New Person</a>
            </div>
        </div>
        <hr>

        {!! Form::open(['url' => '/people']) !!}
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Search People</div>
                {{Form::label('search',null,['class'=>'col-lg-1 pt-1'])}}
                {{Form::text('keyword',$keyword,['class'=>'form-control col-lg-9 mb-2','placeholder'=>'Search NIC | Name'])}}
                {{Form::submit('Search',['class'=>'btn btn-primary col-lg-1 ml-lg-2 mb-2'])}}
            </div>
        
        {!! Form::close() !!}

        <div class="p-3 bg-light border rounded row m-1 mt-3">
           <div class="table-responsive">
                <table class="table" id="household">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">NIC</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">GN Division</th>
                            <th class="text-center">Town / Village</th>
                            <th class="text-center">House No</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($people as $person)

                            <tr>
                                <td class="text-center">{{$person->id}}</td>
                                <td class="text-center">{{$person->nic}}</td>
                                <td>{{$person->full_name}}</td>
                                <td class="text-center">{{$person->gndivision->name}}</td>
                                <td class="text-center">{{$person->town->name}}</td>
                                <td class="text-center"><a href="/household/view/{{$person->household->id}}"><div class="badge badge-secondary p-1 m-0 font-weight-normal">{{$person->household->house_no}}</div></a></td>
                                <td class="text-center">
                                    {!! Form::open(['url' => '/person/delete/']) !!}
                                        <a class="btn ml-lg-2 px-2 text-primary" href="/person/view/{{$person->id}}">
                                            <i class="fas fa-2x fa-chevron-circle-right"></i>
                                        </a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="7" >
                                    @foreach($person->benefits as $benefit)
                                        <div class="badge badge-primary font-weight-normal p-1" data-toggle="tooltip" data-placement="bottom" title="{{$benefit->description}} : {{$benefit->pivot->note}}">
                                            {{$benefit->name}}
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <b>Count : {{$people->total()}}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                {{$people->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
           </div>
           @endcan
        </div>
    </div>
    <style>
        #household.table tbody tr:nth-child(odd) td{
            border-bottom:none;
            padding-bottom:0px !important;
        }
        #household.table tbody tr:nth-child(odd) td:last-child{
            padding-top:0px !important;
        }
        #household.table tbody tr:nth-child(even) td{
            border-top:none;
            padding-top:0px;
        }
    </style>
@endsection


