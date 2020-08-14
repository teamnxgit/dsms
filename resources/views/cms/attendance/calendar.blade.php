@extends('layouts.app')

@section('content')

@include('navbar.attendance')


    <div class="col-lg-12 p-3">
    
        <div class="row">
        @can('Person & Household')
            <div class="col-4">
                <div class="h3">Calendar {{date('Y')}}</div>
            </div>
        </div>
        <hr>

        <div id="calendar-row-1" class="row col-lg-12">
        @php
            $months=['January','February','March','April','May','June','July','August','September','October','November','December'];
        @endphp

        @foreach($months as $month)
            <div id="calendar-{{$month}}" class="col-lg-4 mt-3">
                <h6 class="bg-dark text-light p-2 mb-0">{{$month}}</h6>
                <!--Print Week Header-->
                <ul class="weekdays font-weight-bold">
                    <li>Mo</li>
                    <li>Tu</li>
                    <li>We</li>
                    <li>Th</li>
                    <li>Fr</li>
                    <li class="text-danger">Sa</li>
                    <li class="text-danger">Su</li>
                </ul>
               
                <ul class="days">
                     <!--Print space for First Day-->
                    @if($January[0]->day==='Tuesday')
                        <li>00</li>
                    @elseif($January[0]->day==='Wednesday')
                        <li></li><li></li>
                    @elseif($January[0]->day==='Thursday')
                        <li>&nbsp;&nbsp;</li><li></li><li></li>
                    @elseif($January[0]->day==='Friday')
                        <li></li><li></li><li></li><li></li>
                    @elseif($January[0]->day==='Saturday')
                        <li></li><li></li><li></li><li></li><li></li>
                    @elseif($January[0]->day==='Sunday')
                        <li></li><li></li><li></li><li></li><li></li><li></li>
                    @endif

                    <!--Print Month Days-->
                    @foreach(${$month} as $date)
                        @php $date_day = date_create($date->date)->format("d") @endphp
                        <li data-toggle="popover" title="{{$date->note}}" 
                            @if($date->is_working_day==0)
                                @if($date->day=='Saturday')
                                    class="text-danger"
                                @elseif($date->day=='Sunday')
                                    class="text-danger"
                                @else
                                    class="bg-danger text-light rounded-circle"
                                @endif
                            @endif>{{$date_day}}</li>
                    @endforeach
                </ul>
            </div> 
            @endforeach
        </div>
        @endcan
        </div>
    </div>
    <style>

.weekdays {
  margin: 0;
  padding: 10px 0;
  background-color: #ddd;
}

.weekdays li {
  display: inline-block;
  width: 13%;
  color: #666;
  text-align: center;
}
.days {
  padding: 10px 0;
  background: #eee;
  margin: 0;
  text-align:left;
}
.days li {
  list-style-type: none;
  display: inline-block;
  width: 13%;
  min-height:19px;
  text-align: center;
  margin-bottom: 5px;
  font-size:12px;
  color: #777;
}
.days li:hover{
  cursor: pointer;
}

.days li.active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

.days li a{
  color: #333;
}

.days li.text-danger a{
  color: red;
}

.days li.text-light a{
  color: white;
}
</style>
@endsection


