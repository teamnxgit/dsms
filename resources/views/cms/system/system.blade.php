@extends('layouts.app')

@section('content')

@include('navbar.system')
    <div class="col-lg-12 p-3 row">
        <div class="row col-lg-12">
            <div class="col-12">
                <div class="h3">System Configurations</div>
            </div>
        </div>
        <hr>
        @can('Person & Household Admin')
        <div class="col-lg-3 rounded">
            <div class="card-counter danger">
              <i class="fas fa-user-friends"></i>
              <span class="count-numbers">2</span>
              <a class="count-name" href="/system/person/">Person Variables</a>
            </div>
        </div>
        @endcan
        @can('Person & Household Admin')
        <div class="col-lg-3 rounded">
            <div class="card-counter primary">
              <i class="fas fa-house-user"></i>
              <span class="count-numbers">8</span>
              <a class="count-name" href="/system/household/">Household Variables</a>
            </div>
        </div>
        @endcan
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