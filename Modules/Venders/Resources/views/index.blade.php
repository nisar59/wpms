@extends('layouts.template')
@section('title')
Vendor Management 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Vendor Management</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Vendor Management</li>
        <li class="breadcrumb-item active">Vendor Management</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
   <div class="col-12">
    <div class="card card-primary" id="filters-container">
      <div class="card-header bg-white" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <h4><i class="fas fa-filter"></i> Filters</h4>
      </div>
      <div class="card-body p-0">
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#filters-container">
          <div class="p-3 accordion-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="">Name</label>
                <input type="text" class="form-control filters" name="name" placeholder="Name">
              </div>
              <div class="col-md-4 form-group">
                <label for="">Province</label>
                <input type="text" class="form-control filters" name="province" placeholder="Province">
              </div>
              <div class="col-md-4 form-group">
                <label for="">Shop or Bunsiness Address</label>
                <input type="tezt" class="form-control filters" name="busines_address" placeholder="Shop or Bunsiness Address">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Vendor Management</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('venders/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="venders" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Province</th>
                <th>District</th>
                <th>GPS Coordinates</th>
                <th>Shop or Business Address</th>
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
@endsection
@section('js')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
  var roles_table = $('#venders').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('venders')}}",
              buttons:[],
              columns: [
                {data: 'name', name: 'name',class:'text-center'},
                {data: 'email', name: 'email',class:'text-center'},
                {data: 'phone', name: 'phone',class:'text-center'},
                {data: 'province', name: 'province',class:'text-center'},
                {data: 'district', name: 'district',class:'text-center'},
                {data: 'gps_coordinates', name: 'gps_coordinates',class:'text-center'},
                {data: 'shop_or_business_address', name: 'shop_or_business_address',class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
