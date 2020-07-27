@extends('layouts.app')

@section('content')

@include('navbar.person')

@can('Person & Household')
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h3">Person Details</div>
            </div>
        </div>
        <hr>
        {!! Form::open(['url' => '/person/update']) !!}
        
        <div class="p-3 bg-light border rounded row m-1">
            <div class="h5 col-12">Person Basic Details</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">ID</span>
                    </div>
                    {{Form::text('person_id',$person->id,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">GN Division</span>
                    </div>
                    {{Form::text('gn_division',$person->gndivision->name,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Village / Town</span>
                    </div>
                    <select name="town_id" id="" class="form-control">
                        @foreach($towns as $town)
                            @if($town->id==$person->town_id)
                                <option value="{{$town->id}}" selected>{{$town->name}}</option>
                            @else
                            <option value="{{$town->id}}">{{$town->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">House No</span>
                    </div>
                    <select name="household_id" id="" class="form-control">
                        @foreach($households as $household)
                            @if($household->id==$person->household_id)
                                <option value="{{$household->id}}" selected>{{$household->house_no}}</option>
                            @else
                            <option value="{{$household->id}}">{{$household->house_no}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Full Name</span>
                    </div>
                    {{Form::text('fullname',$person->full_name,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">NIC</span>
                    </div>
                    {{Form::text('nic',$person->nic,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Gender</span>
                    </div>
                    <select name="gender" id="" class="form-control">
                        <option value="M" @if($person->gender=='M')selected @endif>Male</option>
                        <option value="F" @if($person->gender=='F')selected @endif>Female</option>
                        <option value="O" @if($person->gender=='O')selected @endif>Other</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Status</span>
                    </div>
                    <select name="status" id="" class="form-control">
                        <option value="Alive" @if($person->status=='Alive')selected @endif>Alive</option>
                        <option value="Dead" @if($person->status=='Dead')selected @endif>Dead</option>
                        <option value="Abroad" @if($person->status=='Abroad')selected @endif>Abroad</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    @can('Person & Household Operator')
                    {{Form::submit('Update',['class'=>'btn btn-success ml-2 '])}}
                    
                    {!! Form::close() !!}

                    <button type="button" class="btn btn-warning ml-2 text-dark" data-toggle="modal" data-target="#Household-Person-Modal">Change GN Division</button>
                    @endcan

                    @can('Person & Household Admin')
                    {!! Form::open(['url' => '/person/rem']) !!}
                        <input type="hidden" name="person_id" value="{{$person->id}}">
                        {{Form::submit('Delete',['class'=>'btn btn-danger ml-2 '])}}
                    {!! Form::close() !!}
                    @endcan
                </div>
                
        </div>


        {!! Form::open(['url' => '/person/updatepersondetails']) !!}
        <div class="p-3 bg-light border rounded row m-1 mt-3">
            
            <div class="h5 col-12">Person Other Details</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">ID</span>
                    </div>
                    {{Form::text('person_id',$person->id,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Full Name</span>
                    </div>
                    {{Form::text('full_name',$person->full_name,['class'=>'form-control','readonly'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">முழுப் பெயர்</span>
                    </div>
                    {{Form::text('full_name_t',$person->persondetail->full_name_t,['class'=>'form-control','placeholder'=>''])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" name="is_head_of_family" aria-label="Checkbox for following text input" @if($person->persondetail->is_head_of_family==1)checked @endif>
                        </div>
                    </div>
                    <input type="text" class="form-control bg-light" value="Head of the Family" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name With Initials</span>
                    </div>
                    {{Form::text('name_with_initials',$person->persondetail->name_with_initials,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Driving License Number</span>
                    </div>
                    {{Form::text('driving_license',$person->persondetail->driving_license,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Passport Number</span>
                    </div>
                    {{Form::text('passport',$person->persondetail->passport,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Maritial Status</span>
                    </div>
                    <select name="maritial_status" id="" class="form-control">
                        <option value="" @if($person->persondetail->maritial_status==null)selected @endif>Select Maritial Status</option>
                        <option value="single" @if($person->persondetail->maritial_status=='single')selected @endif>Single</option>
                        <option value="married" @if($person->persondetail->maritial_status=='married')selected @endif>Married</option>
                        <option value="divorced" @if($person->persondetail->maritial_status=='divorced')selected @endif>Divorced</option>
                        <option value="separated" @if($person->persondetail->maritial_status=='separated')selected @endif>Separated</option>
                        <option value="widow" @if($person->persondetail->maritial_status=='widow')selected @endif>Widow</option>
                        <option value="widower" @if($person->persondetail->maritial_status=='widower')selected @endif>Widower</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Date of Birth</span>
                    </div>
                    {{Form::date('dob',$person->persondetail->dob,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Ethnicity</span>
                    </div>
                    <select name="ethnicity" id="" class="form-control">
                        <option value="" @if($person->persondetail->ethnicity==null)selected @endif>Select Ethnicity</option>
                        <option value="sinhalese" @if($person->persondetail->ethnicity=='sinhalese')selected @endif>Sinhalese</option>
                        <option value="srilankantamils" @if($person->persondetail->ethnicity=='srilankantamils')selected @endif>Sri Lankan Tamils</option>
                        <option value="srilankanmoors" @if($person->persondetail->ethnicity=='srilankanmoors')selected @endif>Sri Lankan Moors</option>
                        <option value="indiantamils" @if($person->persondetail->ethnicity=='indiantamils')selected @endif>Indian Tamils</option>
                        <option value="srilankanmalays" @if($person->persondetail->ethnicity=='srilankanmalays')selected @endif>Sri Lankan Malays</option>
                        <option value="burghers" @if($person->persondetail->ethnicity=='burghers')selected @endif>Burghers/Eurasian</option>
                        <option value="other" @if($person->persondetail->ethnicity=='other')selected @endif>Others</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Religion</span>
                    </div>
                    <select name="religion" id="" class="form-control">
                        <option value="" @if($person->persondetail->religion==null)selected @endif>Select Religion</option>
                        <option value="buddhist" @if($person->persondetail->religion=='buddhist')selected @endif>Buddhist</option>
                        <option value="hindu" @if($person->persondetail->religion=='hindu')selected @endif>Hindu</option>
                        <option value="muslim" @if($person->persondetail->religion=='muslim')selected @endif>Muslim</option>
                        <option value="christian" @if($person->persondetail->religion=='christian')selected @endif>Christian</option>
                        <option value="other" @if($person->persondetail->religion=='other')selected @endif>Others</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Education Level</span>
                    </div>
                    <select name="education_level" id="" class="form-control">
                        <option value="" @if($person->persondetail->education_level==null)selected @endif>Select Education Level</option>
                        <option value="noschooling" @if($person->persondetail->education_level=='noschooling')selected @endif>No Schooling</option>
                        <option value="grade1" @if($person->persondetail->education_level=='grade1')selected @endif>Grade 1</option>
                        <option value="grade2" @if($person->persondetail->education_level=='grade2')selected @endif>Grade 2</option>
                        <option value="grade3" @if($person->persondetail->education_level=='grade3')selected @endif>Grade 3</option>
                        <option value="grade4" @if($person->persondetail->education_level=='grade4')selected @endif>Grade 4</option>
                        <option value="grade5" @if($person->persondetail->education_level=='grade5')selected @endif>Grade 5</option>
                        <option value="grade6" @if($person->persondetail->education_level=='grade6')selected @endif>Grade 6</option>
                        <option value="grade7" @if($person->persondetail->education_level=='grade7')selected @endif>Grade 7</option>
                        <option value="grade8" @if($person->persondetail->education_level=='grade8')selected @endif>Grade 8</option>
                        <option value="grade9" @if($person->persondetail->education_level=='grade9')selected @endif>Grade 9</option>
                        <option value="grade10" @if($person->persondetail->education_level=='grade10')selected @endif>Grade 10</option>
                        <option value="grade11" @if($person->persondetail->education_level=='grade11')selected @endif>Grade 11</option>
                        <option value="ol" @if($person->persondetail->education_level=='ol')selected @endif>G.C.E O/L</option>
                        <option value="al" @if($person->persondetail->education_level=='al')selected @endif>G.C.E A/L</option>
                        <option value="diploma" @if($person->persondetail->education_level=='diploma')selected @endif>Diploma</option>
                        <option value="hdiploma" @if($person->persondetail->education_level=='hdiploma')selected @endif>Higher Diploma</option>
                        <option value="bdegree" @if($person->persondetail->education_level=='bdegree')selected @endif>Bachelor's Degree</option>
                        <option value="mdegree" @if($person->persondetail->education_level=='mdegree')selected @endif>Master's Degree</option>
                        <option value="mphil" @if($person->persondetail->education_level=='mphil')selected @endif>MPhil</option>
                        <option value="phd" @if($person->persondetail->education_level=='phd')selected @endif>PhD</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Mobile No</span>
                    </div>
                    {{Form::text('mobile_no',$person->persondetail->mobile_no,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Land Phone No</span>
                    </div>
                    {{Form::text('land_phone_no',$person->persondetail->land_phone_no,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    {{Form::text('email',$person->persondetail->email,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Vote List Serial Number</span>
                    </div>
                    {{Form::text('vote_list_serial',$person->persondetail->vote_list_serial,['class'=>'form-control'])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Residence Status</span>
                    </div>
                    <select name="residence_status" id="" class="form-control">
                        <option value="" @if($person->persondetail->residence_status==null)selected @endif>Residential Status</option>
                        <option value="permanent" @if($person->persondetail->residence_status=='permanent')selected @endif>Permanent</option>
                        <option value="rent" @if($person->persondetail->residence_status=='rent')selected @endif>Rent</option>
                        <option value="temporary" @if($person->persondetail->residence_status=='temporary')selected @endif>Temporary</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    @can('Person & Household Operator')
                    {{Form::submit('Update',['class'=>'btn btn-success ml-2 '])}}
                    @endcan
                    {!! Form::close() !!}
                </div>
                
        </div>

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

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Person with Disabilities</div>

        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Assistance & Benefits</div>

        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Vulnerabilities</div>

        </div>

        <div class="p-3 bg-light border rounded row m-1 mt-3">
            <div class="h5 col-12">Field Notes</div>

        </div>

        <!-- Modals --->

        <!-- Modal Add Job-->
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
@endcan

@endsection
