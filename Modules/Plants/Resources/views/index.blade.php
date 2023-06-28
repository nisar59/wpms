@extends('layouts.template')
@section('title')
Plants 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Plants</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Plants</li>
        <li class="breadcrumb-item active">Plants</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Plants</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('plants/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="plants" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Plant Type</th>
                <th>Filters</th>
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
  var roles_table = $('#plants').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('plants')}}",
              buttons:[],
              columns: [
                {data: 'name', name: 'name',class:'text-center'},
                {data: 'filters', name: 'filters',class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
