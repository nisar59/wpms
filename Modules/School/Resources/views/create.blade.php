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
<form action="{{url('school/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Add School</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>School Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter School Name">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>Province</label>
                <select name="province" id="province" class="form-control">
                  <option value="">Select a Province</option>
                  @foreach(json_decode(ProvincesDistricts()) as $key=> $province)
                    <option value="{{$key}}" data-districts="{{json_encode($province)}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>District</label>
              <select name="district" id="district" class="form-control">
                  <option value="">Select a District</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tehsil</label>
                <input type="text" class="form-control" name="tehsil" placeholder="Enter Tehsil">
              </div>
            </div>           
            <div class="col-md-6">
              <div class="form-group">
                <label>Address</label>
                <input type="text"  name="address"  class="form-control" placeholder="Enter Address">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>GPS Coordinates</label>
                <input type="text" class="form-control" name="gps_coordinate" placeholder="Enter GPS Coordinates ">
              </div>
            </div>            
           <div class="col-md-6">
              <div class="form-group">
                <label>EMIS Code</label>
                <input type="text"  name="emis_code"  class="form-control" placeholder="Enter EMIS Code">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Name of Focal Person</label>
                <input type="text" class="form-control" name="name_of_focal_person" placeholder="Enter Name of Focal Person">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>Contact of Focal Person</label>
                <input type="text"  name="contact_of_focal_person" class="form-control" placeholder="Enter Contact of Focal Person">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Relation of Focal Persion</label>
              <select name="relation_of_focal_person" id="relation_of_focal_person" class="form-control">
                  <option value="">Select a Relation</option>
                    @foreach(FocalPersonRelation() as $fprkey=> $fpr)
                      <option value="{{$fprkey}}">{{$fpr}}</option>
                    @endforeach
                </select>
              </div>
            </div>            
           <div class="col-md-6">
              <div class="form-group">
                <label>School Gender</label>
                <select name="school_gender" class="form-control" >
                  <option value="">Select Gender</option>
                  @foreach(SchoolGender() as $sgkey=>$sg)
                    <option value="{{$sgkey}}">{{$sg}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Students</label>
                <input type="number" class="form-control" name="no_of_students" placeholder="Enter No of Students">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Male Teachers</label>
                <input type="number" class="form-control" name="no_of_male_teachers" placeholder="Enter No of Male Teachers">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>No of Female Teachers</label>
                <input type="number"  name="no_of_female_teachers" min="0"  class="form-control" placeholder="Enter No of Female Teachers">
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group">
                <label>School Picture</label>
                <input type="file"  name="image"  class="form-control">
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

@section('js')
<script>
  $(document).ready(function() {
    $(document).on('change','#province', function() {
      var dis=$(this).find('option:selected').data('districts');

      var dis_html='<option value="">Select District</option>';

      $.each(dis, function(index, vlu) {
       dis_html+='<option value="'+vlu.Name+'">'+vlu.Name+'</option>';
      })

      $("#district").html(dis_html);
    });


    });

</script>
@endsection

