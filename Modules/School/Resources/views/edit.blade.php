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
<form action="{{url('school/update/'.$school->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>School Management</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{$school->name}}" placeholder="Enter Name">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>Province</label>
                <input type="text"  name="province" class="form-control" value="{{$school->province}}" placeholder="Enter Province">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>District</label>
                <input type="text" class="form-control" name="district" value="{{$school->district}}" placeholder="Enter District">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>Address</label>
                <input type="text"  name="address"  class="form-control" value="{{$school->address}}" placeholder="Enter Address">
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tehsil</label>
                <input type="text" class="form-control" name="tehsil" value="{{$school->tehsil}}" placeholder="Enter Tehsil">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>EMIS Code</label>
                <input type="text"  name="emis_code"  class="form-control" value="{{$school->emis_code}}" placeholder="Enter EMIS Code">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Name of Focal Person</label>
                <input type="text" class="form-control" name="name_of_focal_person" value="{{$school->name_of_focal_person}}" placeholder="Enter Name of Focal Person">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>Contact of Focal Person</label>
                <input type="number"  name="contact_of_focal_person" value="{{$school->contact_of_focal_person}}" class="form-control" placeholder="Enter Contact of Focal Person Code">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>GPS Coordinates</label>
                <input type="text" class="form-control" name="gps_coordinate" value="{{$school->gps_coordinate}}" placeholder="Enter GPS Coordinates ">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>School Gender</label>
                <select name="school_gender" class="form-control" >
                  <option value="Boys">Boys</option>
                  <option value="Girls">Girls</option>
                  <option value="Co-Education">Co-Education</option>
                </select>
              </div>
            </div>
          </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Male Teachers</label>
                <input type="number" class="form-control" name="no_of_male_teachers" value="{{$school->no_of_male_teachers}}" placeholder="Enter No of Male Teachers">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>No of Female Teachers</label>
                <input type="number"  name="no_of_female_teachers" value="{{$school->no_of_female_teachers}}" class="form-control" placeholder="Enter No of Female Teachers">
              </div>
            </div>
          </div>
          
          
          
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary mr-1" type="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection