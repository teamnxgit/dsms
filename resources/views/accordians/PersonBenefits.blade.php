<div id="accordion-benefits">
    <div class="card border rounded m-1 mt-3">
        <div class="card-header" id="headingOne">
            <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-benefits" aria-expanded="true" aria-controls="collapseOne">
                Benefits
            </h5>
        </div>
        
        <div id="collapse-benefits" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-benefits">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Benefit</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Note</th>
                                <th class="text-center">Current Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($person->benefits as $benefit)
                                <tr>
                                    <td class="text-center">{{$benefit->pivot->date}}</td>
                                    <td class="text-center">{{$benefit->program}} : {{$benefit->name}}</td>
                                    <td class="text-center">{{$benefit->value}}</td>
                                    <td class="text-center">{{$benefit->pivot->note}}</td>
                                    <td class="text-center">{{$benefit->pivot->current_status}}</td>
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
                            <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#Benefit-Person-Modal">Add Benefit</button>
                            </td>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>