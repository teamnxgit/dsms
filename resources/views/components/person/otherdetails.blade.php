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

        <!-- Martial Status-->
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
                <option value="war widow" @if($person->persondetail->maritial_status=='war widow')selected @endif>War Widow</option>
            </select>
        </div>
        <!-- End of Martial Status-->

        <!-- Date of birth-->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Date of Birth</span>
            </div>
            {{Form::date('dob',$person->persondetail->dob,['class'=>'form-control'])}}
        </div>
        <!-- End of Date of birth-->

        <!-- Ethnicity-->
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
        <!-- End of Ethnicity-->


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

        <!-- Education Level-->
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
        <!-- End of Education Level-->

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
                <option value="homeless" @if($person->persondetail->residence_status=='homeless')selected @endif>Homeless</option>
            </select>
        </div>

        <div class="input-group mb-3">
            @can('Person & Household Operator')
            {{Form::submit('Update',['class'=>'btn btn-success ml-2 '])}}
            @endcan
            {!! Form::close() !!}
        </div>

</div>