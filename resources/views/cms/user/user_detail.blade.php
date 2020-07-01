@extends('layouts.app')

@section('content')

@can('Super Admin')
    @include('navbar.users')
        <div class="col-lg-12 p-3">
            <div class="row">
                <div class="col-12">
                    <div class="h3">User Details</div>
                </div>
            </div>
            <hr>
            <div class="p-3 bg-light border rounded row m-1">
                <div class="h5 col-12">Basic Info</div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                    </div>
                    {{Form::text('name',$user->name,['class'=>'form-control',"aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    {{Form::text('email',$user->email,['class'=>'form-control',"aria-describedby"=>"basic-addon1"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Role</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Created on</span>
                    </div>
                    {{Form::text('created_at',$user->created_at,['class'=>'form-control',"aria-describedby"=>"basic-addon1","readonly"])}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Updated on</span>
                    </div>
                    {{Form::text('updatedt_at',$user->updatedt_at,['class'=>'form-control',"aria-describedby"=>"basic-addon1","readonly"])}}
                </div>
                {{Form::button('Update Basic Info',['class'=>'btn btn-success'])}}
            </div>

            <div class="p-3 bg-light border rounded row m-1 mt-3">
                <div class="h5 col-12">Quick Password Change</div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                    </div>
                    {{Form::text('email',null,['class'=>'form-control',"aria-describedby"=>"basic-addon1"])}}
                </div>

                <button class="btn btn-success ">Change Password</button>
            </div>



            <div class="p-3 bg-light border rounded row m-1 mt-3">
                <div class="h5 col-12">User Permissions</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Permission ID</th>
                                <th scope="col">Permission</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_permissions as $user_permission)
                                <tr>
                                {!! Form::open(['url' => '/user/'.$user->id.'/rempermission']) !!}
                                    <td>{{$user_permission->id}}</td>
                                    <td>{{$user_permission->name}}</td>
                                    <td>
                                        <input type="hidden" name="permission_id" value="{{$user_permission->id}}">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </td>
                                {!! Form::close() !!}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    {{Form::button('+ Permission',['class'=>'btn btn-outline-success','data-toggle'=>'modal','data-target'=>'#userPermissionModal'])}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="userPermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/user/'.$user->id.'/addpermission']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Permission to {{$user->name}} ({{$user->role}})</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                            <div class="input-group mb-3">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Permission</label>
                                </div>
                                <select name="permission_id" class="custom-select" id="inputGroupSelect01">
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                    @endforeach
                                </select>
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
    @endsection
@else
    <div class="col-lg-12 p-3">
        <div class="row">
            <div class="col-12">
                <div class="h1 text-dark">Access Denied</div>
            </div>
        </div>
    </div>
    @endsection
@endcan
