@extends('layouts.app')

@section('content')

@include('navbar.system')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Streets / Lanes</div>
            </div>
        </div>
        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">GN Division</th>
                            <th scope="col">Town / Village</th>
                            <th scope="col">Street / Lane Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($streets as $street)
                            <tr>
                                <td>{{$street->id}}</td>
                                <td>{{$street->gn_division->name}}</td>
                                <td>{{$street->town->name}}</td>
                                <td>{{$street->name}}</td>
                                <td>
                                {!! Form::open(['url' => '/system/streets/rem']) !!}
                                    <input type="hidden" name="street_id" value="{{$stret->id}}">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {{Form::button('+ Street / Lane',['class'=>'btn btn-outline-success','data-toggle'=>'modal','data-target'=>'#gnDivisionModal'])}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="gnDivisionModal" tabindex="-1" role="dialog" aria-labelledby="gnDivisionModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/system/streets/add']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Street / Lane</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">GN Division</span>
                            </div>
                            <select name="gndivision_id" class="custom-select" id="gn_division">
                                <option selected>Choose GN Division</option>
                                @foreach($gndivisions as $gndivision)
                                    <option value="{{$gndivision->id}}">{{$gndivision->number}} - {{$gndivision->name}}</option>
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
                                <span class="input-group-text" id="road">Name</span>
                            </div>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Name of Street / Lane',"aria-label"=>"Full Name","aria-describedby"=>"basic-addon1"])}}
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GPS</span>
                            </div>
                            <textarea name="gps" class="form-control" aria-label="With textarea"></textarea>
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