 <!-- Begin New Consignment Page Content -->
 <div class="container-fluid sub-basic-setup" id="new-schedule-trip-panel">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Schedule Cargo Trip</h1>
     </div>

     <!-- Content Row -->
     <div class="row">

         <!-- Content Column -->
         <div class="col-lg-12 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Schedule Details</h6>
                 </div>
                 <div class="card-body">

                     <div class="form-group row">

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Vehicle*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_driver_vehicle_assigned">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Driver*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_driver_vehicle_assigned">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Pickup Address*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_telno">
                         </div>

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Delivery Address*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_former_employer">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Departure Time*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_driver_employment_date">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">ETA*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_driver_employment_date">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Amount Charged*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_fname">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Debit Account*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_driver_vehicle_assigned">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Cargo Details*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_fname">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Customer Details*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_fname">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Delivery Status*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_driver_vehicle_assigned">
                                 <option>Delivered</option>
                                 <option>Not Delivered</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Transaction Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_driver_employment_date">
                         </div>
                         <form class="col-sm-12 mb-3 user">
                             <label for="exampleFormControlInput1"></label>
                             <a class="btn btn-secondary btn-user btn-block" id="btn_new_driver_registration">
                                 Schedule New Trip
                             </a>
                         </form>

                     </div>
                 </div>
             </div>

         </div>

         <div class="col-lg-12 mb-4">
             <!-- Approach -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Registered Driver Details</h6>
                 </div>
                 <div class="card-body" id="display_registered_driver">

                 </div>
             </div>
         </div>
     </div>

 </div>
 <!-- /. End of New consignmentContent -->