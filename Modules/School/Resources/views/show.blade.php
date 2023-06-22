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
  <div class="card-header bg-white row m-0">
    <h4 class="col-6">School Information</h4>
    <div class="col-6 text-end">
      <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-success">+ Add Plant</a>
      <a href="{{url('school/stock/'.$school->id)}}" class="btn btn-sm btn-primary">+ Add Stock</a>
    </div>
  </div>
  <hr class="m-0">
  <div class="card-body">
    <div class="row">
      <div class="col-8 row">
      <div class="col-md-3">
        <label for="">Name</label><br>
        <span>{{$school->name}}</span>
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
        <label for="">Address</label><br>
        <span>{{$school->address}}</span>
      </div>

      <div class="col-md-3">
        <label for="">Tehsil</label><br>
        <span>{{$school->tehsil}}</span>
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
        <label for="">GPS Coordinates</label><br>
        <span>{{$school->gps_coordinate}}</span>
      </div>
      <div class="col-md-3">
        <label for="">School Gender</label><br>
        <span>{{$school->school_gender}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Name Of Male Teacher</label><br>
        <span>{{$school->no_of_male_teachers}}</span>
      </div>
      <div class="col-md-3">
        <label for="">Contact Of Female Teacher</label><br>
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
</div>


  @endsection
  @section('js')
  <script type="text/javascript">
  $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  $(".submit").click(function(e) {
  e.preventDefault();
  var plant_id = $('#p_id').val();
  var school_id = $('#school_id').val();
  var url = "{{url('school/savedata')}}";
  $.ajax({
    url: url,
    method: 'POST',
    data: {
      plant_id: plant_id,
      school_id: school_id
    },
    success: function(response) {
      if (response.success) {
        alert(response.message)
        $('#exampleModal').modal('hide');
        location.reload();
      } else {
        alert("Error")
      }
    },
    error: function(error) {
      console.log(error)
    }
  });
});
  $(document).ready(function() {
  var roles_table = $('#stock').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{url('stock')}}",
  buttons: [],
  columns: [{
  data: 'name',
  name: 'name',
  class: 'text-center'
  }, {
  data: 'costodian_number',
  name: 'costodian_number',
  class: 'text-center'
  }, {
  data: 'relation',
  name: 'relation',
  class: 'text-center'
  }, {
  data: 'filter',
  name: 'filter',
  class: 'text-center'
  }, {
  data: 'no_of_filter',
  name: 'no_of_filter',
  class: 'text-center'
  }, {
  data: 'received_date',
  name: 'received_date',
  class: 'text-center'
  }, {
  data: 'vender',
  name: 'vender',
  class: 'text-center'
  }, {
  data: 'action',
  name: 'action',
  orderable: false,
  searchable: false,
  class: 'text-center'
  }, ]
  });





    $(document).on('click', '.element', function(){
        $('.element').removeClass('extends');
        $(this).addClass('extends');

    });

   $(document).on('click', function(){
    console.log($('.element').length);
      if(!$(event.target).closest(".element").length){
        $('.element').removeClass('extends');
      }
   });






  });
  </script>
  @endsection