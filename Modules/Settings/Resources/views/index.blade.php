@extends('layouts.template')
@section('title')
Settings
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Panel Settings</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Panel Settings</li>
        <li class="breadcrumb-item active">Panel Settings</li>
      </ol>
    </div>
  </div>
</div>
@php
$sett=$data['settings'];
$logo=url('public/img/images.png');
$favicon=url('public/img/images.png');
if($sett->portal_logo!='' AND file_exists(public_path('img/settings/'.$sett->portal_logo))){
$logo=url('public/img/settings/'.$sett->portal_logo);
}
if($sett->portal_favicon!='' AND file_exists(public_path('img/settings/'.$sett->portal_favicon))){
$favicon=url('public/img/settings/'.$sett->portal_favicon);
}
@endphp
<form action="{{url('settings/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <div class="list-group nav-tabs penal-settings" role="tablist">
                <a class="list-group-item text-center rounded-0 active" data-bs-toggle="tab" href="#main-settings" role="tab">
                 Main Settings
                </a>
                <a class="list-group-item text-center rounded-0" data-bs-toggle="tab" href="#application-logs" role="tab">
                  Application Logs
                </a>
<!--                 <a class="list-group-item text-center rounded-0" data-bs-toggle="tab" href="#cron-jobs" role="tab">
                  Cron Jobs
                </a> -->
              </div>
            </div>
            <!-- Tab panes -->
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
              <div class="tab-content">
                <div class="tab-pane active p-3" id="main-settings" role="tabpanel">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Panel Name</label>
                      <input type="text" class="form-control" name="panel_name" value="{{$sett->portal_name}}" placeholder="Panel Name">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Panel Email</label>
                      <input type="email" class="form-control" name="panel_email" value="{{$sett->portal_email}}" placeholder="Panel Email">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Panel Logo</label>
                      <input type="file" class="form-control" name="panel_logo" id="panel_logo">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Panel Favicon</label>
                      <input type="file" class="form-control" name="panel_favicon" id="panel_favicon">
                    </div>
                  </div>
                </div>
                <div class="tab-pane p-3" id="application-logs" role="tabpanel">
                  <div class="row">

                  <div class="col-md-4 form-group">
                    <label for="">Logging</label>
                    <select name="logging" class="form-control">
                      <option value="1" {{$sett->logging=='1' ? 'selected' : ''}}>Yes</option>
                      <option value="0" {{$sett->logging=='0' ? 'selected' : ''}}>No</option>
                    </select>                  
                  </div>

                    <div class="col-md-4 form-group">
                    <label for="">Logs will be deleted older Than</label>
                    <input type="number" min="1" value="{{$sett->logs_duration!=null ? $sett->logs_duration : 7}}" class="form-control" name="logs_duration" placeholder="Logs will be deleted older Than">
                  </div>
                    <div class="col-md-4 form-group">
                    <label for="">Duration type</label>
                    <select name="logs_duration_type" class="form-control">
                      <option value="days" {{$sett->logs_duration_type=='days' ? 'selected' : ''}}>Days</option>
                      <option value="weeks" {{$sett->logs_duration_type=='weeks' ? 'selected' : ''}}>Weeks</option>
                      <option value="months" {{$sett->logs_duration_type=='months' ? 'selected' : ''}}>Months</option>
                      <option value="years" {{$sett->logs_duration_type=='years' ? 'selected' : ''}}>Years</option>
                    </select>
                  </div>
                  </div>
                </div>
                <div class="tab-pane p-3" id="cron-jobs" role="tabpanel">
                  <p class="mb-0">
                    Etsy mixtape wayfarers, ethical wes anderson tofu before they
                    sold out mcsweeney's organic lomo retro fanny pack lo-fi
                    farm-to-table readymade. Messenger bag gentrify pitchfork
                    tattooed craft beer, iphone skateboard locavore carles etsy
                    salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                    Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                    mi whatever gluten-free, carles pitchfork biodiesel fixie etsy
                    retro mlkshk vice blog. Scenester cred you probably haven't
                    heard of them, vinyl craft beer blog stumptown. Pitchfork
                    sustainable tofu synth chambray yr.
                  </p>
                </div>
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
@endsection