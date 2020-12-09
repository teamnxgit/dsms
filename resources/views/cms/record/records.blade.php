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
                <div class="h3">Records - Bundles</div>
            </div>
            <div class="col-4 text-right">
                <a class="btn btn-success text-light" href="/record/bundle/new/">+ New Bundle</a>
            </div>
        </div>
        <hr>

        <div class="p-3 bg-light border rounded row m-1 mt-3 col-lg-12">
            <div class="h5 col-12">Search Bundles or Documents</div>
            {!! Form::open(['url' => '/records','class' => 'col-lg-12 row']) !!}
                {{Form::label('search',null,['class'=>'col-lg-1 pt-1'])}}
                {{Form::text('keyword',$keyword,['class'=>'form-control col-lg-9 mb-2','placeholder'=>'Search Bundle | Document'])}}
                {{Form::submit('Search',['class'=>'btn btn-primary col-lg-1 ml-lg-2 mb-2'])}}
            {!! Form::close() !!}
        </div>
        
    @foreach($bundles as $bundle)
        <div class="card mb-3 m-3" id="bundle-{{$bundle->id}}" style="max-width: 18rem;">
            <script>
            $('#bundle-{{$bundle->id}}').css("background-color",hexToRgbA('{{$bundle->color}}'));
            </script>
            <div class="card-header"><a href="/record/bundle/view/{{$bundle->id}}" class="text-dark"><b>Bundle ({{$bundle->number}})</b> - {{$bundle->serial_no}}</a></div>
            <div class="card-body">
                <h5 class="card-title">{{$bundle->name}} ({{$bundle->year}})</h5>
                <p class="card-text">{{$bundle->note}}</p>
                <button class="btn " data-toggle="modal" data-target="#Edit-Bundle-Modal" onclick="
                $('#Edit-Bundle-Modal #bundle_id').val('{{$bundle->serial_no}}');
                $('#Edit-Bundle-Modal #id').val('{{$bundle->id}}');
                $('#Edit-Bundle-Modal #name').val('{{$bundle->name}}');
                $('#Edit-Bundle-Modal #number').val('{{$bundle->number}}');
                $('#Edit-Bundle-Modal #year').val('{{$bundle->year}}');
                $('#Edit-Bundle-Modal #branch').val('{{$bundle->branch}}');
                $('#Edit-Bundle-Modal #color').val('{{$bundle->color}}');
                $('#Edit-Bundle-Modal #note').val('{{$bundle->note}}');
                ">
                <i class="fas fa-pencil"></i>  Bundle</button>
                <button class="btn " data-toggle="modal" data-target="#New-Bundle-Modal" onclick="
                $('#New-Bundle-Modal #bundle_id').val('{{$bundle->serial_no}}');
                $('#New-Bundle-Modal #id').val('{{$bundle->id}}');
                "><i class="fas fa-plus"></i> Document</button>
                <div class="list-group">
                    @foreach($bundle->documents as $document)
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5>{{$document->number}}</h5>
                        <p><b>{{$document->name}}</b> - ({{$document->year}}) <br> {{$document->decription}}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    
    @isset($documents)

    @foreach($documents as $document)
    
    @foreach($document->bundle as $bundle)
    
        <div class="card mb-3 m-3" id="bundle-{{$bundle->id}}" style="max-width: 18rem;">
            <script>
            $('#bundle-{{$bundle->id}}').css("background-color",hexToRgbA('{{$bundle->color}}'));
            </script>
            <div class="card-header"><a href="/record/bundle/view/{{$bundle->id}}" class="text-dark"><b>Bundle ({{$bundle->number}})</b> - {{$bundle->serial_no}}</a></div>
            <div class="card-body">
                <h5 class="card-title">{{$bundle->name}} ({{$bundle->year}})</h5>
                <p class="card-text">{{$bundle->note}}</p>
                <button class="btn " data-toggle="modal" data-target="#Edit-Bundle-Modal" onclick="
                $('#Edit-Bundle-Modal #bundle_id').val('{{$bundle->serial_no}}');
                $('#Edit-Bundle-Modal #id').val('{{$bundle->id}}');
                $('#Edit-Bundle-Modal #name').val('{{$bundle->name}}');
                $('#Edit-Bundle-Modal #number').val('{{$bundle->number}}');
                $('#Edit-Bundle-Modal #year').val('{{$bundle->year}}');
                $('#Edit-Bundle-Modal #branch').val('{{$bundle->branch}}');
                $('#Edit-Bundle-Modal #color').val('{{$bundle->color}}');
                $('#Edit-Bundle-Modal #note').val('{{$bundle->note}}');
                ">
                <i class="fas fa-pencil"></i>  Bundle</button>
                <button class="btn " data-toggle="modal" data-target="#New-Bundle-Modal" onclick="
                $('#New-Bundle-Modal #bundle_id').val('{{$bundle->serial_no}}');
                $('#New-Bundle-Modal #id').val('{{$bundle->id}}');
                "><i class="fas fa-plus"></i> Document</button>
                <div class="list-group">
                    @foreach($bundle->documents as $document)
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5>{{$document->number}}</h5>
                        <p><b>{{$document->name}}</b> - ({{$document->year}}) <br> {{$document->decription}}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    @endforeach
    @endisset

</div>

<!-- Modal New Document-->
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

                <input type="hidden" class="form-control" id="id" readonly name="id" value="">

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
                        <span class="input-group-text">Document Year</span>
                    </div>
                    <input type="text" class="form-control"  name="year" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Description</span>
                    </div>
                    <textarea type="text" class="form-control"  name="decription" rows="3"></textarea>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Color</span>
                    </div>
                    <input type="color" class="form-control"  name="color" value="#FFFF00">
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

<!-- Modal Edit Bundle-->
<div class="modal fade" id="Edit-Bundle-Modal" tabindex="-1" role="dialog" aria-labelledby="Edit-Bundle-Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    {!! Form::open(['url' => '/record/bundle/update']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Bundle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="id" readonly name="id" value="">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Bundle Serial</span>
                    </div>
                    <input type="text" class="form-control" id="bundle_id" name="bundle_id" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Name</span>
                    </div>
                    <input type="text" class="form-control" id="name" name="name" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Number</span>
                    </div>
                    <input type="text" class="form-control" id="number" name="number" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Year</span>
                    </div>
                    <input type="text" class="form-control" id="year" name="year" value="">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Description</span>
                    </div>
                    <textarea type="text" class="form-control" id="note" name="decription" rows="3"></textarea>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Document Color</span>
                    </div>
                    <input type="color" class="form-control"  name="color" id="color" value="#FFFF00">
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


@endcan


@endsection