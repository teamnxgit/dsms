@extends('layouts.app')

@section('content')

@include('navbar.system')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Household Facilities & Sources</div>
            </div>
        </div>
        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Facilities / Sources Name</th>
                            <th scope="col">Shorthand</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities as $facility)
                            <tr>
                                <td>{{$facility->id}}</td>
                                <td><i class="fas {{$facility->icon}}"></i></td>
                                <td>{{$facility->name}}</td>
                                <td>
                                {!! Form::open(['url' => '/system/facilitytype/rem']) !!}
                                    <input type="hidden" name="town_id" value="{{$facility->id}}">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {{Form::button('+ Facilities/Sources',['class'=>'btn btn-outline-success','data-toggle'=>'modal','data-target'=>'#townModal'])}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="townModal" tabindex="-1" role="dialog" aria-labelledby="townModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/system/facilitytype/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Facilities / Sources</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                            </div>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Name of Facilities / Sources',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Short Hand</span>
                            </div>
                            {{Form::text('shorthand',null,['class'=>'form-control','placeholder'=>'URL Freindly Shorthand Name',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Icon</span>
                            </div>
                            {{Form::text('icon',null,['class'=>'form-control','placeholder'=>'Fontawesome Icon',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Add">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection