@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">New Person</div>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/person/add']) !!}
        <div class="p-3 bg-light border rounded row m-1">
        
            <div class="h5 col-12">Enter the details to add new person</div>
            
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
                    <label class="input-group-text" for="inputGroupSelect01">House No</label>
                </div>
                <select class="custom-select" id="household" name="household_id">
                    
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Full Name</span>
                </div>
                {{Form::text('fullname',null,['class'=>'form-control','placeholder'=>'Full Name of the person',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">NIC</span>
                </div>
                {{Form::text('nic',null,['class'=>'form-control','placeholder'=>'NIC Number',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                </div>
                <select class="custom-select" id="gender" name="gender">
                    <option selected>Choose Gender...</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Voters List Serial</span>
                </div>
                {{Form::text('vote_list_no',null,['class'=>'form-control','placeholder'=>'Voters List Serial Number',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
            </div>

            <div class="input-group mb-3">
                {{Form::submit('Save',['class'=>'btn btn-success ml-2 '])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function(){
            $(document).on('change','#gn_division',function(event){
                event.preventDefault();
                fetch_towns_households();
            });
        });

        function fetch_towns_households(){
        var gn_division = $("#gn_division").val();
            $.ajax({
                data: {gn_division_id: gn_division},
                type:'POST',
                url:"/system/towns/list",
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    $('#town').html(data);
                }
            });

            $.ajax({
                data: {gn_division_id: gn_division},
                type:'POST',
                url:"/system/households/list",
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    $('#household').html(data);
                }
            });
        }
    </script>
@endsection
