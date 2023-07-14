@extends('layouts.template')
@section('title')
School Management
@endsection
@section('css')
<style>
.border-info-left{
border-left: 3px solid skyblue;
}
.border-success-left{
border-left: 3px solid green;
}
.table td {
     vertical-align: middle;
}

.arrow {
  width: 100%;
  display: flex;
}

.line {
  margin-top: 10px;
  width: 100%;
  background: #e6e6e6;
  height: 10px;
  float: left;
}

.point {
  width: 0;
  height: 0;
  border-top: 15px solid transparent;
  border-bottom: 15px solid transparent;
  border-left: 30px solid #e6e6e6;
  float: right;
}
.dot{
    background: red;
    height: 20px;
    width: 20px;
    position: absolute;
    margin-left: 50px;
    margin-top: 4px;
    border-radius: 50%;
}
</style>
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">School Details</h6>
    </div>
  </div>
</div>
<section class="row">
  <div class="col-8">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <img class="element" src="{{url('img/school/'.$school->image)}}" width="100%" height="100%">
          </div>
          <div class="col-8">
            <p class="badge bg-danger p-1 m-0">{{$school->school_gender}}</p>
            <h2 class="text-dark">{{$school->name}}</h2>
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <img class="element" src="{{url('img/dashboard/students-icon.png')}}">
                <p class="m-0 ms-2"><span class="fw-bold fs-4">1,420</span> <br> <span class="fw-bold">Number of Students</span></p>
              </div>
              <div class="col-6 d-flex align-items-center">
                <img class="element" src="{{url('img/dashboard/teacher.png')}}">
                <p class="m-0 ms-2"><span class="fw-bold fs-4">20</span> <br> <span class="fw-bold">Number of Teachers</span></p>
              </div>
              <div class="col-12 d-flex align-items-center mt-3">
                <img class="element" src="{{url('img/dashboard/plant type.png')}}">
                <p class="m-0 ms-2"><span>Plant Type:</span>
                @foreach($school->SchoolPlants as $sp)
                <br><span class="fw-bold">{{$sp->Plant!=null ? $sp->Plant->name : ''}}</span>
                @endforeach
              </p>
            </div>
            <div class="col-12 d-flex align-items-center mt-3">
              <img class="element" src="{{url('img/dashboard/location.png')}}">
              <p class="m-0 ms-2"><span>Location:</span>
              <br><span class="fw-bold">{{$school->address}}</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="col-4">
  <div class="card bg-primary">
    <div class="card-header text-center bg-primary rounded-circle">
      <h4 class="text-white">Focal Person</h4>
      <hr class="text-white m-0">
    </div>
    <div class="card-body">
      <div class="row text-center text-white">
        <div class="col-12">
          <h3>Raja Ashfaq Ahmad</h3>
          <p>Head of Prep School</p>
          <img class="element" src="{{url('img/dashboard/phone.png')}}">
          <p class="m-0 mt-1">Phone:</p>
          <h4>+923025869931</h4>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Water Quality Test</h6>
    </div>
  </div>
</div>
<section class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body m-0 p-0">
        <div class="row m-0">
          <div class="col-12 p-0">
            <table class="table table-striped table-sm align-items-center">
              <thead class="bg-primary text-white rounded-circle">
                <td class="fw-bold text-center">Test</td>
                <td class="fw-bold">Normal Range</td>
                @foreach($school->WaterQualityTest as $wqtkey=> $wqt)
                  @if($wqtkey==0)
                    <td class="fw-bold">Result Before <br><p class="fw-normal m-0">Test Taken on {{ \Carbon\Carbon::parse($wqt->test_completed_date)->format('jS \of F Y')}}</p></td>
                  @else                
                    <td class="fw-bold">Result After <br><p class="fw-normal m-0">Test Taken on {{ \Carbon\Carbon::parse($wqt->test_completed_date)->format('jS \of F Y')}}</p></td>
                 @endif
                @endforeach
              </thead>
                @foreach(AllWaterQualityTestParameters() as $wqtp)
                  <tr>
                    <td class="ps-3">{{$wqtp->name}}</td>
                    <td>{{$wqtp->normal_range}}</td>
                    @foreach($school->WaterQualityTest as $wqtkey=> $wqt)
                      @php
                        $res=json_decode($wqt->results);
                        $para=$wqtp->parameter;
                      @endphp
                     <td>
                      @if(isset($res->$para))
                      {{$res->$para}}
                     @endif
                   </td>
                    @endforeach
                  </tr>
                @endforeach
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Timeline</h6>
    </div>
  </div>
</div>
<section class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row m-0">
          <div class="col-4">
              <img class="element" width="100%" src="{{url('img/dashboard/05_gall.png')}}" style="border:5px solid #edebeb">
          </div>
          <div class="col-4">
              <img class="element" width="100%" src="{{url('img/dashboard/02_gall.png')}}" style="border:5px solid #edebeb">
          </div>
          <div class="col-4">
              <img class="element" width="100%" src="{{url('img/dashboard/03_gall.png')}}" style="border:5px solid #edebeb">
          </div>                    
        </div>
        <div class="row m-0 mt-3">
          <div class="col-3 p-0 m-0">
            <p class="m-0 text-center fw-bold">Water Test Taken</p>
            <div class="arrow">
              <div class="dot"></div>
              <div class="line"></div>
              <div class="point"></div>
            </div>
            <p><span class="text-danger fw-bold">01 Visit</span><br>
              <img class="element" src="{{url('img/dashboard/calendar.png')}}">
              @if($school->WaterQualityTest()->exists())
                @php
                $wqt=$school->WaterQualityTest->first()
                @endphp
               {{\Carbon\Carbon::parse($wqt->sample_collected_date)->format('M d, Y')}}
              @endif
            </p>
          </div>
          <div class="col-3 p-0 m-0">
            <p class="m-0 text-center fw-bold">Water Result</p>
            <div class="arrow">
              <div class="dot"></div>
              <div class="line"></div>
              <div class="point"></div>
            </div>
            <p><span class="text-danger fw-bold">02 Visit</span><br>
              <img class="element" src="{{url('img/dashboard/calendar.png')}}">
              @if($school->WaterQualityTest()->exists())
                @php
                $wqt=$school->WaterQualityTest->first()
                @endphp
               {{\Carbon\Carbon::parse($wqt->test_completed_date)->format('M d, Y')}}
              @endif
            </p>

          </div>
          <div class="col-3 p-0 m-0">
            <p class="m-0 text-center fw-bold">Plant Installation Started</p>
            <div class="arrow">
              <div class="dot"></div>
              <div class="line"></div>
              <div class="point"></div>
            </div>
            <p><span class="text-danger fw-bold">03 Visit</span><br>
              <img class="element" src="{{url('img/dashboard/calendar.png')}}"> 
              @if($school->SchoolPlants()->exists())
                @php
                $sp=$school->SchoolPlants->first()
                @endphp
               {{\Carbon\Carbon::parse($sp->installation_start_date)->format('M d, Y')}}
              @endif

            </p>

          </div>
          <div class="col-3 p-0 m-0">
            <p class="m-0 text-center fw-bold">Plant Installation Completed</p>
            <div class="arrow">
              <div class="dot"></div>
              <div class="line"></div>
              <div class="point"></div>
            </div>
            <p><span class="text-danger fw-bold">04 Visit</span><br>
              <img class="element" src="{{url('img/dashboard/calendar.png')}}">
              @if($school->SchoolPlants()->exists())
                @php
                $sp=$school->SchoolPlants->first()
                @endphp
               {{\Carbon\Carbon::parse($sp->installation_completion_date)->format('M d, Y')}}
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Filter Change Timeline</h6>
    </div>
  </div>
</div>
@php
$filter=$school->SchoolPlants->first()->SPF->first();
@endphp
<section class="row">
  <div class="col-12">
    <div class="card" style="border-radius: 10px;">
      <div class="card-header bg-primary text-white" style="border-radius: 10px;">
        <div class="row">
          <div class="col-6">
            <h4 class="fs-5">Filter ({{Filter($filter->filter_id)}}) Changed on {{\Carbon\Carbon::parse($filter->last_changed_date)->format('jS F Y')}}</h4>
          </div>
          <div class="col-6 text-end">
            <h4 class="fs-5">
              <span class="badge bg-danger me-2">{{$filter->frequency}}</span>
              <i class="far fa-calendar-alt me-2"></i>
              {{\Carbon\Carbon::parse($filter->next_change_date)->format('M d, Y')}}
            </h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row m-0">
          <div class="col-4">
              <img class="element" width="100%" src="{{url('img/dashboard/02_gall.png')}}" style="border:5px solid #edebeb">
          </div>
          <div class="col-4">
              <img class="element" width="100%" src="{{url('img/dashboard/04_gall.png')}}" style="border:5px solid #edebeb">
          </div>
          <div class="col-4">
              <img class="element" width="100%" src="{{url('img/dashboard/03_gall.png')}}" style="border:5px solid #edebeb">
          </div>                    
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
@section('js')
<script>
</script>
@endsection