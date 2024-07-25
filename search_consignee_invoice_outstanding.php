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
    $result = mysqli_query($dbc, "SELECT * FROM container_main_view WHERE BL LIKE '%$e%'");

    while ($f = mysqli_fetch_assoc($result)) {
        //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
        //      . '<div class="wrap-details"></div></div><br>';

        echo "<div class='return_search_results consignee_invoice_debt_details hide_div_note' officer='$f[OfficerAissignedName]' cns='$f[ConsigneeID]' hbl='$f[BL]' mbl='$f[BL]' ><b>" . $f['ConsigneeName'] . "</b> <e class=''> " . $f['BL'] . "</e> <e class='text-warning'> $f[OfficerAssignedName]</e></div>";
    }
}


?>

<script>
    $('.consignee_invoice_debt_details').click(function() {

        $('.progress-loader').remove();

        var cns = $(this).attr('cns');
        var mbl = $(this).attr('mbl');
        var m = $(this).text();
        //$('.ep').text('');

        $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $.post('insert_recno_rpt.php', {
            ldt: cns,
            cid: mbl,
            sid: mbl
        }, function(a) {
            if (a == 1) {
                $('#hBL_rcpt_id_invoice').text(a);

                //Display Consignee manifestation details
                $.post('load_consignee_invoice_pmt_details_tbl.php', {
                    cns,
                    mbl
                }, function(a) {
                    $('#cosignee_invoice_pmt_display_details').html(a);
                });

                $('#invoice_pmt_sel_cash_acc').load('load_sel_cash_account.php');

                $('#consignee_invoice_payment').val(m);
                $('#consignee_id_invoice_pmt').text(cns);
                $('#invoice_pmt_hblid').text(mbl);
                $('#invoice_pmt_mblid').text(mbl);
                $('.progress-loader').remove();
                $('#invoice_pmt_amt').focus();
            } else {
                $('.progress-loader').remove();
                alert(a);
            }


        });

        $('.consignee_invoice_debt_details').toggle();
    });
</script>