@extends('layouts.template')
@section('title')
Stock Management 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Stock Management</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Stock Management</li>
        <li class="breadcrumb-item active">Stock Management</li>
      </ol>
    </div>
  </div>
</div>
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
                <th>School</th>
                <th>Filter</th>                
                <th>No of Filters</th>
                <th>Date of Stock Received</th>
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
  var roles_table = $('#stock').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('stock')}}",
              buttons:[],
              columns: [                
                {data: 'school_id', name: 'school_id',class:'text-center'},
                {data: 'filter_id', name: 'filter_id',class:'text-center'},
                {data: 'no_of_filter', name: 'no_of_filter',class:'text-center'},
                {data: 'received_date', name: 'received_date',class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
