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
        <li class="breadcrumb-item">States / Provinces</li>
        <li class="breadcrumb-item active">States / Provinces</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('state/update/'.$states->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>States / Provinces</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Country</label>
                <select name="country_id" id="" class="form-control">
                  @foreach($country as $countrys)
                  <option value="{{$countrys->id}}" {{ $countrys->id == $states->country_id ? 'selected' : ''}} >{{$countrys->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{$states->name}}" placeholder="Enter Name">
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
