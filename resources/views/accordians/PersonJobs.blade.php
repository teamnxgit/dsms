
<div id="accordion-jobs">
    <div class="card border rounded m-1 mt-3">
        <div class="card-header" id="headingOne">
            <h5 class="h5 col-12 pt-3 " data-toggle="collapse" data-target="#collapse-jobs" aria-expanded="true" aria-controls="collapseOne">
                Job Information
            </h5>
        </div>
        
        <div id="collapse-jobs" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-jobs">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">Job</th>
                                    <th class="text-center">Income</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($person->jobs as $job)
                                    <tr>
                                        <td class="text-center">{{$job->name}}</td>
                                        <td class="text-center">{{$job->pivot->income}}</td>
                                        <td class="text-center">{{$job->pivot->note}}</td>
                                        <td class="text-center">
                                        @can('Person & Household Operator')
                                            {!! Form::open(['url' => '/person/job/rem']) !!}
                                                <input type="hidden" name="job_id" value="{{$job->id}}">
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
                                <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#Job-Person-Modal">Add Job</button>
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>