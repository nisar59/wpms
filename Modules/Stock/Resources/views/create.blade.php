@extends('layouts.template')
@section('title')
Stock
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Stock</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Stock</li>
        <li class="breadcrumb-item active">Add Stock</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('stock/store')}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Add Stock</h4>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group">
                <label>School</label>
                <select name="school" id="school" class="form-control select2">
                  <option value="">Select School</option>
                  @foreach($schools as $school)
                  <option value="{{$school->id}}">{{$school->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Filter</label>
                <select name="filter" id="filter" class="form-control select2">
                  <option value="">Select Filter</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Filters</label>
                <input type="text" class="form-control" name="no_of_filter" placeholder="Enter No of Filters">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of Stock Received</label>
                <input type="date"class="form-control" name="received_date">
              </div>
            </div>
          </div>

          <div class="card-footer text-end">
            <button class="btn btn-primary mr-1" type="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  @endsection

  @section('js')
    <script>
      $(document).ready(function() {
        $(document).on('change', '#school', function() {
         var id=$(this).val();
           if(id==""){
            return false;
           }
         $.ajax({
                url:"{{url('stock/filters/')}}/"+id,
                type:"GET",
                success:function(res) {
                  if(res.success){
                    $("#filter").html(res.data);
                  }else{
                    error(res.message);
                  }
                },
                error:function(err) {
                  error(err.responseText);
                },

         });
        });

      });

    </script>
  @endsection