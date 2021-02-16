<div class="modal fade" id="Benefit-Person-Modal" tabindex="-1" role="dialog" aria-labelledby="Benefit-Person-Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    {!! Form::open(['url' => '/person/addbenefit']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Benefit</h5>
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
                        <span class="input-group-text">Benefit</span>
                    </div>
                    <select name="benefit_id" id="" class="form-control">
                        <option value="">Select the Benefit</option>
                        @foreach($benefits as $benefit)
                            <option value="{{$benefit->id}}">{{$benefit->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Date</span>
                    </div>
                    <input type="date" class="form-control" name="date">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Note</span>
                    </div>
                    <textarea class="form-control" name="note"></textarea>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Current Status</span>
                    </div>
                    <select name="current_status" id="" class="form-control">
                        <option value="">Select Current Status</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Not in Progress">Not in Progress</option>
                    </select>
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