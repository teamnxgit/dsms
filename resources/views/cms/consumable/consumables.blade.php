@extends('layouts.app')

@section('content')

@include('navbar.consumable')

@can('Consumable')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-4">
                <div class="h3">Consumable Inventory</div>
            </div>
            <div class="col-8 text-right">
                <button class="btn btn-outline-success" data-toggle="modal" data-target="#New-Consumable-Modal">+ Add New Consumable Item</button>
            </div>
        </div>
        <hr>

        @if($low_count>0)
            <div class="p-3 alert-danger border rounded row m-1 mt-3">
                <h3>Consumables Below Low Level</h3>
            <div class="table-responsive">
                    <table class="table" id="household">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name & Description</th>
                                <th class="text-center">Page No</th>
                                <th class="text-center">Balance</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consumables as $consumable)
                                @if($consumable->balance <= $consumable->minimum_level)
                                <tr data-toggle="collapse" data-target="" class="accordion-toggle">
                                    <td class="text-center">{{$consumable->id}}</td>
                                    <td>
                                        <a href="/consumable/item/{{$consumable->id}}">{{$consumable->name}} : {{$consumable->description}}</a>
                                    </td>
                                    <td class="text-center">{{$consumable->page_no}}</td>
                                    <td class="text-center">{{$consumable->balance}}</td>
                                    <td class="text-center">
                                        {!! Form::open(['url' => '/consumable/rem/']) !!}
                                        @can('Consumable Admin')
                                        <a class="btn btn-warning" data-toggle="modal" data-target="#Consumable-Stock-Modal-{{$consumable->id}}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        
                                        <input type="hidden" name="id" value="{{$consumable->id}}">
                                        <button type="submit" class="btn ml-lg-2 btn-danger" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @endcan
                                        
                                        <a class="btn btn-success ml-lg-2 text-light" id="receive-consumable" data-toggle="modal" data-target="#Receive-Consumable-Modal" onclick="set_receive_modal('{{$consumable->id}}','{{$consumable->name}}')">
                                            <i class="fa fa-inbox-in"></i>
                                        </a>

                                        <a class="btn btn-primary ml-lg-2 text-light" id="issue-consumable" data-toggle="modal" data-target="#Issue-Consumable-Modal" onclick="set_issue_modal('{{$consumable->id}}','{{$consumable->name}}')">
                                            <i class="fa fa-inbox-out"></i>
                                        </a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                </td>
                            </tr>
                        </tfoot>
                        
                    </table>
                </div>
            </div>
        @endif

        @if($reorder_count > 0)
            <div class="p-3 alert-warning border rounded row m-1 mt-3">
                <h3>Consumables Below Reorder Level</h3>
            <div class="table-responsive">
                    <table class="table" id="household">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name & Description</th>
                                <th class="text-center">Page No</th>
                                <th class="text-center">Balance</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consumables as $consumable)
                                @if($consumable->balance > $consumable->minimum_level)
                                @if($consumable->balance <= $consumable->reorder_level)
                                <tr data-toggle="collapse" data-target="" class="accordion-toggle">
                                    <td class="text-center">{{$consumable->id}}</td>
                                    <td>
                                        <a href="/consumable/item/{{$consumable->id}}">{{$consumable->name}} : {{$consumable->description}}</a>
                                    </td>
                                    <td class="text-center">{{$consumable->page_no}}</td>
                                    <td class="text-center">{{$consumable->balance}}</td>
                                    <td class="text-center">
                                        {!! Form::open(['url' => '/consumable/rem/']) !!}
                                        @can('Consumable Admin')
                                        <a class="btn btn-warning" data-toggle="modal" data-target="#Consumable-Stock-Modal-{{$consumable->id}}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        
                                        <input type="hidden" name="id" value="{{$consumable->id}}">
                                        <button type="submit" class="btn ml-lg-2 btn-danger" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @endcan
                                        
                                        <a class="btn btn-success ml-lg-2 text-light" id="receive-consumable" data-toggle="modal" data-target="#Receive-Consumable-Modal" onclick="set_receive_modal('{{$consumable->id}}','{{$consumable->name}}')">
                                            <i class="fa fa-inbox-in"></i>
                                        </a>

                                        <a class="btn btn-primary ml-lg-2 text-light" id="issue-consumable" data-toggle="modal" data-target="#Issue-Consumable-Modal" onclick="set_issue_modal('{{$consumable->id}}','{{$consumable->name}}')">
                                            <i class="fa fa-inbox-out"></i>
                                        </a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endif
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                </td>
                            </tr>
                        </tfoot>
                        
                    </table>
                </div>
            </div>
        @endif

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <h3>All Consumables</h3>
           <div class="table-responsive">
                <table class="table" id="household">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name & Description</th>
                            <th class="text-center">Page No</th>
                            <th class="text-center">Balance</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consumables as $consumable)
                            <tr data-toggle="collapse" data-target="" class="accordion-toggle">
                                <td class="text-center">{{$consumable->id}}</td>
                                <td>
                                    <a href="/consumable/item/{{$consumable->id}}">{{$consumable->name}} : {{$consumable->description}}</a>
                                </td>
                                <td class="text-center">{{$consumable->page_no}}</td>
                                <td class="text-center">{{$consumable->balance}}</td>
                                <td class="text-center">
                                    {!! Form::open(['url' => '/consumable/rem/']) !!}
                                    @can('Consumable Admin')
                                    <a class="btn btn-warning" data-toggle="modal" data-target="#Consumable-Stock-Modal-{{$consumable->id}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    
                                    <input type="hidden" name="id" value="{{$consumable->id}}">
                                    <button type="submit" class="btn ml-lg-2 btn-danger" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endcan
                                    
                                    <a class="btn btn-success ml-lg-2 text-light" id="receive-consumable" data-toggle="modal" data-target="#Receive-Consumable-Modal" onclick="set_receive_modal('{{$consumable->id}}','{{$consumable->name}}')">
                                        <i class="fa fa-inbox-in"></i>
                                    </a>

                                    <a class="btn btn-primary ml-lg-2 text-light" id="issue-consumable" data-toggle="modal" data-target="#Issue-Consumable-Modal" onclick="set_issue_modal('{{$consumable->id}}','{{$consumable->name}}')">
                                        <i class="fa fa-inbox-out"></i>
                                    </a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6">
                            </td>
                        </tr>
                    </tfoot>
                    
                </table>
           </div>
        </div>
        
    </div>

    <!-- Consumable Items Note-->
    <div class="modal fade" id="New-Consumable-Modal" tabindex="-1" role="dialog" aria-labelledby="New-Consumable-Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/consumable/add']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Consumable Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" class="form-control" name="name" placeholder="Name of the item">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Description</span>
                        </div>
                        <textarea name="description" class="form-control" aria-label="With textarea" autocomplete="off" placeholder="Brief Description about the item"></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Page No</span>
                        </div>
                        <input type="text" class="form-control" name="page_no" placeholder="Page No in Consumable Register">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Minimum Level</span>
                        </div>
                        <input type="number" class="form-control " style="background-color:rgba(200,0,0,0.2)" name="minimum_level" placeholder="Minimum quantitny to be maintained">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text " id="basic-addon1">Reorder Level</span>
                        </div>
                        <input type="number" class="form-control" style="background-color:rgba(200,200,0,0.2)" name="reorder_level" placeholder="The level for Purchase Order">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Maximum Level</span>
                        </div>
                        <input type="number" class="form-control" style="background-color:rgba(0,200,50,0.2)" name="maximum_level" placeholder="Maximum quantitny to be maintained">
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

    @can('Consumable Admin')

    
    <!-- Consumable Received-->
    <div class="modal fade" id="Receive-Consumable-Modal" tabindex="-1" role="dialog" aria-labelledby="New-Consumable-Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/consumable/receive']) !!}
            <div class="modal-content">
                <div class="modal-header alert-success">
                    <h5 class="modal-title" id="exampleModalLabel">Receive Consumable</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">ID</span>
                        </div>
                        <input type="text" class="form-control" id="id" name="consumable_id" placeholder="ID" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name of the item" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Date</span>
                        </div>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Received From</span>
                        </div>
                        <input type="text" class="form-control" id="from" name="from" placeholder="Name of the vendor">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Bill No</span>
                        </div>
                        <input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Invoice Number">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Quantity</span>
                        </div>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Received Quantity">
                    </div>
                </div>

                <div class="modal-footer alert-success">
                    <input type="submit" class="btn btn-success" value="Receive">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <!-- Consumable Issue-->
    <div class="modal fade" id="Issue-Consumable-Modal" tabindex="-1" role="dialog" aria-labelledby="New-Consumable-Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/consumable/issue']) !!}
            <div class="modal-content">
                <div class="modal-header alert-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Issue Consumable</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">ID</span>
                        </div>
                        <input type="text" class="form-control" id="id" name="consumable_id" placeholder="ID" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name of the item" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Date</span>
                        </div>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Issue To</span>
                        </div>
                        <input name="to" id="to" class="form-control" placeholder="Receiver's Name">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Request No</span>
                        </div>
                        <input type="text" class="form-control" id="req_no" name="req_no" placeholder="Request Letter Number">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Quantity</span>
                        </div>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Received Quantity">
                    </div>
                </div>

                <div class="modal-footer alert-primary">
                    <input type="submit" class="btn btn-primary" value="Issue">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @foreach($consumables as $consumable)
    <!-- Consumable Stock Modal {{$consumable->id}}-->
    <div class="modal fade" id="Consumable-Stock-Modal-{{$consumable->id}}" tabindex="-1" role="dialog" aria-labelledby="Consumable-Stock-Modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/consumable/editstock']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Consumable Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">ID</span>
                        </div>
                        <input type="text" class="form-control" name="id" value="{{$consumable->id}}" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" class="form-control" value="{{$consumable->name}}" name="name" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Page No</span>
                        </div>
                        <input type="text" class="form-control" value="{{$consumable->page_no}}" name="page_no">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" >Minimum Level</span>
                        </div>
                        <input type="number" class="form-control" style="background-color:rgba(200,0,0,0.2)" value="{{$consumable->minimum_level}}" name="minimum_level" >
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Reorder Level</span>
                        </div>
                        <input type="number" class="form-control" style="background-color:rgba(200,200,0,0.2)" value="{{$consumable->reorder_level}}" name="reorder_level" >
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Maximum Level</span>
                        </div>
                        <input type="number" class="form-control " style="background-color:rgba(0,200,50,0.2)" value="{{$consumable->maximum_level}}" name="maximum_level" >
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Balance</span>
                        </div>
                        <input type="number" class="form-control " value="{{$consumable->balance}}" name="balance" placeholder="Quantity In-Hand">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Update">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endforeach
    @endcan
@endcan
<script>
    function set_receive_modal(id,name){
        $("#Receive-Consumable-Modal #id").val(id);
        $("#Receive-Consumable-Modal #name").val(name);
        $("#Receive-Consumable-Modal #date").val(null);
        $("#Receive-Consumable-Modal #from").val(null);
        $("#Receive-Consumable-Modal #bill_no").val(null);
        $("#Receive-Consumable-Modal #qty").val(null);
    }

    function set_issue_modal(id,name){
        $("#Issue-Consumable-Modal #id").val(id);
        $("#Issue-Consumable-Modal #name").val(name);
        $("#Issue-Consumable-Modal #date").val(null);
        $("#Issue-Consumable-Modal #to").val(null);
        $("#Issue-Consumable-Modal #req_no").val(null);
        $("#Issue-Consumable-Modal #qty").val(null);
    }

</script>
@endsection