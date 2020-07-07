@extends('layouts.app')

@section('content')

@include('navbar.person')

@can('Person & Household')
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

                    @can('Person & Household Admin')
                    {!! Form::open(['url' => '/household/delete']) !!}
                        <input type="hidden" name="id" value="{{$household->id}}">
                        {{Form::submit('Delete',['class'=>'btn btn-danger ml-2 '])}}
                    {!! Form::close() !!}
                    @endcan
                </div>
                
        </div>

        <div id="accordion-vulerability">
            <div class="card border rounded m-1 mt-3">
                <div class="card-header" id="headingOne">
                    <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-vulerability" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-users pt-0 pr-2 float-left btn p-0 m-0"></i> Household Members <i class="fas fa-info float-right btn p-0 m-0"></i>
                    </h5>
                </div>
                
                <div id="collapse-vulerability" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-vulerability">
                    <div class="card-body">
                        <div class="row">
                            
                        </div>
                        <button class="btn btn-outline-success mt-3" data-toggle="modal" data-target="#Field-vulnerability-Modal">+ Add Member</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="accordion-vulerability">
            <div class="card border rounded m-1 mt-3">
                <div class="card-header" id="headingOne">
                    <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-vulerability" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-exclamation-triangle pt-0 pr-2 float-left btn p-0 m-0"></i> Household Vulnerabilities <i class="fas fa-info float-right btn p-0 m-0"></i>
                    </h5>
                </div>
                
                <div id="collapse-vulerability" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-vulerability">
                    <div class="card-body">
                        <div class="row">
                            @foreach($household->vulnerable as $vulnerablity)
                            <div class="card mx-3">
                                <div class="card-body">
                                    <i class="fas fa-4x {{$vulnerablity->type->icon}} position-absolute text-danger" style="opacity: 0.2;bottom:10px;right:10px"></i>
                                    <h5 class="card-title">{{$vulnerablity->type->name}} <span class="float-right"><button class="btn btn-danger"><i class="fas fa-trash "></i></button></span></h5>
                                    <p class="card-text">{{$vulnerablity->note}}</p>
                                    
                                    <p class="blockquote-footer">
                                                                                            
                                    @can('Person & Household Admin')
                                    Updated by {{$vulnerablity->user->name}} on {{$vulnerablity->updated_at}}
                                    @endcan
                                    </p>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="btn btn-outline-success mt-3" data-toggle="modal" data-target="#Household-Vulnerability-Modal">+ Add Household Vulnerabilities</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="accordion">
            <div class="card border rounded m-1 mt-3">
                <div class="card-header" id="headingOne">
                    <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-" aria-expanded="true" aria-controls="collapseOne">
                    <i class="far fa-sticky-note pt-0 pr-2 float-left btn p-0 m-0"></i> Field Notes & Household Remarks <i class="fas fa-info float-right btn p-0 m-0"></i>
                    </h5>
                </div>
                
                <div id="collapse-" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            @foreach($household->fieldnotes as $note)
                            <div class="col-lg-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">{{$note->heading}}<span><button class="btn btn-danger float-right"><i class="fa fa-trash" aria-hidden="true"></i></button></span></h5>
                                        <p class="card-text">{{$note->note}}</p>
                                        <p class="blockquote-footer mb-0">Field Date : {{$note->field_date}}</p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        Note by : {{$note->user->name}} ({{$note->user->roles->first()->name}}) on {{$note->updated_at}}
                                        <span class="float-right">{{Helper::time_elapsed_string($note->created_at)}}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{$household->fieldnotes->links()}}
                        <button class="btn btn-outline-success mt-3" data-toggle="modal" data-target="#Field-Note-Modal">+ Add Field Note</button>
                    </div>
                </div>
            </div>
        </div>

        @foreach($facility_types as $facility_type)
        <div id="accordion">
            <div class="card border rounded m-1 mt-3">
                <div class="card-header" id="headingOne">
                    <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-{{$facility_type->shorthand}}" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas {{$facility_type->icon}} pt-0 pr-2 float-left btn p-0 m-0"></i> {{$facility_type->name}} <i class="fas fa-info float-right btn p-0 m-0"></i>
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
                                            
                                            <td>{{$housefacility->id}} - {{$housefacility->name}}</td>
                                            <td>{{$housefacility->pivot->description}}</td>
                                            <td>
                                                @can('Person & Household Admin')
                                                    {!! Form::open(['url' => '/household/facility/rem']) !!}
                                                    <input type="hidden" name="household_id" value="{{$household->id}}">
                                                    <input type="hidden" name="facility_id" value="{{$housefacility->id}}">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                            
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

        <div id="accordion-vulerability">
            <div class="card border rounded m-1 mt-3">
                <div class="card-header" id="headingOne">
                    <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-vulerability" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-map pt-0 pr-2 float-left btn p-0 m-0"></i> Map <i class="fas fa-info float-right btn p-0 m-0"></i>
                    </h5>
                </div>
                
                <div id="collapse-vulerability" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-vulerability">
                    <div class="card-body">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Modal Field Note-->
    <div class="modal fade" id="Field-Note-Modal" tabindex="-1" role="dialog" aria-labelledby="Field-Note-Modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/household/fieldnote/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Field Note</h5>
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
                                <span class="input-group-text" id="basic-addon1">Field Date</span>
                            </div>
                            <input type="date" class="form-control" name="field_date">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Heading</span>
                            </div>
                            <input type="text" class="form-control" name="heading" placeholder="About Note">
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea name="note" class="form-control" aria-label="With textarea" autocomplete="off" placeholder="Detailed diary notes"></textarea>
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

    <!-- Modal Vulnerability-->
    <div class="modal fade" id="Household-Vulnerability-Modal" tabindex="-1" role="dialog" aria-labelledby="Household-Vulnerability-Modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/household/vulnerability/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Household Vulnerablity</h5>
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
                                <span class="input-group-text" id="basic-addon1">Vulnerability</span>
                            </div>
                            <select name="vulnerablity_type_id" class="form-control">
                                @foreach($household_vulnerability_types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Note</span>
                            </div>
                            <textarea name="note" class="form-control" aria-label="With textarea" autocomplete="off" placeholder="Details about vulnerability"></textarea>
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
@endcan

@endsection
