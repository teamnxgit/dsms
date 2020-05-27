@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">House Details of Person</div>
            </div>
        </div>
        <hr>
        <div class="p-3 bg-light border rounded row m-1">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Full Name</span>
                    </div>
                    {{Form::text('fullname',null,['class'=>'form-control disabled',"aria-describedby"=>"basic-addon1","readonly"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                    </div>
                    <label class="form-control" for="inputGroupSelect01">Is Head of Family</label>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Vote List Serial</span>
                    </div>
                    {{Form::text('namewi',null,['class'=>'form-control disabled',"aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">House No</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose House...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="2">2/A</option>
                    </select>
                    {{Form::submit('+ House',['class'=>'btn btn-outline-success ml-2'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Residence</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose Status...</option>
                        <option value="1">Own</option>
                        <option value="2">Rental</option>
                    </select>
                </div>
                
            <a class="btn btn-primary ml-2" href="/person/update/essential/123">Previous</a>
            {{Form::submit('Save',['class'=>'btn btn-success ml-2'])}}
            <a class="btn btn-primary ml-2" href="/person/update/occupation/123">Next</a>
        </div>
    </div>
@endsection
