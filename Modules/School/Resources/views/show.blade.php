@extends('layouts.template')
@section('title')
School Management
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">School Management</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">School Management</li>
        <li class="breadcrumb-item active">School Management</li>
      </ol>
    </div>
  </div>
</div>


<div class="card">
  <div class="card-title bg-secondary">
    <h2 class="text-center mt-1">School Management</h2>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        <label for="">Name :</label><br>
        <span>{{$school->name}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Province:</label><br>
        <span>{{$school->province}}</span>
      </div>
      <div class="col-md-3">
        <label for="">District :</label><br>
        <span>{{$school->district}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Address :</label><br>
        <span>{{$school->address}}</span>
      </div>
    </div>
    <hr>
     <div class="row">
      <div class="col-md-3">
        <label for="">Tehsil :</label><br>
        <span>{{$school->tehsil}}</span>
      </div>
      <div class="col-md-3">
        <label for="">EMIS Code:</label><br>
        <span>{{$school->emis_code}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Name Of Focal Person :</label><br>
        <span>{{$school->name_of_focal_person}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Contact Of Focal Person :</label><br>
        <span>{{$school->contact_of_focal_person}}</span>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-3">
        <label for="">GPS Coordinates :</label><br>
        <span>{{$school->gps_coordinate}}</span>
      </div>
      <div class="col-md-3">
        <label for="">School Gender:</label><br>
        <span>{{$school->school_gender}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Name Of Male Teacher :</label><br>
        <span>{{$school->no_of_male_teachers}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Contact Of Female Teacher :</label><br>
        <span>{{$school->no_of_female_teachers}}</span>
      </div>
    </div>
    <hr>


  </div>
</div>
@endsection