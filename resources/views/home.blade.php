@extends('layouts.template')
@section('title')
Dashboard
@endsection
@section('content')
<!-- start page title -->
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Dashboard</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item active">Welcome to {{Settings()->portal_name}} Dashboard</li>
      </ol>
    </div>
  </div>
</div>
<!-- end page title -->
<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:#E6F2FE; border-top: 4px solid #F77C0C;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 text-white" style="background:#F77C0C;">
            <i class="fas fa-users fa-lg"></i>
          </div>
          <h5 class="fw-bold font-size-16 text-uppercase">Registered clients </h5>
          <h4 class="fw-bold font-size-24"></h4>
        </div>
        <div class="pt-2">
          <div class="float-end">
            <a href="{{url('clients')}}" class="text-dark"><i class="mdi mdi-arrow-right h5"></i></a>
          </div>
          <p class="text-dark mb-0 mt-1">Registered Clients</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:#E5DEF0; border-top: 4px solid #006BA6;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 text-white" style="background:#006BA6">
            <i class="fas fa-user-check fa-lg"></i>
          </div>
          <h5 class="fw-bold font-size-16 text-uppercase text-dark">Active clients</h5>
          <h4 class="fw-bold font-size-24"></h4>
        </div>
        <div class="pt-2">
          <div class="float-end">
            <a href="{{url('clients?active=1')}}" class="text-dark"><i class="mdi mdi-arrow-right h5"></i></a>
          </div>
          <p class="text-dark mb-0 mt-1">Active Clients</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:#D6EDD9; border-top: 4px solid #333547;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 text-white" style="background:#333547">
            <i class="fas fa-money-bill-alt fa-lg"></i>
          </div>
          <h5 class="fw-bold font-size-16 text-uppercase text-dark">Cash in hand</h5>
          <h4 class="fw-bold font-size-24"></h4>
        </div>
        <div class="pt-2">
          <div class="float-end">
            <a href="{{url('clients-subscriptions')}}" class="text-dark"><i class="mdi mdi-arrow-right h5"></i></a>
          </div>
          <p class="text-dark mb-0 mt-1">Cash In Hand</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:#F6F0D8; border-top: 4px solid #19C0CC;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 text-white" style="background:#19C0CC">
            <i class="fas fa-briefcase fa-lg"></i>
          </div>
          <h5 class="fw-bold font-size-16 text-uppercase text-dark">Deposits</h5>
          <h4 class="fw-bold font-size-24"></h4>
        </div>
        <div class="pt-2">
          <div class="float-end">
            <a href="{{url('deposits')}}" class="text-dark"><i class="mdi mdi-arrow-right h5"></i></a>
          </div>
          <p class="text-dark mb-0 mt-1">Deposits</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <h4>Subscriptions Progress</h4>
      </div>
      <div class="card-body">
        
        
        <canvas id="subscriptions-progress" height="260"></canvas>
        
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <h4>Clients By Age</h4>
      </div>
      <div class="card-body">
        
        
        <canvas id="clients-by-age" height="260"></canvas>
        
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <h4>Packages Subscriptions</h4>
      </div>
      <div class="card-body">
        
        
        <canvas id="packages-subscriptions" height="260"></canvas>
        
      </div>
    </div>
  </div>


  <div class="col-lg-6">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <h4>Deposits</h4>
      </div>
      <div class="card-body">
        
        
        <canvas id="deposits-progress" height="260"></canvas>
        
      </div>
    </div>
  </div>


  <div class="col-lg-6">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <h4>Feedback</h4>
      </div>
      <div class="card-body">
        
        
        <canvas id="feedback-progress" height="260"></canvas>
        
      </div>
    </div>
  </div>



</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
  
});
</script>
@endsection