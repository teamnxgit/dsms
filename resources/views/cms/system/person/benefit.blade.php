@extends('layouts.app')

@section('content')

@include('navbar.system')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Benefits</div>
            </div>
        </div>

        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Program</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Value</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($benefits as $benefit)
                            <tr>
                                <td>{{$benefit->id}}</td>
                                <td>{{$benefit->program}}</td>
                                <td>{{$benefit->name}}</td>
                                <td>{{$benefit->description}}</td>
                                <td>{{$benefit->value}}</td>
                                <td>
                                {!! Form::open(['url' => '/system/benefit/rem']) !!}
                                    <input type="hidden" name="benefit_id" value="{{$benefit->id}}">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {{Form::button('+ Benefit',['class'=>'btn btn-outline-success','data-toggle'=>'modal','data-target'=>'#benefitModal'])}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="benefitModal" tabindex="-1" role="dialog" aria-labelledby="jobModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/system/benefit/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Benefit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Program</span>
                            </div>
                            {{Form::text('program',null,['class'=>'form-control','placeholder'=>'Name of the program',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Name (Type)</span>
                            </div>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Type of the benefit',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Description</span>
                            </div>
                            <textarea name="description" class="form-control" placeholder="Description about the benefit"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Value</span>
                            </div>
                            {{Form::text('value',null,['class'=>'form-control','placeholder'=>'Value of benefit',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
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