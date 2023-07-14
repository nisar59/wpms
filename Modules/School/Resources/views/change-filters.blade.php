<!-- Modal -->
<div class="modal fade" id="filter-change" tabindex="-1" aria-labelledby="filter-change-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form class="modal-content" method="POST" action="{{url('school/filter-change/'.$school->id)}}">
      @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filter-change-label">Change Filter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
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