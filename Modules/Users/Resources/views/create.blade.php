@extends('layouts.template')
@section('title')
Users
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Users</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">users</li>
        <li class="breadcrumb-item active">Create User</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('users/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Add Users</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Name</label>
              <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
              <label>Email</label>
              <input type="email" class="form-control" value="{{old('name')}}" name="email" placeholder="Email">
            </div>
             </div>
            <div class="row">
              <div class="form-group col-md-6 ">
              <label>Password</label>
              <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="Password">
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
@endsection