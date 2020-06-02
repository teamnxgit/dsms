@extends('layouts.app')

@section('content')

@include('navbar.system')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">GN Divisions</div>
            </div>
        </div>
        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gndivisions as $gndivision)
                            <tr>
                                <td>{{$gndivision->id}}</td>
                                <td>{{$gndivision->number}}</td>
                                <td>{{$gndivision->name}}</td>
                                <td>
                                {!! Form::open(['url' => '/system/gndivisions/rem']) !!}
                                    <input type="hidden" name="gn_division_id" value="{{$gndivision->id}}">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {{Form::button('+ GN Division',['class'=>'btn btn-outline-success','data-toggle'=>'modal','data-target'=>'#gnDivisionModal'])}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="gnDivisionModal" tabindex="-1" role="dialog" aria-labelledby="gnDivisionModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/system/gndivisions/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add GN Division</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Number</span>
                            </div>
                            {{Form::text('number',null,['class'=>'form-control','placeholder'=>'Identifier of GN Division',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                            </div>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Name of GN Division',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
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