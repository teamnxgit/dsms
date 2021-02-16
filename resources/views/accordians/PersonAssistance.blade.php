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
                                <th class="text-center">Note</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($person->assistances as $assistance)
                                <tr>
                                    <td class="text-center">{{$assistance->pivot->date}}</td>
                                    <td class="text-center">{{$assistance->program}} : {{$assistance->name}}</td>
                                    <td class="text-center">{{$assistance->value}}</td>
                                    <td class="text-center">{{$assistance->pivot->note}}</td>
                                    <td class="text-center">{{$assistance->pivot->current_status}}</td>
                                    <td class="text-center">
                                    @can('Person & Household Operator')
                                        {!! Form::open(['url' => '/person/rembenefit']) !!}
                                            <input type="hidden" name="benefit_id" value="{{$benefit->id}}">
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