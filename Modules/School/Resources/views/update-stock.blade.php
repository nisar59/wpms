<!-- Modal -->
<div class="modal fade" id="update-stock" tabindex="-1" aria-labelledby="update-stock-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form class="modal-content" method="POST" action="{{url('school/update-stock/')}}">
      @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="update-stock-label">Update Stock</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <label for="">Stock</label>
            <input type="number" name="stock" class="form-control" placeholder="Enter Stock">
          </div>
          <div class="col-6">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control">
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