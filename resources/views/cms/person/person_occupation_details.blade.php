@extends('layouts.app')

@section('content')

@include('navbar.person')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Occupation Details of Person</div>
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

            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Occupation</th>
                            <th scope="col">Income</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mason</td>
                            <td>Rs 30,000 - Rs. 40,000</td>
                            <td>Primary</td>
                            <td>
                                <a href="" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a href="" class="btn btn-outline-warning"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Plumbing</td>
                            <td>Rs. 5,000</td>
                            <td>Seasonal</td>
                            <td>
                                <a href="" class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a href="" class="btn btn-outline-warning"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {{Form::submit('+ Occupation',['class'=>'btn btn-outline-success'])}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <a class="btn btn-primary ml-2" href="/person/update/house/123">Previous</a>
            <a class="btn btn-primary ml-2" href="/person/update/disability/123">Next</a>
        </div>
    </div>
@endsection
