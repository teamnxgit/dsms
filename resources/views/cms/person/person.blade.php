@extends('layouts.app')

@section('content')

@include('navbar.person')

@can('Person & Household')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Person Details</div>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/person/update']) !!}
        
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Person Basic Details</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">ID</span>
                    </div>
                    {{Form::text('person_id',$person->id,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">GN Division</span>
                    </div>
                    {{Form::text('gn_division',$person->gndivision->name,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Village / Town</span>
                    </div>
                    <select name="town_id" id="" class="form-control">
                        @foreach($towns as $town)
                            @if($town->id==$person->town_id)
                                <option value="{{$town->id}}" selected>{{$town->name}}</option>
                            @else
                            <option value="{{$town->id}}">{{$town->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">House No</span>
                    </div>
                    <select name="household_id" id="" class="form-control">
                        @foreach($households as $household)
                            @if($household->id==$person->household_id)
                                <option value="{{$household->id}}" selected>{{$household->house_no}}</option>
                            @else
                            <option value="{{$household->id}}">{{$household->house_no}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Full Name</span>
                    </div>
                    {{Form::text('fullname',$person->full_name,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">NIC</span>
                    </div>
                    {{Form::text('nic',$person->nic,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Gender</span>
                    </div>
                    <select name="gender" id="" class="form-control">
                        <option value="M" @if($person->gender=='M')selected @endif>Male</option>
                        <option value="F" @if($person->gender=='F')selected @endif>Female</option>
                        <option value="O" @if($person->gender=='O')selected @endif>Other</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Status</span>
                    </div>
                    <select name="status" id="" class="form-control">
                        <option value="Alive" @if($person->status=='Alive')selected @endif>Alive</option>
                        <option value="Dead" @if($person->status=='Dead')selected @endif>Dead</option>
                        <option value="Abroad" @if($person->status=='Abroad')selected @endif>Abroad</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    @can('Person & Household Operator')
                    {{Form::submit('Update',['class'=>'btn btn-success ml-2 '])}}
                    
                    {!! Form::close() !!}

                    <button type="button" class="btn btn-warning ml-2 text-dark" data-toggle="modal" data-target="#Household-Person-Modal">Change GN Division</button>
                    @endcan

                    @can('Person & Household Admin')
                    {!! Form::open(['url' => '/person/rem']) !!}
                        <input type="hidden" name="person_id" value="{{$person->id}}">
                        {{Form::submit('Delete',['class'=>'btn btn-danger ml-2 '])}}
                    {!! Form::close() !!}
                    @endcan
                </div>
                
        </div>
       
        

        <!--Person Other Details-->
        @include('components.person.otherdetails')
        <!--End of Accordian -->


        <!--Person Jobs-->
        @include('accordians.PersonJobs')
        @include('modals.PersonBenefits')
        <!--End of Accordian -->

        <!--Person Disabilities-->
        @include('accordians.PersonDisabilities')
        @include('modals.PersonDisabilities')
        <!--End of Accordian -->

        <!--Person Benefits-->
        @include('accordians.PersonBenefits')
        @include('modals.PersonBenefits')
        <!--End of Accordian -->

        <!--Person Assistance-->
        @include('accordians.PersonAssistance')
        @include('modals.PersonAssistance')
        <!--End of Accordian -->

        <!--Accordian Vulnerabilities-->
        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Vulnerabilities</div>
        </div>
        <!--End of Accordian -->

        <!--Accordian Field Notes-->
        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Field Notes</div>
        </div>
        <!--End of Accordian -->
@endcan

@endsection
