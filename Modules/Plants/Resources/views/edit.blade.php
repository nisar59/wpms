@extends('layouts.template')
@section('title')
Filters
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Filters</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Filters</li>
        <li class="breadcrumb-item active">Filters</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('filters/update/'.$filters->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Filters</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Filter Name</label>
                <input type="text" class="form-control" name="name" value="{{$filters->name}}" placeholder="Enter Filter Name ">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Filter Change Frequency</label>
                <select name="filter_change_frequency" class="form-control" >
                  <option value="Monthly">Monthly</option>
                  <option value="Bimonthly">Bimonthly</option>
                  <option value="Trimonthly">Trimonthly</option>
                  <option value="Semiyearly">Semiyearly</option>
                  <option value="Yearly">Yearly</option>
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