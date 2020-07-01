@extends('layouts.app')

@section('content')

@include('navbar.person')

@can('Person & Household')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">New Household</div>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/household/new/add']) !!}
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Enter the details to add new household</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">House No</span>
                    </div>
                    {{Form::text('house_no',null,['class'=>'form-control','placeholder'=>'House No',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">GN Division</label>
                    </div>
                    <select class="custom-select" name="gn_division_id" id="gn_division">
                        <option selected>Choose Grama Niladhari Division...</option>
                        @foreach($gn_divisions as $gn_division)
                        <option value="{{$gn_division->id}}">{{$gn_division->number}} - {{$gn_division->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Village / Town</label>
                    </div>
                    <select class="custom-select" id="town" name="town_id">

                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Street / Lane</label>
                    </div>
                    <select class="custom-select" id="street" name="street_id">

                    </select>
                </div>
            
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Owner</span>
                    </div>
                    {{Form::text('owner_nic',null,['class'=>'form-control','placeholder'=>'NIC number of the owner',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-satellite"></i> GPS</span>
                    </div>
                    {{Form::text('gps',null,['class'=>'form-control','placeholder'=>'GPS Co-ordinates of the house',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-map-marker-alt"></i></button>
                    </div>
                </div>

                <div class="input-group mb-3">
                    {{Form::submit('Save',['class'=>'btn btn-success ml-2 ','name'=>'submit'])}}
                </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script type="application/javascript">
        $(document).ready(function(){
            $(document).on('change','#gn_division',function(event){
                event.preventDefault();
                fetch_towns()
            });

            $(document).on('change','#town',function(event){
                event.preventDefault();
                fetch_streets();
            });
        });

        function fetch_towns(){
        var gn_division = $("#gn_division").val();
            $.ajax({
                data: {gn_division_id: gn_division},
                type:'POST',
                url:"/system/towns/list",
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    $('#town').html(data);
                    fetch_streets();
                }
            });
        }

        function fetch_streets(){
            var town = $("#town").val();
            $.ajax({
                data: {town_id: town},
                type:'POST',
                url:"/system/streets/list",
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    $('#street').html(data);
                }
            });
        }
    </script>
    @endcan
@endsection
