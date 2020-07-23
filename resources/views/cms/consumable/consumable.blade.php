@extends('layouts.app')

@section('content')

@include('navbar.consumable')

@can('Consumable')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-4">
                <div class="h3">Consumable Register</div>
            </div>
        </div>
        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <h5>Consumable Item : <b>{{$consumable->name}}</b> - {{$consumable->description}}<br> 
            Page No : {{$consumable->page_no}} <br>

            @if($consumable->balance <= $consumable->minimum_level)
                <span class="text-danger font-weight-bold">Balance : {{$consumable->balance}}</h5>
            @elseif($consumable->balance <= $consumable->reorder_level)
                <span class="text-warning font-weight-bold">Balance : {{$consumable->balance}}</h5>
            @elseif($consumable->balance <= $consumable->maximum_level)
                <span class="text-success font-weight-bold">Balance : {{$consumable->balance}}</h5>
            @else
                <span class="text-primary font-weight-bold">Balance : {{$consumable->balance}}</h5>
            @endif

            <br>
           <div class="table-responsive">
                <table class="table" id="household">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Received from, or Issued to</th>
                            <th class="text-center">No. of Way-bill, Issue Note, &c</th>
                            <th class="text-center">Received</th>
                            <th class="text-center">Issued</th>
                            <th class="text-center">Balance</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            @if($transaction->type=='receive')
                                <tr class="text-danger">
                                    <td class="text-center">{{$transaction->date}}</td>
                                    <td>{{$transaction->from_or_to}}</td>
                                    <td class="text-center">{{$transaction->ref_no}}</td>
                                    <td class="text-center font-weight-bold">{{$transaction->qty}}</td>
                                    <td class="text-center "></td>
                                    <td class="text-center font-weight-bold">{{$transaction->balance}}</td>
                                    <td class="text-center font-weight-bold">
                                        @can('Consumable Admin')
                                        {!! Form::open(['url' => '/consumable/transaction/rem']) !!}
                                            <input type="hidden" name="id" value="{{$transaction->id}}">
                                            <button type="submit" class="btn ml-lg-2 btn-danger" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @else
                                <tr >
                                    <td class="text-center">{{$transaction->date}}</td>
                                    <td>{{$transaction->from_or_to}}</td>
                                    <td class="text-center">{{$transaction->ref_no}}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center font-weight-bold">{{$transaction->qty}}</td>
                                    <td class="text-center font-weight-bold">{{$transaction->balance}}</td>
                                    <td class="text-center font-weight-bold">
                                        @can('Consumable Admin')
                                        {!! Form::open(['url' => '/consumable/transaction/rem']) !!}
                                            <input type="hidden" name="id" value="{{$transaction->id}}">
                                            <button type="submit" class="btn ml-lg-2 btn-danger" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        {!! Form::close() !!}
                                        @endcan
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
        
    </div>
@endcan
@endsection