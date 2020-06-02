@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">New Household</div>
            </div>
        </div>
        <hr>
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Enter the details to add new household</div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">House No</span>
                    </div>
                    {{Form::text('fullname',null,['class'=>'form-control','placeholder'=>'House No',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
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
                    <select class="custom-select" id="town" name="town_id" id="inputGroupSelect01">

                    </select>
                </div>
            
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Owner</span>
                    </div>
                    {{Form::text('fullname',null,['class'=>'form-control','placeholder'=>'NIC number of the owner',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                </div>
                <div class="input-group mb-3">
                    {{Form::submit('Save & + New Household',['class'=>'btn btn-secondary '])}}
                    {{Form::submit('Save',['class'=>'btn btn-success ml-2 '])}}
                    <a class="btn btn-primary ml-2" href="/household/update/essential/123">Next</a>
                </div>
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function(){
            $(document).on('change','#gn_division',function(event){
                event.preventDefault();
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
            });
        });
    </script>
@endsection
