@extends('layouts.template')
@section('title')
Districts
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Districts</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Districts</li>
        <li class="breadcrumb-item active">Districts</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('districts/store')}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Districts</h4>
        </div>
        <div class="card-body">
          <div class="row">
             <div class="col-md-6">
              <div class="form-group">
                <label for="">Countries</label>
                <select name="country_id" id="country-dropdown" class="form-control">
                  <option value="">-- Select Country --</option>
                  @foreach($country as $countrys)
                  <option value="{{$countrys->id}}">{{$countrys->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label for="">States / Provinces</label>
                <select id="state-dropdown" class="form-control" name="state_id">
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
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
                    url: "{{url('districts/fetch-states')}}",
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
 }); 
</script>
@endsection
