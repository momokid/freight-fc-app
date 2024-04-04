<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Username']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$e = mysqli_real_escape_string($dbc, $_POST['e']);

if (!isset($_SESSION['Uname'])) {

    header('Location: login');
} elseif ($e == '') {
    die('');
} elseif (!isset($e)) {
    die('Search key not found');
} else {
    $result = mysqli_query($dbc, "SELECT DISTINCT MainBL FROM manifestation_breakdown_view_0 WHERE MainBL LIKE '%$e%'");

    while ($f = mysqli_fetch_assoc($result)) {
        echo "<div class='return_search_results consignee_hbl_invoicing_search hide_div_note' fullName='$f[FullName]' cnm='$f[ConsignmentID]' containerNo='$f[ContainerNo]' cns='$f[ConsigneeID]' hbl='$f[HouseBL]' mbl='$f[MainBL]' ><b>" . $f['MainBL'] . "</b> </div>";
    }
}
?>

<script>
    $('.consignee_hbl_invoicing_search').click(function() {
        // const bl = {
        //     'consignmentID': $(this).attr('cns'),
        //     'consigneeID': $(this).attr('cnm'),
        //     'mainBL':$(this).attr('mbl'),
        //     'fullName': $(this).attr('fullName'),
        // }

        var cns = $(this).attr('cns');
        var cnm = $(this).attr('cnm');
        var mbl = $(this).attr('mbl');
        var hbl = $(this).attr('hbl');
        var m = ($(this).text());
        $('.ep').text('');

        //Display Consignee manifestation details
        $.post('load_fcl_main_bl_details.php', {
            cns: cns,
            mbl: mbl
        }, function(a) {
            $('#disbursement_fcl_bl_display_details').html(a);

            $('.progress-loader').remove();
        });

        $('#txt_disbursement_bl_search').val(m);
        // $('#seach_hbl_invoicing_consignee').text(cns);
        // $('#hBL_hblid_invoice').text(hbl);
        // $('#hBL_mblid_invoice').text(mbl);

        // $.post('add_hbl_charges_invoice_temp.php', {
        //     cnm: cnm,
        //     mbl: mbl,
        // }, function(a) {
        //     if (a == 1) {

        //         // $('#hBL_rcpt_id_invoice').text(a);

        //         // $.post('get_receipt_no.php', {
        //         //     dt: dt
        //         // }, function(a) {
        //         //     $('#hBL_rcpt_no_invoice').text(a);
        //         // });
        //         // $.post('get_receipt_id.php', {
        //         //     dt: dt
        //         // }, function(a) {
        //         //     $('#hBL_rcpt_id_invoice').text(a);
        //         // });

        //         //Display Consignee handling charges
        //         // $.post('load_consignee_handling_charges_temp_tbl.php', {
        //         //     cns: cns
        //         // }, function(a) {
        //         //     $('#cosignee_hbl_invoice_charges_display').html(a);
        //         // });

        //         // $('#sel_hBL_acc_invoice').load('load_sel_billing_account.php');


        //         $('#search_hbl_consignee2_fname').focus();

        //         $('.progress-loader').remove();
        //     } else {
        //         $('.progress-loader').remove();
        //         alert(a);
        //     }


        // });

        // $('#mapp_StaffClass').load('load_staff_class_map.php');
        //  $('#mapp_StaffSubject').load('load_staff_subject_map.php');

        $('.consignee_hbl_invoicing_search').toggle();
    });
</script>