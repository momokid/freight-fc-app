  <!-- New P.O.L. Modal-->
  <div class="modal fade" id="newPOLModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New P.O.L.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
              <label for="exampleFormControlInput1">P.O.L. ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newPOLID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">P.O.L.</label>
              <input type="text" class="form-control form-control-user ep" id="newpolName">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_pol">Add</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_pol_list">
              <!-- Approach -->
              This is where the details approached
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
