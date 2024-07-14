 <!-- Begin New Consignment Page Content -->
 <div class="container-fluid sub-basic-setup" id="new-consignment-panel">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">New Consignment</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cargo Details</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
            <label for="exampleFormControlInput1">Consignment ID</label>
            <label class="form-control form-control-user label-form-control-user" id="newConsignmentID"></label>
          </div>
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">D.O.T.*</label>
            <input type="text" class="form-control form-control-user ep datepicker" id="dot_new_conisgnment">
          </div>
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">ETA*</label>
            <input type="text" class="form-control form-control-user ep datepicker" id="eta_new_conisgnment">
          </div>
          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Shipping Line* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newCarrierModals" id="addCarrierModals"></i></label>
            <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_shipper_new_conisgnment">
              <option></option>
            </select>
          </div>
          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Shipper* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newShipperModal" id="addShipperModal"></i></label>
            <label type="text" class="form-control" hidden='' id='shpperid_new_consignment'></label>
            <input type="text" class="form-control form-control-user ep" id="shipper_new_conisgnment">
            <div id='display_shipper_search_info' class='div_search_box'></div>
          </div>
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Vessel Name*</label>
            <input type="text" class="form-control form-control-user ep" id="vessel_new_conisgnment">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Voyage No.*</label>
            <input type="text" class="form-control form-control-user ep" id="voyageNo_new_conisgnment">
          </div>
          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Bill Of Laden*</label>
            <input type="text" class="form-control form-control-user ep" id="bl_new_conisgnment">
          </div>
          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Place of Issue*</label>
            <input type="text" class="form-control form-control-user ep" id="pois_new_conisgnment">
          </div>
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Date of Issue*</label>
            <input type="text" class="form-control form-control-user ep datepicker" id="dois_new_conisgnment">
          </div>
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Shipped on Board*</label>
            <input type="text" class="form-control form-control-user ep datepicker" id="sob_new_conisgnment">
          </div>
        </div>
        <div class="form-group row">


          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">P.O.L.* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newPOLModal" id="addPOLModal"></i></label>
            <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_pol_new_conisgnment">
              <option></option>

            </select>
          </div>
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">P.O.D.* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newPODModal" id="addPODModal"></i></label>
            <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_pod_new_conisgnment">
              <option></option>

            </select>
          </div>
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Rotation #*</label>
            <input type="text" class="form-control form-control-user ep" id="rotation_new_conisgnment">
          </div>

          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Agent's Contact*</label>
            <input type="text" class="form-control form-control-user ep" id="agent_contact_new_conisgnment">
          </div>

          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Consignee <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newConsigneeModal" id="addConsigneeModal"></i></label>
            <label type="text" class="form-control ep" hidden='' id='hbl_consignee_id'></label>
            <input type="text" class="form-control form-control-user ep" id="search_hbl_consignee_fname" autocomplete="off" placeholder="">
            <div id='display_hBL_search_consignee_info' class='div_search_box'></div>
          </div>

        </div>

        <div class="form-group row">
        </div>
        <div class="card-header py-3 mb-3">
          <h6 class="m-0 mb-2 font-weight-bold text-success">Container Details</h6>
        </div>
        <div class="form-group row">

          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Seal No.*</label>
            <input type="text" class="form-control form-control-user ef" id="sealNo_new_conisgnment">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Container No.*</label>
            <input type="text" class="form-control form-control-user ef" id="cntNo_new_conisgnment">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Container Size*</label>
            <input type="text" class="form-control form-control-user ef" id="cntSize_new_conisgnment">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Gross Weight (KG)*</label>
            <input type="number" class="form-control form-control-user ef" id="weight_new_conisgnment">
          </div>
          <div class="col-sm-4 mb-3">
            <label for="exampleFormControlInput1">Est. Handling Cost*</label>
            <input type="number" class="form-control form-control-user ef" id="tcost_handling_new_conisgnment">
          </div>
          <div class="col-sm-4 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Transaction ID</label>
            <label class="form-control form-control-user label-form-control-user ep sr-only" id="new_consignment_rcptid"></label>
            <label class="form-control form-control-user label-form-control-user ep" id="new_consignment_rcptno"></label>
          </div>
          <form class="col-sm-4 mb-3 user">
            <label for="exampleFormControlInput1"></label>
            <a class="btn btn-warning btn-user btn-block" id="btn_new_container_details">
              Add New Container
            </a>
          </form>

        </div>
        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0" style="border:1px solid #bbb;">
            <div class="card-body" id="display_new_container_details">

            </div>
          </div>
        </div>
        <form class="user">
          <a class="btn btn-success btn-user btn-block" id="btn_new_consignment">
            Add New Consignment
          </a>
        </form>
      </div>
    </div>

  </div>

  <div class="col-lg-12 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pending Consigment</h6>
      </div>
      <div class="card-body" id="display_new_consignment00">

      </div>
    </div>
  </div>
</div>

</div>
<!-- /. End of New consignmentContent -->