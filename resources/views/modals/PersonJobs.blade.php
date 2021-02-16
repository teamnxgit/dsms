<div class="modal fade" id="Job-Person-Modal" tabindex="-1" role="dialog" aria-labelledby="Job-Person-Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    {!! Form::open(['url' => '/person/addjob']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Person ID</span>
                    </div>
                    <input type="text" class="form-control" readonly name="person_id" value="{{$person->id}}">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Full Name</span>
                    </div>
                    <input type="text" class="form-control" readonly name="household_number" value="{{$person->full_name}}">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Job</span>
                    </div>
                    <select name="job_id" id="" class="form-control">
                        @foreach($jobs as $job)
                            <option value="{{$job->id}}">{{$job->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Monthly Income</span>
                    </div>
                    <input type="text" class="form-control" name="income">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Note</span>
                    </div>
                    <textarea class="form-control" name="note"></textarea>
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