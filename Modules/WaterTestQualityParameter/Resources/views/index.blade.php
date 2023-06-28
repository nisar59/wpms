@extends('layouts.template')
@section('title')
Water Test Quality Parameter
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Water Test Quality Parameter</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Water Test Quality Parameter</li>
        <li class="breadcrumb-item active">Water Test Quality Parameter</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Water Test Quality Parameter</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('water-test-quality-parameter/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="watertestqualityparameter" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Name</th>
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
  var roles_table = $('#watertestqualityparameter').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('water-test-quality-parameter')}}",
              buttons:[],
              columns: [
                {data: 'name', name: 'name',class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
