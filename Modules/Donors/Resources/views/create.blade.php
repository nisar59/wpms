@extends('layouts.template')
@section('title')
Donors
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Donors</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Donors</li>
        <li class="breadcrumb-item active">Donors</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('donors/store')}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Donors</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Phone Number</label>
                <input type="number" min="0" class="form-control" name="phone" placeholder="Enter Phone Number">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Countries</label>
                <select name="country" id="country-dropdown" class="form-control">
                  <option value="">-- Select Country --</option>
                  @foreach($country as $countrys)
                  <option value="{{$countrys->id}}">{{$countrys->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">States / Provinces</label>
                <select id="state-dropdown" class="form-control" name="state">
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">District</label>
                <select id="city-dropdown" class="form-control" name="district">
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Enter Address">
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
<script type="text/javascript">
$(document).ready(function() {
$('#country-dropdown').on('change', function () {
var idCountry = this.value;
$("#state-dropdown").html('');
$.ajax({
url: "{{url('donors/fetch-states')}}",
type: "POST",
data: {
country_id: idCountry,
_token: '{{csrf_token()}}'
},
dataType: 'json',
success: function (result) {
$('#state-dropdown').html('<option value="">-- Select State --</option>');
$.each(result.states, function (key, value) {
$("#state-dropdown").append('<option value="' + value
.id + '">' + value.name + '</option>');
});
}
});
})
/*------------------------------------------
--------------------------------------------
State Dropdown Change Event
--------------------------------------------
--------------------------------------------*/
$('#state-dropdown').on('change', function () {
var idState = this.value;
$("#city-dropdown").html('');
$.ajax({
url: "{{url('donors/fetch-cities')}}",
type: "POST",
data: {
state_id: idState,
_token: '{{csrf_token()}}'
},
dataType: 'json',
success: function (res) {
$('#city-dropdown').html('<option value="">-- Select City --</option>');
$.each(res.cities, function (key, value) {
$("#city-dropdown").append('<option value="' + value
.id + '">' + value.name + '</option>');
});
}
});
});
});
</script>
@endsection