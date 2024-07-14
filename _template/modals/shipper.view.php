<!-- New Shipper Modal-->
<div class="modal fade" id="newShipperModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Shipper's Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0b sr-only">
              <label for="exampleFormControlInput1">Shipper ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newshpID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Shipper's Name *</label>
              <input type="text" class="form-control form-control-user ep" id="newshpName">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 1 *</label>
              <textarea class="form-control form-control-user ep" id="newshpAdd1" placeholder="Shipper's Address" required></textarea>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 2 *</label>
              <textarea class="form-control form-control-user ep" id="newshpAdd2" placeholder="Shipper's Address" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">City - Country</label>
              <input type="text" class="form-control form-control-user ep" id="newshpAdd3">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Telephone No.</label>
              <input type="text" class="form-control form-control-user ep" id="newshpAdd4">
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_shipper">Add New Shipper</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_pod_list">
              <!-- Approach -->

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>