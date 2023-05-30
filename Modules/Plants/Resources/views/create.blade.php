@extends('layouts.template')
@section('title')
Plant
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Plant</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Plant</li>
        <li class="breadcrumb-item active">Plant</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('plants/store')}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Plant</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Filters</label>
                <select name="filters[]" class="select2 form-control" multiple >
                  @foreach($filters as $filter)
                  <option value="{{$filter->id}}">{{$filter->name}}</option>
                  @endforeach
                </select>
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
        $('select2').selectpicker();
    });
</script>
@endsection

