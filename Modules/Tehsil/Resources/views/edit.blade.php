@extends('layouts.template')
@section('title')
Tehsil
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Tehsil</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Tehsil</li>
        <li class="breadcrumb-item active">Tehsil</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('tehsil/update/'.$tehsil->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Tehsil</h4>
        </div>
        <div class="card-body">
          <div class="row">
             <div class="col-md-6">
              <div class="form-group">
                <label for="">Countries</label>
                <select name="country_id" id="country-dropdown" class="form-control">
                  <option value="">-- Select Country --</option>
                  @foreach($country as $countrys)
                  <option value="{{$countrys->id}}" {{ $countrys->id == $tehsil->country_id ? 'selected' : ''}}>{{$countrys->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">States / Provinces</label>
                <select name="state_id" id="state-dropdown" class="form-control">
                  @foreach($state as $states)
                  <option value="{{$states->id}}" {{ $states->id == $tehsil->state_id ? 'selected' : ''}}>{{$states->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">District</label>
                <select id="city-dropdown" class="form-control" name="district_id">
               
                @foreach($districts as $districtss)
                  <option value="{{$districtss->id}}" {{ $districtss->id == $tehsil->district_id ? 'selected' : ''}}>{{$districtss->name}}</option>
                  @endforeach
                   </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Name</label>
               <input type="text" class="form-control" name="name" value="{{$tehsil->name}}" placeholder="Enter Name">             
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
                    url: "{{url('tehsil/fetch-states')}}",
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
                    url: "{{url('tehsil/fetch-cities')}}",
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
