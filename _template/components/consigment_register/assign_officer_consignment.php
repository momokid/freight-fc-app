 <!-- Assign Officer Content -->
 <div class="container-fluid sub-basic-setup" id="new-cargo-manifestation-panel">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Assign Officer</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">BL Details</h6>
      </div>

      <div class="card-body">
        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
            <label for="exampleFormControlInput1">Consignment ID</label>
            <label class="form-control form-control-user label-form-control-user" id="newConsignmentID"></label>
          </div>

          <div class="col-sm-5 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Search Main BL </label>
            <label type="text" class="form-control" hidden='' id='seach_mainBL_new_consignee'></label>
            <input type="text" class="form-control form-control-user ep" id="mainBL_search_conisgnee" placeholder="Enter Main BL" autocomplete="off">
            <div id='display_mainBL_search_info' class='div_search_box'></div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_main_bl_display_details">

          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="col-lg-12 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4" id="manifestation_breakdown_card">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Assignee Details </h6>
      </div>
      <div class="card-body">

        <!-- <div class="form-group row">
          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">House BL#</label>
            <input class="form-control form-control-user ep" id="houseBL_consignee_breakown" />
          </div>
          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Consignee <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newConsigneeModal" id="addConsigneeModal"></i></label>
            <label type="text" class="form-control ep" hidden='' id='hbl_consignee_id'></label>
            <input type="text" class="form-control form-control-user ep" id="search_hbl_consignee_fname" autocomplete="off" placeholder="Full Name of Consignee">
            <div id='display_hBL_search_consignee_info' class='div_search_box'></div>
          </div>

          <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Notify Party</label>
            <label type="text" class="form-control ep" hidden='' id='hbl_consignee2_id'></label>
            <input type="text" class="form-control form-control-user ep" id="search_hbl_consignee2_fname" placeholder="Notify Party">
            <div id='display_hBL_search_consignee2_info' class='div_search_box'></div>
          </div>

          <div class="col-sm-2 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Weight</label>
            <input type="number" class="form-control form-control-user ep" id="hBL_conisgnee_weight">
          </div>

          <div class="col-sm-1 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Package</label>
            <input type="number" class="form-control form-control-user ep" id="hBL_conisgnee_pkg">
          </div>

          <div class="col-sm-1 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Unit</label>
            <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_hBL_conisgnee_unit">
              <option></option>
              <option>LOT</option>
              <option>PLT</option>
              <option>PKG</option>
              <option>UNIT</option>
            </select>
          </div>
        </div> -->
        <div class="form-group row">
          <div class="col-sm-5 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Current Assigned Officer</label>
            <input type="text" class="form-control form-control-user ep" id="current_assignee_mapped" disabled>
          </div>
          <div class="col-sm-5 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Select Officer</label>
            <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_mbl_assignee_officer">
            </select>
          </div>

          <!-- <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">VIN **</label>
            <textarea type="text" class="form-control form-control-user ep" id="hBL_conisgnee_vin"></textarea>
          </div> -->

          <!-- <div class="col-sm-3 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Other Info **</label>
            <textarea type="text" class="form-control form-control-user ep" id="hBL_conisgnee_other_info"></textarea>
          </div> -->
        </div>

        <div class="form-group row">
          <form class="user">
            <a class="btn btn-success btn-user btn-block" id="btn_consignee_manifestation">
              Assign Officer
            </a>
          </form>
        </div>
        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_house_bl_display_details">

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

</div>
<!-- /. End of Cargo manifestation Content -->