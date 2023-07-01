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
</style>
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">School Management</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">School Management</li>
        <li class="breadcrumb-item active">School Management</li>
      </ol>
    </div>
  </div>
</div>
<div class="card card-primary">
  <div class="card-header bg-white m-0 p-0">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active fw-bold fs-5" id="school-info-tab" data-bs-toggle="tab" data-bs-target="#school-info" type="button" role="tab" aria-controls="school-info" aria-selected="true">School Information</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold fs-5" id="water-test-tab" data-bs-toggle="tab" data-bs-target="#water-test" type="button" role="tab" aria-controls="water-test" aria-selected="false">Water Test</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold fs-5" id="water-plant-tab" data-bs-toggle="tab" data-bs-target="#water-plant" type="button" role="tab" aria-controls="water-plant" aria-selected="false">Water Plant</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold fs-5" id="stock-tab" data-bs-toggle="tab" data-bs-target="#stock" type="button" role="tab" aria-controls="stock" aria-selected="false">Stock</button>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="school-info" role="tabpanel" aria-labelledby="school-info-tab">
        <div class="row">
          <div class="col-8 row">
            <div class="col-md-3">
              <label for="">Name</label><br>
              <span>{{$school->name}}</span>
            </div>
            <div class="col-md-3">
              <label for="">School Gender</label><br>
              <span>{{$school->school_gender}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Province</label><br>
              <span>{{$school->province}}</span>
            </div>
            <div class="col-md-3">
              <label for="">District</label><br>
              <span>{{$school->district}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Tehsil</label><br>
              <span>{{$school->tehsil}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Address</label><br>
              <span>{{$school->address}}</span>
            </div>
            <div class="col-md-3">
              <label for="">EMIS Code</label><br>
              <span>{{$school->emis_code}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Name Of Focal Person</label><br>
              <span>{{$school->name_of_focal_person}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Contact Of Focal Person</label><br>
              <span>{{$school->contact_of_focal_person}}</span>
            </div>
            <div class="col-md-3">
              <label for="">Relation of Focal Person</label><br>
              <span>{{$school->relation_of_focal_person}}</span>
            </div>
            <div class="col-md-3">
              <label for="">No of Students</label><br>
              <span>{{$school->no_of_students}}</span>
            </div>
            <div class="col-md-3">
              <label for="">No Of Male Teachers</label><br>
              <span>{{$school->no_of_male_teachers}}</span>
            </div>
            <div class="col-md-3">
              <label for="">No Of Female Teachers</label><br>
              <span>{{$school->no_of_female_teachers}}</span>
            </div>
          </div>
          <div class="col-4 row">
            <div class="col-12">
              <img class="element" src="{{url('img/school/'.$school->image)}}" width="100%" height="100vh">
            </div>
            <div class="col-12 mt-3 element p-0">
              <iframe width="100%" height="100%" src = "https://maps.google.com/maps?q={{$school->gps_coordinate}}&hl=es;z=14&amp;output=embed"></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="water-test" role="tabpanel" aria-labelledby="water-test-tab">
        <div class="row">
          <div class="col-md-12 text-end">
            @if($school->WaterQualityTestSampleCollected==null)
            <a href="javascript:void(0)" id="sample-collected-modal">+</a>
            @endif
          </div>
          <div class="col-md-12 text-center">
            @if($school->WaterQualityTest->count()==0)
            <h4>Pending for sample</h4>
            @else
            @foreach($school->WaterQualityTest as $wqt)
            @if($wqt->status==1)
            <a href="javascript:void(0)" data-id="{{$wqt->id}}" class="test-completed-modal border-info-left mb-2 text-dark card p-2 table-hover">
              <div class="row">
                <div class="col-6">
                  <p class="m-0"><b>Status:</b> {{WaterQualityTestStatus()[$wqt->status]}}</p>
                </div>
                <div class="col-6">
                  <p class="m-0"><b>Sample Collected Date:</b> {{\Carbon\Carbon::parse($wqt->sample_collected_date)->format('d-m-Y')}}</p>
                </div>
              </div>
            </a>
            @else
            <a href="javascript:void(0)" data-id="{{$wqt->id}}" class="test-completed-modal border-success-left mb-2 text-dark card p-2 table-hover">
              <div class="row">
                <div class="col-2">
                  <p class="m-0"><b>Sample Collected Date:</b> <br>{{\Carbon\Carbon::parse($wqt->sample_collected_date)->format('d-m-Y')}}</p>
                </div>
                <div class="col-2">
                  <p class="m-0"><b>Status:</b> <br>{{WaterQualityTestStatus()[$wqt->status]}}</p>
                </div>
                <div class="col-2">
                  <p class="m-0"><b>Test Completed Date:</b> <br>{{\Carbon\Carbon::parse($wqt->test_completed_date)->format('d-m-Y')}}</p>
                </div>
                @php
                $i=1;
                @endphp
                
                @foreach(WaterQualityTestParameters() as $key=> $wqtp)
                
                @if($i>3) @break; @endif
                @php $i=$i+1; @endphp
                @php
                $results=json_decode($wqt->results);
                $val='';
                if($results!=null && isset($results->$key)){
                $val=$results->$key;
                }
                @endphp
                <div class="col-2">
                  <p class="m-0"><b>{{$wqtp}}</b> <br>{{$val}}</p>
                </div>
                @endforeach
              </div>
            </a>
            @endif
            @endforeach
            @endif
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="water-plant" role="tabpanel" aria-labelledby="water-plant-tab">
        <div class="row">
          <div class="col-12 text-end">
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-plant">+</a>
          </div>

          <div class="col-12">

            <div class="accordion" id="accordionPlants">
              @foreach($school->SchoolPlants as $sp)
                  <div class="accordion-item card">
                    <div class="accordion-header border border-info-left" id="heading{{$sp->id}}">
                      <div class="row text-center" data-bs-toggle="collapse" data-bs-target="#collapse{{$sp->id}}" aria-expanded="false" aria-controls="collapse{{$sp->id}}">
                        <div class="col-3">
                            <p class="m-0"><b>Plant Name:</b> <br>{{$sp->Plant!=null ? $sp->Plant->name : ''}}</p>
                        </div>
                        <div class="col-3">
                          <p class="m-0"><b>Vendor:</b> <br> {{$sp->Vendor!=null ? $sp->Vendor->name : ''}}</p>
                        </div>
                        <div class="col-3">
                          <p class="m-0"><b>Estimated Cost:</b> <br> {{number_format($sp->estimated_cost)}}</p>
                        </div>
                        <div class="col-3">
                          <p class="m-0"><b>Status:</b><br> {{SchoolPlantStatus()[$sp->status]}}</p>
                        </div>
                      </div>
                    </div>
                    <div id="collapse{{$sp->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$sp->id}}" data-bs-parent="#accordionPlants">
                      <div class="accordion-body border">

                      </div>
                    </div>
                  </div>
              @endforeach

            </div>
          </div>

        </div>
      </div>
      <div class="tab-pane fade" id="stock" role="tabpanel" aria-labelledby="stock-tab">Stock</div>
    </div>
  </div>
</div>
@include('waterqualitytest::create')
@include('school::add-plant')
<div id="mdl"></div>
@endsection
@section('js')
<script>
$(document).ready(function() {
$(document).on('click', '#sample-collected-modal', function() {
$("#sample-collected").modal('show');
});
$(document).on('click', '.test-completed-modal', function() {
var id=$(this).data('id');
$.ajax({
url:"{{url('water-quality-test/edit')}}/"+id,
type:"GET",
success:function(res) {
if(res.success){
$("#mdl").html(res.data);
$("#test-completed").modal('show');
}else{
error(res.message);
}
},
error:function(err) {
console.log(err);
error(err.responseText);
}
});
});
});
</script>
@endsection