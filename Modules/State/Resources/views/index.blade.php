@extends('layouts.template')
@section('title')
 States / Provinces 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">States / Provinces</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item"> States / Provinces</li>
        <li class="breadcrumb-item active">States / Provinces</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">States / Provinces</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('state/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="state" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Country</th>
                <th>State</th>
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
  var roles_table = $('#state').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('state')}}",
              buttons:[],
              columns: [
                {data: 'country_id', name: 'country_id',class:'text-center'},
                {data: 'name', name: 'name',class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
