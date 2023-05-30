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
<form action="{{url('school/stock_store')}}" method="post">
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
                <label>Filter's Custodians</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Filter's Custodians">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Filter's Custodians Number</label>
                <input type="number" min="0" class="form-control" name="costodian_number" placeholder="Enter Filter's Custodians Number">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Relation</label>
                <input type="text" class="form-control" name="relation" placeholder="Enter Relation">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Filter</label>
                <select name="filter" id="" class="form-control select2">
                  @foreach($filters as $filter)
                  <option value="{{$filter->name}}">{{$filter->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Filters</label>
                <input type="text" class="form-control" name="no_of_filter" placeholder="Enter No of Filters">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of Stock Received</label>
                <input type="date"class="form-control" name="received_date" placeholder="Enter Filter">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Vendor</label>
                <select name="vender" id="" class="form-control select2">
                  @foreach($venders as $vender)
                  <option value="{{$vender->id}}">{{$vender->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Select School</label>
                <select name="school" id="" class="form-control select2">
                  @foreach($schools as $school)
                  <option value="{{$school->id}}">{{$school->name}}</option>
                  @endforeach
                </select>
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