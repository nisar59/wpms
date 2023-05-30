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
<hr>
<div class="card">
  <div class="card-title bg-secondary">
    <h1 class=" text-primary mt-1 badge badge-info text-center">School Management</h1>
    <div class="float-end">
      <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success">+Add Plant</a>
      <a href="{{url('school/stock/'.$school->id)}}" class="btn btn-success">+Add Stock</a>
    </div>
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
<hr>
<div class="accordion" id="accordionExample">
  @foreach($sch_plnt as $key=> $scl_plnt)
  <div class="accordion-item mb-2">
    <div class="accordion-header row" id="headingOne{{$key}}">
      <div class="col-6">
        <button class="accordion-button d-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" aria-expanded="false" aria-controls="collapseOne{{$key}}">
        {{Plants($scl_plnt->plant_id)}}
        </button>
      </div>
      <div class="col-6">
        <div class="btn-group dropstart p-3 float-end">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            @if($scl_plnt->status == 0)
            <span class="text-danger">Dead</span>
            @elseif($scl_plnt->status == 1)
            <span class="text-success">Active</span>
            @elseif($scl_plnt->status == 2)
            <span class="text-warning">Repairing</span>
            @else
            <span class="text-info">Replacement</span>
            @endif
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li >
              <a class="dropdown-item border-0 border-bottom" href="{{url('school/status/'.$scl_plnt->id.'/1')}}">Active</a></li>
              <a class="dropdown-item border-0 border-bottom" href="{{url('school/status/'.$scl_plnt->id.'/0')}}">Dead</a></li>
              <li ><a class="dropdown-item border-0 border-bottom" href="{{url('school/status/'.$scl_plnt->id.'/2')}}">Repairing</a></li>
              <li ><a class="dropdown-item border-0 border-bottom" href="{{url('school/status/'.$scl_plnt->id.'/3')}}">Replacement</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div id="collapseOne{{$key}}" class="accordion-collapse collapse" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <hr>
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <div class="row">
            <h4 class="col-md-6">Stock Management</h4>
            <div class="col-md-6 text-end">
              <a href="{{url('stock/create')}}" class="btn btn-success">+</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm table-hover table-bordered" id="stock" style="width:100%;">
              <thead class="text-center bg-primary text-white">
                <tr>
                  <th>Filter's Custodians</th>
                  <th>Filter's Custodians Number</th>
                  <th>Relation</th>
                  <th>Filter</th>
                  <th>No of Filters</th>
                  <th>Date of Stock Received</th>
                  <th>Vendor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Plant</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="row">
              <div class="col-md-12">
                <label for="">Plants</label>
                <select  id="p_id" name="plant_id" class="form-control">
                  <option value="">Select One</option>
                  @foreach($plants as $plant)
                  <option value="{{$plant->id}}">{{$plant->name}}</option>
                  @endforeach
                </select>
              </div>
              <input type="text" value="{{$school->id}}" hidden  id="school_id">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary submit">Submit</button>
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
  });
  </script>
  @endsection