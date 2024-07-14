 <!-- Begin HBL Inovice Content -->
 <div class="container-fluid sub-basic-setup" id="new-customer-waybill-panel">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Customer Waybill</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-sm-7 mb-7">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">House BL Search</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Search Existing Waybill</label> <i class="fas fa-eye text-warning float-right" data-toggle="modal" data-target="#consigneeInProcessModal" id="load_consignee_in_process_others"></i>
            <label type="text" class="form-control ep lbl-client-search-id" hidden='' id='seach_hbl_invoicing_consignee'></label>
            <input type="text" class="form-control form-control-user ep" id="txt_housebl_customer_waybill" autocomplete="off" placeholder="Enter Consignee or Vehicle # ">
            <div id='display_hBL_waybill_search_info' class='div_search_box'></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-5 mb-2">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Existing Waybill</h6>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <div class="col-sm-12 mb-1 mb-sm-0 ep" id="consignee_existing_waybill_details">

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-7 mb-7">
    <!-- Approach -->
    <div class="card shadow mb-4" id="manifestation_breakdown_card">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Waybill Details</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Consignee Name</label>
            <input type="text" class="form-control form-control-user ep" id="waybill_consignee_name">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Vehicle No.</label>
            <input type="text" class="form-control form-control-user ep" id="waybill_vehicle_no">
          </div>
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Driver's Name</label>
            <input type="text" class="form-control form-control-user ep" id="waybill_driver_name">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Port</label>
            <input type="text" class="form-control form-control-user ep" id="waybill_port">
          </div>
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Driver's License No.</label>
            <input type="text" class="form-control form-control-user ep" id="waybill_driver_license">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Package</label>
            <input class="form-control form-control-user ep" id="waybill_package" />
          </div>

          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Description</label>
            <input class="form-control form-control-user ep" id="waybill_description" />
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Quantity</label>
            <input class="form-control form-control-user ep" id="waybill_qty" />
          </div>

          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Date</label>
            <input class="form-control form-control-user ep datepicker" id="waybill_date" />
          </div>
        </div>
        <div class="form-group row">
          <form class="user">
            <a class="btn btn-success btn-user btn-block" id="btn_add_new_waybill">
              Add New Waybill
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
<!-- /. End of HBL Invoice Content -->