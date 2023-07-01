<!-- Modal -->
<div class="modal fade" id="add-plant" tabindex="-1" aria-labelledby="add-plant-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form class="modal-content" method="POST" action="{{url('school/add-plant/'.$school->id)}}">
      @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="add-plant-label">Add Plant</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4">
            <label for="">Select Plant</label>
            <select name="plant_id" class="form-control">
              <option value="">select plant</option>
              @foreach(AllPlants() as $plant)
                <option value="{{$plant->id}}">{{$plant->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-4">
            <label for="">Select Vendor</label>
            <select name="vendor_id" class="form-control">
              <option value="">select vendor</option>
              @foreach(AllVendors() as $vendor)
                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
              @endforeach
            </select>
          </div>

         <div class="col-4">
           <label for="">Estimated Cost</label>
           <input type="text" class="form-control" name="estimated_cost" placeholder="Enter Estimated Cost">
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