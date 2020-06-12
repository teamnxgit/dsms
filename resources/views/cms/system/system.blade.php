@extends('layouts.app')

@section('content')

@include('navbar.system')
    <div class="col-lg-12 p-3 row">
        <div class="row col-lg-12">
            <div class="col-12">
                <div class="h3">System Configuration - Person & Household</div>
            </div>
        </div>
        <hr>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-map"></i>
              <span class="count-numbers">{{$gn_divisions_count}}</span>
              <a class="count-name" href="/system/gndivisions/">GN Divisions</a>
            </div>
        </div>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-map-marked-alt"></i>
              <span class="count-numbers">{{$towns_count}}</span>
              <a class="count-name" href="/system/towns/">Towns / Villages</a>
            </div>
        </div>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-road"></i>
              <span class="count-numbers">{{$streets_count}}</span>
              <a class="count-name" href="/system/streets/">Streets</a>
            </div>
        </div>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-briefcase"></i>
              <span class="count-numbers">0</span>
              <a class="count-name" href="/system/jobs/">Jobs</a>
            </div>
        </div>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-bolt"></i>
              <span class="count-numbers">0</span>
              <a class="count-name" href="/system/jobs/">Electricity Sources</a>
            </div>
        </div>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-toilet"></i>
              <span class="count-numbers">0</span>
              <a class="count-name" href="/system/jobs/">Toilet Facilities</a>
            </div>
        </div>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-faucet"></i>
              <span class="count-numbers">0</span>
              <a class="count-name" href="/system/jobs/">Water Facilities</a>
            </div>
        </div>

        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-utensils"></i>
              <span class="count-numbers">0</span>
              <a class="count-name" href="/system/jobs/">Cooking Facilities</a>
            </div>
        </div>

    </div>
    <style>
    .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
    color:rgba(255,255,255,1);
  }
    </style>
@endsection