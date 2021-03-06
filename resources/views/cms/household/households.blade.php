@extends('layouts.app')

@section('content')

@include('navbar.person')
<style>
.hiddenRow {
    padding: 0 !important;
}
</style>

@can('Person & Household')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-4">
                <div class="h3">Households</div>
            </div>
            <div class="col-8 text-right">
                <a class="btn btn-primary text-light" href="household/new/">+ Add New Household</a>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/households']) !!}
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Search Household</div>
            {{Form::label('search',null,['class'=>'col-lg-1 pt-1'])}}
            {{Form::text('keyword',$keyword,['class'=>'form-control col-lg-9 mb-2','placeholder'=>'Search House No'])}}
            
            {{Form::submit('Search',['class'=>'btn btn-primary col-lg-1 ml-lg-2 mb-2'])}}
        </div>
        {!! Form::close() !!}

        <div class="p-3 bg-light border rounded row m-1 mt-3">
           <div class="table-responsive">
                <table class="table" id="household">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><i class="fas fa-users"></i></th>
                            <th class="text-center">House Number</th>
                            <th class="text-center">GN Division</th>
                            <th class="text-center">Town / Village</th>
                            <th class="text-center">Street</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($households as $household)
                            <tr data-toggle="collapse" data-target="#household-{{$household->id}}" class="accordion-toggle">
                                <td class="text-center text-primary">{{$household->people->count()}}</td>
                                <td class="text-center">{{$household->house_no}}</td>
                                <td>{{$household->gndivision->number.' '.$household->gndivision->name}}</td>
                                <td class="text-center">{{$household->town->name}}</td>
                                <td>{{$household->street->name}}</td>
                                <td class="text-center">
                                    {!! Form::open(['url' => '/household/delete/']) !!}
                                        <!--
                                        <input type="hidden" name="id" value="{{$household->id}}">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        -->
                                    
                                        <a class="btn ml-lg-2 px-2 text-primary" href="/household/view/{{$household->id}}">
                                            <i class="fas fa-2x fa-chevron-circle-right"></i>
                                        </a>
                                        
                                    {!! Form::close() !!}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="6" class="hiddenRow">
                                    <div class="accordian-body collapse table-responsive" id="household-{{$household->id}}">
                                        <table class="table">
                                            <thead class="bg-warning">
                                                <tr>
                                                    <th>NIC</th>
                                                    <th>Full Name</th>
                                                    <th>Age</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($household->people as $person)
                                                    @if($person->persondetail->is_head_of_family)
                                                    <tr class="bg-primary text-light">
                                                    @else
                                                    <tr class="alert-warning">
                                                    @endif
                                                        <td>{{$person->nic}}</td>
                                                        <td><a href="person/view/{{$person->id}}">{{$person->full_name}}</a></td>
                                                        <td>{{$person->age}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <td colspan="6">
                            <b>Count : {{$households->total()}}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                {{$households->links()}}
                            </td>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
           </div>
        </div>
    </div>
@endcan

@endsection