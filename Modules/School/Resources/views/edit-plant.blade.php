<!-- Modal -->
<div class="modal fade" id="edit-plant" tabindex="-1" aria-labelledby="edit-plant-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form class="modal-content" method="POST" action="{{url('school/update-plant/'.$data->id)}}">
      @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="edit-plant-label">Edit Plant</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <label for="">Select Plant</label>
            <select name="plant_id" disabled class="form-control">
              <option value="">select plant</option>
              @foreach(AllPlants() as $plant)
                <option value="{{$plant->id}}" {{$data->plant_id==$plant->id ? 'selected' : ''}}>{{$plant->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-6">
            <label for="">Select Vendor</label>
            <select name="vendor_id" class="form-control">
              <option value="">select vendor</option>
              @foreach(AllVendors() as $vendor)
                <option value="{{$vendor->id}}" {{$data->vendor_id==$vendor->id ? 'selected' : ''}}>{{$vendor->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-6">
            <label for="">Select Donor</label>
            <select name="donor_id" class="form-control">
              <option value="">select Donor</option>
              @foreach(AllDonors() as $donor)
                <option value="{{$donor->id}}" {{$data->donor_id==$donor->id ? 'selected' : ''}}>{{$donor->name}}</option>
              @endforeach
            </select>
          </div>

         <div class="col-6">
           <label for="">Estimated Cost</label>
           <input type="text" class="form-control" value="{{$data->estimated_cost}}" name="estimated_cost" placeholder="Enter Estimated Cost">
         </div>
         <div class="col-6">
           <label for="">Status</label>
            <select name="status" id="status" class="form-control">
              <option value="">select status</option>
              @foreach(SchoolPlantStatus() as $key=> $status)
                <option value="{{$key}}" {{$data->status==$key ? 'selected' : ''}}>{{$status}}</option>
              @endforeach
            </select>
         </div>

         <div class="col-6" id="completion-date">

         </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>


<script>
  $(document).ready(function() {
    setTimeout(function() {
      $("#status").trigger('change');
    },50);
  $(document).on('change', '#status', function() {
    if($(this).val()==2){
      $("#completion-date").html('<label for="">Installation Completion Date</label><input type="date" class="form-control" value="{{$data->installation_completion_date}}" name="installation_completion_date" placeholder="Installation Completion Date">');
    }
    else{
      $("#completion-date").html('');
    }
  });
});
</script>
