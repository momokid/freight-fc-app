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
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_schedule_trip_vehicle">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Driver*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_schedule_trip_driver">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Pickup Address*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_schedule_trip_pickup_address">
                         </div>

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Delivery Address*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_schedule_trip_destination_address">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Departure Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_schedule_trip_departure_time">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Return Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_schedule_trip_eta">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Amount Charged*</label>
                             <input type="number" class="form-control form-control-user ef" id="new_schedule_trip_amount_charged">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Amount Paid*</label>
                             <input type="number" class="form-control form-control-user ef" id="new_schedule_trip_amount_paid">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Debit Account*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_schedule_trip_debit_account">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Cargo Details*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_schedule_trip_cargo_details" placeholder="e.g. Brief description of the goods">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Customer Details*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_schedule_trip_customer_details">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Transaction Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_schedule_trip_transaction_date">
                         </div>
                         <form class="col-sm-12 mb-3 user">
                             <label for="exampleFormControlInput1"></label>
                             <a class="btn btn-dark btn-user btn-block" id="btn_new_cargo_schedule">
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
                     <h6 class="m-0 font-weight-bold text-primary">Cargo Schedules Details</h6>
                 </div>
                 <div class="card-body" id="display_cargo_schedule_trip">

                 </div>
             </div>
         </div>
     </div>

 </div>
 <!-- /. End of New consignmentContent -->