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
<div class="card card-primary">
  <div class="card-header bg-white m-0 p-0">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active fw-bold fs-5" id="school-info-tab" data-bs-toggle="tab" data-bs-target="#school-info" type="button" role="tab" aria-controls="school-info" aria-selected="true">School Information</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold fs-5" id="water-test-tab" data-bs-toggle="tab" data-bs-target="#water-test" type="button" role="tab" aria-controls="water-test" aria-selected="false">Water Test</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold fs-5" id="water-plant-tab" data-bs-toggle="tab" data-bs-target="#water-plant" type="button" role="tab" aria-controls="water-plant" aria-selected="false">Water Plant</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold fs-5" id="stock-tab" data-bs-toggle="tab" data-bs-target="#stock" type="button" role="tab" aria-controls="stock" aria-selected="false">Stock</button>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="school-info" role="tabpanel" aria-labelledby="school-info-tab">
        <div class="row">
          <div class="col-8 row">
            <div class="col-md-3">
              <label for="">Name</label><br>
              <span>{{$school->name}}</span>
            </div>
            <div class="col-md-3">
              <label for="">School Gender</label><br>
              <span>{{$school->school_gender}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Province</label><br>
              <span>{{$school->province}}</span>
            </div>
            <div class="col-md-3">
              <label for="">District</label><br>
              <span>{{$school->district}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Tehsil</label><br>
              <span>{{$school->tehsil}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Address</label><br>
              <span>{{$school->address}}</span>
            </div>
            <div class="col-md-3">
              <label for="">EMIS Code</label><br>
              <span>{{$school->emis_code}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Name Of Focal Person</label><br>
              <span>{{$school->name_of_focal_person}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Contact Of Focal Person</label><br>
              <span>{{$school->contact_of_focal_person}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Relation of Focal Person</label><br>
              <span>{{$school->relation_of_focal_person}}</span>
            </div>
            <div class="col-md-3">
              <label for="">No of Students</label><br>
              <span>{{$school->no_of_students}}</span>
            </div>
            <div class="col-md-3">
              <label for="">No Of Male Teachers</label><br>
              <span>{{$school->no_of_male_teachers}}</span>
            </div>
            <div class="col-md-3">
              <label for="">No Of Female Teachers</label><br>
              <span>{{$school->no_of_female_teachers}}</span>
            </div>
          </div>
          <div class="col-4 row">
            <div class="col-12">
              <img class="element" src="{{url('img/school/'.$school->image)}}" width="100%" height="100vh">
            </div>
            <div class="col-12 mt-3 element p-0">
              <iframe width="100%" height="100%" src = "https://maps.google.com/maps?q={{$school->gps_coordinate}}&hl=es;z=14&amp;output=embed"></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="water-test" role="tabpanel" aria-labelledby="water-test-tab">
        <div class="row">
          <div class="col-md-12 text-end">
            <a href="javascript::void(0)" id="water-test-modal">+</a>
          </div>
          <div class="col-md-12 text-center">
            <h4>Pending for sample</h4>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="water-plant" role="tabpanel" aria-labelledby="water-plant-tab">Water Plant</div>
      <div class="tab-pane fade" id="stock" role="tabpanel" aria-labelledby="stock-tab">Stock</div>
    </div>
  </div>
</div>

@include('school::includes.sample-collected')

@endsection
@section('js')
<script>
$(document).ready(function() {
  $(document).on('click', '#water-test-modal', function() {
        $("#sample-collected").modal('show');
  });

});
</script>
@endsection