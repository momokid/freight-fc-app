<div class="row">
    <!--INCOME REPORT-->
    <div class="col-sm-6 mb-1">
        <!-- Approach -->
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">VEHICLE TRIP REPORT</h6>
            </div>
            <div class="card-body">
                <select class="form-control mb-3 sel_vehicle_class_s" id="sel_vehicle_trip_rpt" disabled>
                    <option>All Vehicles</option>
                </select>
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="dt_trip_rpt_fdt" autocomplete="off" placeholder="Select First Trip Date">
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="dt_trip_rpt_ldt" autocomplete="off" placeholder="Select Last Trip Date">

                <button type="button" class="btn btn-info" id="btn_view_vehicle_trip_rpt">View Report</button>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-1">
        <!-- Approach -->
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">VEHICLE INCIDENT REPORT</h6>
            </div>
            <div class="card-body">
                <select class="form-control mb-3 sel_vehicle_class_s" id="sel_vehicle_incident_rpt" disabled>
                    <option>All Vehicles</option>
                </select>
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="dt_vehicle_incident_rpt_fdt" autocomplete="off" placeholder="Select First Trip Date">
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="dt_vehicle_incident_rpt_ldt" autocomplete="off" placeholder="Select Last Trip Date">

                <button type="button" class="btn btn-info" id="btn_view_vehicle_incident_rpt">View Report</button>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-1">
        <!-- Approach -->
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">VEHICLE INSPECTION REPORT</h6>
            </div>
            <div class="card-body">
                <select class="form-control mb-3 sel_vehicle_class_s" id="sel_vehicle_incident_rpt" disabled>
                    <option>All Vehicles</option>
                </select>
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="dt_vehicle_inspection_rpt_fdt" autocomplete="off" placeholder="Select First Transaction Date">
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="dt_vehicle_inspection_rpt_ldt" autocomplete="off" placeholder="Select Last Transaction Date">

                <button type="button" class="btn btn-info" id="btn_view_vehicle_inspection_rpt">View Report</button>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-1">
        <!-- Approach -->
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">VEHICLE EXPENSE REPORT</h6>
            </div>
            <div class="card-body">
                <select class="form-control mb-3 sel_vehicle_class_s" id="sel_vehicle_incident_rpt" disabled>
                    <option>All Vehicles</option>
                </select>
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_income_rpt_fdt" autocomplete="off" placeholder="Select First Transaction Date">
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_income_rpt_ldt" autocomplete="off" placeholder="Select Last Transaction Date">

                <button type="button" class="btn btn-info" id="btn_view_income_rpt">View Report</button>
            </div>
        </div>
    </div>

    <!--  -->
    <div class="col-sm-6 mb-1">
        <!-- Approach -->
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">VEHICLE UTILIZATION REPORT</h6>
            </div>
            <div class="card-body">
                <select class="form-control mb-3 sel_vehicle_class_s" id="sel_vehicle_incident_rpt" disabled>
                    <option>All Vehicles</option>
                </select>
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_income_rpt_fdt" autocomplete="off" placeholder="Select First Transaction Date">
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_income_rpt_ldt" autocomplete="off" placeholder="Select Last Transaction Date">

                <button type="button" class="btn btn-info" id="btn_view_income_rpt">View Report</button>
            </div>
        </div>
    </div>

    <!--  -->
    <div class="col-sm-6 mb-1">
        <!-- Approach -->
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DRIVER PERFORMANCE REPORT</h6>
            </div>
            <div class="card-body">
                <select class="form-control mb-3 sel_vehicle_class_s" id="sel_vehicle_incident_rpt" disabled>
                    <option>All Vehicles</option>
                </select>
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_income_rpt_fdt" autocomplete="off" placeholder="Select First Transaction Date">
                <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_income_rpt_ldt" autocomplete="off" placeholder="Select Last Transaction Date">

                <button type="button" class="btn btn-info" id="btn_view_income_rpt">View Report</button>
            </div>
        </div>
    </div>

</div>



<script>
    $(".datepicker").datepicker();

    $('.sel_vehicle_class').load('load_sel_vehicle.php');


    //
    $('#btn_view_vehicle_trip_rpt').click(function() {


        let vehicleId = $('#sel_vehicle_trip_rpt :selected').attr('id');
        let fdt = $('#dt_trip_rpt_fdt').val();
        let ldt = $('#dt_trip_rpt_ldt').val();

        if (fdt == "") {
            alert('Select First Trip Date');
            $("#dt_trip_rpt_fdt").focus();
            return false;
        } else if (ldt == '') {
            alert('Select Last Trip Date');
            let ldt = $('#dt_trip_rpt_ldt').focus();
            return false;
        }

        $(".progress-loader").remove();
        $("body").append(
            '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );

        $.post("insert_multi_values_0.php", {
            fdt: fdt,
            ldt: ldt,

        }, function() {
            $(".progress-loader").remove();
            window.open("vehicle_trip_report.view.php", "_blank");
        });

    })

    //
    $('#btn_view_vehicle_incident_rpt').click(function() {


        let fdt = $('#dt_vehicle_incident_rpt_fdt').val();
        let ldt = $('#dt_vehicle_incident_rpt_ldt').val();

        if (fdt == "") {
            alert('Select First Trip Date');
            $("#dt_vehicle_incident_rpt_fdt").focus();
            return false;
        } else if (ldt == '') {
            alert('Select Last Trip Date');
            let ldt = $('#dt_vehicle_incident_rpt_ldt').focus();
            return false;
        }

        $(".progress-loader").remove();
        $("body").append(
            '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );

        $.post("insert_multi_values_0.php", {
            fdt: fdt,
            ldt: ldt,

        }, function() {
            $(".progress-loader").remove();
            window.open("vehicle_incident_report.view.php", "_blank");
        });

    })

    //
    $('#btn_view_vehicle_inspection_rpt').click(function() {


        let fdt = $('#dt_vehicle_inspection_rpt_fdt').val();
        let ldt = $('#dt_vehicle_inspection_rpt_ldt').val();

        if (fdt == "") {
            alert('Select First Inspection Date');
            $("#dt_vehicle_inspection_rpt_fdt").focus();
            return false;
        } else if (ldt == '') {
            alert('Select Last Inspection Date');
            let ldt = $('#dt_vehicle_inspection_rpt_ldt').focus();
            return false;
        }

        $(".progress-loader").remove();
        $("body").append(
            '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );

        $.post("insert_multi_values_0.php", {
            fdt: fdt,
            ldt: ldt,

        }, function() {
            $(".progress-loader").remove();
            window.open("vehicle_inspection_report.view.php", "_blank");
        });

    })
</script>