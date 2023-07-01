@extends('layouts.template')
@section('title')
Water Quality Test Parameters
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Water Quality Test Parameters</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Water Quality Test Parameters</li>
        <li class="breadcrumb-item active">Water Quality Test Parameters</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('water-quality-test-parameters/store')}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Water Quality Test Parameters</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Water Quality Test Parameters Name">
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="form-group">
                <input type="text" hidden class="form-control" id="parameter" name="parameter" placeholder="Enter Parameter">
              </div>
            </div> -->
          </div><br>
          <div class="card-footer text-end">
            <button class="btn btn-primary mr-1" type="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  @endsection
  @section('js')
  <script>
$("#name").keyup(function() {
  var Text = $(this).val();
  Text = Text.toLowerCase();
  Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
  $("#parameter").val(Text);        
})


  </script>
  @endsection
