<!-- Modal -->
<div class="modal fade" id="test-completed" tabindex="-1" aria-labelledby="test-completed-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form method="POST" action="{{url('water-quality-test/update/'.$data->id)}}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="test-completed-label">Water Quality Test</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <label for="">Test Completion Date</label>
            <input type="date" name="test_completed_date" value="{{$data->test_completed_date!=null ? \Carbon\Carbon::parse($data->test_completed_date)->format('Y-m-d') : ''}}" class="form-control">
          </div>

          @foreach(WaterQualityTestParameters() as $key=> $wqtp)

            @php
              $results=json_decode($data->results);
              $val='';

              if($results!=null && isset($results->$key)){
                $val=$results->$key;
              }
            @endphp

            <div class="col-12">
              <label for="">{{$wqtp}}</label>
              <input type="text" name="results[{{$key}}]" value="{{$val}}" class="form-control" placeholder="{{$wqtp}}">
            </div>

          @endforeach

          <div class="col-12">
            <label for="">Remarks</label>
            <textarea name="remarks" class="form-control">{{$data->remarks}}</textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>