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
    $a = mysqli_query($dbc, "select * from student_fee_view_2 where StudentID='$cns' ORDER BY Date desc");

    echo '<table class="table responsive table-striped table-bordered" style="padding:0px;" id="tblclientrecentinvoice">
            <thead>
                <tr class="bg-dark text-white font-weight-bold">
                    <td>HOUSE BL</td>
                    <td>DESCRIPTION</td>
                    <td>RECEIPT NO.</td>
                    <td>DR</td>
                    <td>CR</td>
                    <td>DATE</td>
                </tr>
            </thead>
            <tbody>
            ';
    if (mysqli_num_rows($a) == 0) {
    } else {
        while ($an = mysqli_fetch_assoc($a)) {
            echo '<tr class="client_profile_invoice_issued" rec="' . $an['ReceiptNo'] . '" type="' . $an['TDr'] . '" sid="' . $an['SubClassID'] . '" cpn="' . $an['CouponID'] . '"  stamp="' . $an['Stamp'] . '">
                    <td scope="col">' . $an['CouponID'] . '</td>
                    <td scope="col">' . $an['Description'] . '</td>
                    <td scope="col">' . $an['ReceiptNo'] . '</td>
                    <td scope="col" class="text-danger">' . number_format($an['TDr'], 2, '.', ',') . '</td>
                    <td scope="col" class="text-success">' . number_format($an['TCr'], 2, '.', ',') . '</td>
                    <td scope="col">' . strftime("%b %d, %Y", strtotime($an['Date'])) . ' <i class="fas fa-file"></i></td>
                 </tr>
                 ';
        }
    }

    echo '<tbody>
        </table>';
}
?>

<style>
    .client_profile_invoice_issued {
        cursor: pointer;
    }
</style>

<script>
    $('#tblclientrecentinvoice').DataTable();

    $('.client_profile_invoice_issued').click(function() {
        let rec = $.trim($(this).attr('rec'));
        let type = $.trim($(this).attr('type'));
        let sid = $.trim($(this).attr('sid'));
        let cpn = $.trim($(this).attr('cpn'));
        let stamp = $.trim($(this).attr('stamp'));

        if(stamp=='BL'){
            if (type === '0.00') {
                $.post('insert_recno_rpt.php', {
                    cid: rec
                }, function() {
                    window.open("invoice_payment_receipt.php", "_blank");
                });
            } else {
                if (sid == '') {
                    $.post('insert_recno_rpt.php', {
                        sid: rec
                    }, function() {
                        window.open("invoice_other_services.php", "_blank");
                    });
                } else {
                    $.post('insert_recno_rpt.php', {
                        sid: rec
                    }, function() {
                        window.open("invoice_housebl_charges.php", "_blank");
                    });
                }

            }
        }else if(stamp=='BL_NONBL'){
            $.post('insert_recno_rpt.php', {
                sid: rec
            }, function() {
                window.open("invoice_other_services_non_manifest.php", "_blank");
            });   
        }
        
    });
</script>