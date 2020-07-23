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
            <span class="text-primary font-weight-bold">Balance : {{$consumable->balance}}</h5>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            @if(get_class($transaction)=='App\ConsumableReceive')
                                <tr class="text-danger">
                                    <td class="text-center">{{$transaction->date}}</td>
                                    <td>{{$transaction->from}}</td>
                                    <td class="text-center">{{$transaction->bill_no}}</td>
                                    <td class="text-center font-weight-bold">{{$transaction->qty_received}}</td>
                                    <td class="text-center "></td>
                                    <td class="text-center font-weight-bold">{{$transaction->balance}}</td>
                                </tr>
                            @else
                                <tr >
                                    <td class="text-center">{{$transaction->date}}</td>
                                    <td>{{$transaction->branch->name}}</td>
                                    <td class="text-center">{{$transaction->req_no}}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center font-weight-bold">{{$transaction->qty_issued}}</td>
                                    <td class="text-center font-weight-bold">{{$transaction->balance}}</td>
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