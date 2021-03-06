<!--Accordian Assistance-->
<div id="accordion-assistance">
    <div class="card border rounded m-1 mt-3">
        <div class="card-header" id="headingOne">
            <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-assistance" aria-expanded="true" aria-controls="collapseOne">
                Assistance Programs
            </h5>
        </div>
        
        <div id="collapse-assistance" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-assistance">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center">Benefit</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Note</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($person->assistances as $assistance)
                                <tr>
                                    <td class="text-center" width="11%">{{$assistance->pivot->from}}</td>
                                    <td class="text-center" width="11%">{{$assistance->pivot->to}}</td>
                                    <td class="text-center" width="20%" data-toggle="tooltip" data-placement="bottom" title="{{$assistance->description}}">{{$assistance->name}}</td>
                                    <td class="text-center">{{$assistance->value}}</td>
                                    <td class="text-center" width="35%">{{$assistance->pivot->note}}</td>
                                    <td class="text-center" width="10%">{{$assistance->pivot->status}}</td>
                                    <td class="text-center" width="15%">
                                    @can('Person & Household Operator')
                                        <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#Benefit-Person-Modal" style="display:inline;"><i class="fa fa-edit text-dark" aria-hidden="true"></i></button>
                                        {!! Form::open(['url' => '/person/assistance/rem','style'=>'display:inline']) !!}
                                            <input type="hidden" name="assistance_id" value="{{$assistance->id}}">
                                            <input type="hidden" name="person_id" value="{{$person->id}}">
                                            <button class="btn btn-danger" type="submit">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        {!! Form::close() !!}
                                    @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <td colspan="4">
                            <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#Assistance-Person-Modal">Add Assistance</button>
                            </td>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>