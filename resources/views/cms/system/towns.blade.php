@extends('layouts.app')

@section('content')

@include('navbar.system')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Towns & Villages</div>
            </div>
        </div>
        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Town / Village Name</th>
                            <th scope="col">GN Division</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($towns as $town)
                            <tr>
                                <td>{{$town->id}}</td>
                                <td>{{$town->name}}</td>
                                <td>{{$town->gndivision->number}} - {{$town->gndivision->name}}</td>
                                <td>
                                {!! Form::open(['url' => '/system/towns/rem']) !!}
                                    <input type="hidden" name="town_id" value="{{$town->id}}">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {{Form::button('+ Town / Village',['class'=>'btn btn-outline-success','data-toggle'=>'modal','data-target'=>'#townModal'])}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="townModal" tabindex="-1" role="dialog" aria-labelledby="townModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/system/towns/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Town / Village</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">GN Division</span>
                            </div>
                            <select name="gndivision_id" class="custom-select" id="inputGroupSelect01">
                                <option selected>Choose village / town...</option>
                                @foreach($gndivisions as $gndivision)
                                    <option value="{{$gndivision->id}}">{{$gndivision->number}} - {{$gndivision->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                            </div>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Name of Town / Village',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
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