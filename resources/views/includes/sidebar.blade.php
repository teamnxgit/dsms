
@php
if (Auth::check()) {
@endphp
    @section('sidebar')
    <div class="p-3 border-bottom border-secondary sidebar-heading">
        <img src="{{asset('images/dsms.png')}}" alt="">
    </div>

    <div class="user text-light py-3 border-bottom border-secondary row m-0">
        <div class="col-4 p-0 pl-3">
            <img class="rounded-circle" src="{{asset('images/user.jpg')}}" style="width:50px">
        </div>
        <div class="col-8 p-0">
            <h6 class="p-0 m-0">Nashath Nasik</h6> 
            <div class="pt-0 mt-0">System Admin</div>
        </div>
    </div>

    <div class="links border-bottom border-secondary py-3 text-light list-group list-group-flush">
    
        <a href="/dashbaord" class="pl-4 list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-fw fa-tachometer mr-3" aria-hidden="true"></i>Dashboard</a>

        @can('View Person')
            <a href="/person" class="pl-4 list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-fw fa-user mr-3" aria-hidden="true"></i>Person & Household</a>
        @endcan

        @can('View Attendance')
            <a href="/attendance" class="pl-4 list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-briefcase pr-2" aria-hidden="true"></i> Attendance &amp; Leave</a>
        @endcan

        @can('View Social Security')
            <a href="/household" class="pl-4 list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-fw fa-users mr-3" aria-hidden="true"></i>Social Security</a>
        @endcan

        @can('View Samurdhi')
        <a href="/socialsecurity" class="pl-4 list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-fw fa-handshake-o mr-3" aria-hidden="true"></i>Samurdhi</a>
        @endcan

        @can('View Users')
        <a href="/users" class="pl-4 list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-fw fa-user mr-3" aria-hidden="true"></i>User Accounts</a>
        @endcan
        
    </div>

    <div>
        <p class="p-2 text-center text-secondary" style="font-size:0.75rem">
            System Designed & Developed by <br>Nashath Nasik ICTA
        </p>
    </div>
@php
}
@endphp


