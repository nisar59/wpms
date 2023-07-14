<!-- Modal -->
<div class="modal fade" id="sample-collected" tabindex="-1" aria-labelledby="sample-collected-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form class="modal-content" method="POST" action="{{url('water-quality-test/store/'.$school->id)}}">
      @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="sample-collected-label">Water Quality Test</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <label for="">Sample Collected Date</label>
            <input type="date" value="{{now()->format('Y-m-d')}}" class="form-control" name="sample_collected_date">
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