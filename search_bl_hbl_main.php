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
    $result = mysqli_query($dbc, "SELECT * FROM container_main_view_0 WHERE BL LIKE '%$e%' OR ContainerNo Like '%$e%'");

    while ($f = mysqli_fetch_assoc($result)) {
        echo "<div class='return_search_results consignee_hbl_invoicing_search hide_div_note' fullName='$f[ConsigneeName]' cnm='$f[ConsignmentID]' containerNo='$f[ContainerNo]' cns='$f[ConsigneeID]' hbl='$f[BL]' mbl='$f[BL]' ><b>" . $f['BL'] . " <span class='text-danger'> #[".$f['ContainerNo']."]</span></b> </div>";
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
        var containerNo = $(this).attr('containerNo');
        var m = $.trim(($(this).text()));
        $('.ep').text('');

        //Display Consignee manifestation details
        $.post('load_fcl_main_bl_details.php', {
            cns,
            mbl,
            containerNo
        }, function(a) {
            $('#disbursement_fcl_bl_display_details').html(a);

            $('.progress-loader').remove();
        });

        $('#txt_disbursement_bl_search').val(m);


        $('.consignee_hbl_invoicing_search').toggle();
    });
</script>   