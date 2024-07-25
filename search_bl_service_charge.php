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
    $result = mysqli_query($dbc, "select * from declaration_main_view_0 where (MainBL like '%$e%') or (HBL like '%$e%')");

    while ($f = mysqli_fetch_assoc($result)) {
        //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
        //      . '<div class="wrap-details"></div></div><br>';

        echo "<div class='return_search_results cns_service_charge_search hide_div_note' bl='$f[MainBL]' cns_id='$f[ConsigneeID]' hbl='$f[HBL]' cons='$f[ConsigneeName]' desc='$f[ItemDescription]' dcl='$f[DeclarationNo]' dclid='$f[DeclarationID]'><b>" . $f['ConsigneeName'] . "</b> <e style='color:red;'> [" . $f['MainBL'] . "]</e> <b style='color:blue;'> " . $f['ConsigneeName'] . "</b></div>";
    }
}


?>

<script>
    $('.cns_service_charge_search').click(function() {

        var bl = $(this).attr('bl');
        var hbl = $(this).attr('hbl');
        var m = $(this).text();
        var desc = $(this).attr('desc');
        var dcl = $(this).attr('dcl');
        var cons = $(this).attr('cons');
        var cns_id = $(this).attr('cns_id');
        var dcl_id = $(this).attr('dclid');
        //$('.ep').text('');

        $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $('#service_charge_bl_search').val(hbl);
        $('#service_charge_desc').val(desc);
        $('#service_charge_decl_no').val(dcl);
        $('#service_charge_consignee_name').val(cons);
        $('#service_charge_consignee_id').text(cns_id);
        $('#service_charge_declaration_id').text(dcl_id);
        $('.progress-loader').remove();

        $('.cns_service_charge_search').toggle();
        $('#service_charge_amt_charge').focus();
    });
</script>