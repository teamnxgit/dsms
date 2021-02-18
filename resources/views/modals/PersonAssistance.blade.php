<div class="modal fade" id="Assistance-Person-Modal" tabindex="-1" role="dialog" aria-labelledby="Assistance-Person-Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    {!! Form::open(['url' => '/person/assistance/add']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Assistance</h5>
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
                    <input type="text" class="form-control" readonly name="full_name" value="{{$person->full_name}}">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Assistance</span>
                    </div>
                    <select name="assistance_id" id="" class="form-control">
                        <option value="">Select the Assistance</option>
                        @foreach($assistances as $assistance)
                            <option value="{{$assistance->id}}">{{$assistance->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">From</span>
                    </div>
                    <input type="date" class="form-control" name="from">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                    </div>
                    <input type="date" class="form-control" name="to">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Status</span>
                    </div>
                    <select name="status" id="" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Note</span>
                    </div>
                    <textarea class="form-control" name="note"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Save">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>