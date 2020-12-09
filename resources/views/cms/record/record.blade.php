@extends('layouts.app')

@section('content')

@include('navbar.records')

@can('Consumable')
<script>
function hexToRgbA(hex){
    var c;
    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
        c= hex.substring(1).split('');
        if(c.length== 3){
            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c= '0x'+c.join('');
        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',0.30)';
    }
    throw new Error('Bad Hex');
}
</script>

<div class="col-lg-12 p-4 pr-0 row">
        <div class="row col-lg-12">
            <div class="col-8">
                <div class="h3"><b>Bundle ({{$bundle->number}}) :</b> {{$bundle->name}} : {{$bundle->serial_no}}</div>
                <h5>Branch : {{$bundle->branch}}</h5>
                <h5>Year : {{$bundle->year}}</h5>
                <p>{{$bundle->note}}</p>
            </div>
        </div>
        <hr>
        
        @foreach($bundle->documents as $document)
        <div class="card mb-3 m-3" style="max-width: 18rem;" id="document-{{$document->id}}">
            <script>
                $('#document-{{$document->id}}').css("background-color",hexToRgbA('{{$document->color}}'));
            </script>
            <div class="card-header"><b>{{$document->number}}</b></div>
            <div class="card-body">
                <h5 class="card-title">{{$document->name}} - {{$document->year}} </h5>
                <p class="card-text">{{$document->decription}}</p>
            </div>
        </div>
        @endforeach
</div>

<!-- Modal Person-->
<div class="modal fade" id="New-Bundle-Modal" tabindex="-1" role="dialog" aria-labelledby="New-Bundle-Modal"l" aria-hidden="true">
    <div class="modal-dialog" role="document">
    {!! Form::open(['url' => '/record/document/add']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Documents to Bundle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Bundle Serial</span>
                    </div>
                    <input type="text" class="form-control" id="bundle_id" readonly name="bundle_id" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Name</span>
                    </div>
                    <input type="text" class="form-control"  name="name" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Number</span>
                    </div>
                    <input type="text" class="form-control"  name="number" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <input type="text" class="form-control"  name="year" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Description</span>
                    </div>
                    <input type="text" class="form-control"  name="decription" value="">
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
@endcan


@endsection