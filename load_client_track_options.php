<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns = mysqli_real_escape_string($dbc, $_POST['cns']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "select * from manifestation_breakdown where ConsigneeID='$cns' order by Time desc");
    $b = mysqli_query($dbc, "select * from student_fee where StudentID='$cns' and Dr<>0");
    $c = mysqli_query($dbc, "select * from  student_fee where StudentID='$cns' and Cr<>0");
    $d = mysqli_query($dbc, "select * from manifestation_breakdown where ConsigneeID='$cns'");


    echo '<table class="table responsive table-striped table-bordered" style="padding:0px;" id="LedgerControlTbl">
             
               ';
    if (mysqli_num_rows($a) > 0) {
        while ($an = mysqli_fetch_assoc($a)) {
            echo '<tr class="client_profile_options_tr" data-toggle="modal" data-target="#clientProfileInvoiceModals" cns="' . $cns . '" hbl="' . $an['HouseBL'] . '" mbl="' . $an['MainBL'] . '">
                                <td scope="col">' . $an['MainBL'] . '</td>
                                <td scope="col">' . $an['HouseBL'] . '</td>
                                <td scope="col">' . $an['Description'] . ' <i class="fas fa-eye i-client_profile_options"  cns="' . $cns . '"  cnt="' . $an['ContainerNo'] . '" hbl="' . $an['HouseBL'] . '" mbl="' . $an['MainBL'] . '"></i></td>
                             </tr>';
        }
    }

    echo '
             
          <tbody>';
}
?>

<style>
    .client_profile_tr td button {
        margin-left: 5px;
    }

    .i-client_profile_options {
        cursor: pointer;
    }
</style>

<script>
    $('.i-client_profile_options').click(function() {
        let mbl = $.trim($(this).attr('mbl'));
        let hbl = $.trim($(this).attr('hbl'));
        let cns = $.trim($(this).attr('cns'));

        //alert(`${cns} and ${hbl} and ${mbl}`);
        $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $.post('insert_recno_rpt.php', {
            ldt: cns,
            sid: hbl,
            cid: mbl
        }, function(a) {
            var win = window.open();
            win.location = "load_consignee_housebl_view.php", "_blank";
            win.opener = null;
            win.blur();
            window.focus();
            $('.progress-loader').remove();
        });

    });
</script>