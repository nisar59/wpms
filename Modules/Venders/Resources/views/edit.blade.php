@extends('layouts.template')
@section('title')
Vendor Management 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Vendor Management </h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Vendor Management </li>
        <li class="breadcrumb-item active">Vendor Management </li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('venders/update/'.$venders->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Vendor Management </h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{$venders->name}}" placeholder="Enter Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="{{$venders->email}}" placeholder="Enter Email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Phone</label>
                <input type="number" min="0" class="form-control" name="phone" value="{{$venders->phone}}" placeholder="Enter Phone">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Province</label>
                <!-- <input type="text" class="form-control" name="province" value="{{$venders->province}}" placeholder="Enter Province"> -->
                  <select name="province" id="province" class="form-control">
                  <option value="">Select a Province</option>
                  @foreach(json_decode(ProvincesDistricts()) as $key=> $province)
                    <option value="{{$key}}" data-districts="{{json_encode($province)}}" @if($key== $venders->province) selected @endif>{{$key}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">District</label>
                <!-- <input type="text" class="form-control" name="district" value="{{$venders->district}}" placeholder="Enter District"> -->
                <select name="district" id="district" class="form-control">
                  <option value="">Select a District</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">GPS Coordinates</label>
                <input type="text" class="form-control" name="gps_coordinates" value="{{$venders->gps_coordinates}}" placeholder="Enter GPS Coordinates">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Shop or Business Address</label>
                <input type="text" class="form-control" name="shop_or_business_address" value="{{$venders->shop_or_business_address}}" placeholder="Enter Shop or Business Address">
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
    setTimeout(function () {
      $('#province').trigger('change');
    }, 100);
    $(document).on('change','#province', function() {
      var dis=$(this).find('option:selected').data('districts');

      var dis_html='<option value="">Select District</option>';

      $.each(dis, function(index, vlu) {
        var sel="";
        if("{{$venders->district}}"==vlu.Name){
          sel="selected";
        }
       dis_html+='<option value="'+vlu.Name+'" '+sel+'>'+vlu.Name+'</option>';
      })

      $("#district").html(dis_html);
    });


    });

</script>
@endsection