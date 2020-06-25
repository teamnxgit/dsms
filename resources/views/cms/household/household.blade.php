@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Household Details</div>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/household/update']) !!}
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Household Basic Details</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">ID</span>
                    </div>
                    {{Form::text('id',$household->id,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">GN Division</span>
                    </div>
                    {{Form::text('gn_division',$household->gndivision->name,['class'=>'form-control','readonly'])}}
                </div>
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">House No</span>
                    </div>
                    {{Form::text('house_no',$household->house_no,['class'=>'form-control','placeholder'=>'House No'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Village / Town</span>
                    </div>
                    <select name="town_id" id="" class="form-control">
                        @foreach($division_towns as $town)
                            @if($town->id==$household->town_id)
                                <option value="{{$town->id}}" selected>{{$town->name}}</option>
                            @else
                            <option value="{{$town->id}}">{{$town->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Street / Lane</span>
                    </div>
                    <select name="street_id" id="" class="form-control">
                        @foreach($division_streets as $street)
                            @if($street->id==$household->street_id)
                                <option value="{{$street->id}}" selected>{{$street->name}}</option>
                            @else
                            <option value="{{$street->id}}">{{$street->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Owner</span>
                    </div>
                    {{Form::text('owner',$household->owner,['class'=>'form-control','placeholder'=>'NIC Number of owner'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">GPS</span>
                    </div>
                    {{Form::text('gps',$household->gps,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    {{Form::submit('Update',['class'=>'btn btn-success ml-2 '])}}
                    {!! Form::close() !!}

                    {!! Form::open(['url' => '/household/delete']) !!}
                        <input type="hidden" name="id" value="{{$household->id}}">
                        {{Form::submit('Delete',['class'=>'btn btn-danger ml-2 '])}}
                    {!! Form::close() !!}
                </div>
                
        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3 card">
            <div class="h5 col-12">Household Members </div>
            
        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Household Vulnerabilities </div>
        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Field Notes & Household Remarks</div>
        </div>

        @foreach($facility_types as $facility_type)
        <div id="accordion">
            <div class="card border rounded m-1 mt-3">
                <div class="card-header" id="headingOne">
                    <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-{{$facility_type->shorthand}}" aria-expanded="true" aria-controls="collapseOne">
                        {{$facility_type->name}} <i class="fas fa-info float-right btn p-0 m-0"></i>
                    </h5>
                </div>
                
                <div id="collapse-{{$facility_type->shorthand}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Facility</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($household->facilities as $housefacility)
                                        @if($housefacility->type==$facility_type->id)
                                        <tr>
                                            {!! Form::open(['url' => '/household/facility/rem']) !!}
                                            <input type="hidden" name="household_id" value="{{$household->id}}">
                                            <input type="hidden" name="facility_id" value="{{$housefacility->id}}">
                                            <td>{{$housefacility->id}} - {{$housefacility->name}}</td>
                                            <td>{{$housefacility->pivot->description}}</td>
                                            <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                            {!! Form::close() !!}
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#{{$facility_type->shorthand}}-Modal">+ Add {{$facility_type->name}}</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Map</div>
        </div>
    </div>
    
    @foreach($facility_types as $facility_type)
        <!-- Modal -->
        <div class="modal fade" id="{{$facility_type->shorthand}}-Modal" tabindex="-1" role="dialog" aria-labelledby="{{$facility_type->shorthand}}-Modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/household/facility/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add {{$facility_type->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Household ID</span>
                            </div>
                            <input type="text" class="form-control" readonly name="household_id" value="{{$household->id}}">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Facility</span>
                            </div>
                            <select name="facility_id" id="" class="form-control">
                                @foreach($facilities as $facility)
                                    @if($facility->type==$facility_type->id)
                                        <option value="{{$facility->id}}">{{$facility->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea name="description" class="form-control" aria-label="With textarea" autocomplete="off"></textarea>
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
    @endforeach
    
@endsection
