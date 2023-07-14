@extends('layouts.template')
@section('title')
Water Quality Test 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Water Quality Test</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item"> Water Quality Test</li>
        <li class="breadcrumb-item active">Water Quality Test</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <form class="card card-primary" method="POST" action="{{url('water-quality-test/update/'.$wqt->id)}}">
      @csrf
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Water Quality Test</h4>
          <div class="col-md-6 text-end">
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <label for="">School</label>
            <select name="school_id" class="form-control select2">
              <option value="">Select School</option>
              @foreach($schools as $school)
                <option value="{{$school->id}}" {{ $school->id==$wqt->school_id ? 'selected' : ''}}>{{$school->name}}</option>
              @endforeach
            </select>
          </div>          

          <div class="col-4">
            <label for="">Sample Collected Date</label>
            <input type="date" class="form-control" value="{{$wqt->sample_collected_date}}" name="sample_collected_date">
          </div>

          <div class="col-4">
            <label for="">Test Completion Date</label>
            <input type="date" class="form-control" value="{{$wqt->test_completed_date}}" name="test_completed_date" >
          </div>

          @foreach(WaterQualityTestParameters() as $key=> $wqtp)

            @php
              $results=json_decode($wqt->results);
              $val='';

              if($results!=null && isset($results->$key)){
                $val=$results->$key;
              }
            @endphp

            <div class="col-12">
              <label for="">{{ucfirst($wqtp)}}</label>
              <input type="text" name="results[{{$key}}]" value="{{$val}}" class="form-control" placeholder="{{ucfirst($wqtp)}}">
            </div>
          @endforeach

          <div class="col-12">
            <label for="">Remarks</label>
            <textarea name="remarks" class="form-control" placeholder="Remarks">{{$wqt->remarks}}</textarea>
          </div>



        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){

      });
</script>
@endsection
