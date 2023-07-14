@extends('layouts.template')
@section('title')
Water Quality Test 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Water Quality Test</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item"> Water Quality Test</li>
        <li class="breadcrumb-item active">Water Quality Test</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Water Quality Test</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('water-quality-test/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="water-quality-test" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>School Name</th>
                <th>Sample Collected Date</th>
                <th>Test Completion Date</th>
                <th>Results</th>
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
  var roles_table = $('#water-quality-test').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('water-quality-test')}}",
              buttons:[],
              columns: [
                {data: 'school_id', name: 'school_id',class:'text-center'},
                {data: 'sample_collected_date', name: 'sample_collected_date',class:'text-center'},
                {data: 'test_completed_date', name: 'test_completed_date',class:'text-center'},
                {data: 'results', name: 'results',class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
