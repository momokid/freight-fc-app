 <!-- New Consignee/Notify Party Modal-->
 <div class="modal animated--grow-in" id="newConsigneeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Consignee/ Notify Party</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0b">
              <label for="exampleFormControlInput1">Consignee ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newcnsID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Full Name *</label>
              <input type="text" class="form-control form-control-user ep" id="newcnsName">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 1 *</label>
              <textarea class="form-control form-control-user ep" id="newcnsAdd1" placeholder="Shipper's Address" required></textarea>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 2 *</label>
              <textarea class="form-control form-control-user ep" id="newcnsAdd2" placeholder="Shipper's Address" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">TIN Number</label>
              <input type="text" class="form-control form-control-user ep" id="newshpAdd3">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Telehone No. *</label>
              <input type="text" class="form-control form-control-user ep" id="newcnsTel">
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_consignee">Add New Consignee</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_consignee_list">
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
