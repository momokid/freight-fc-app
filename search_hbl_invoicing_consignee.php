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
     $result = mysqli_query($dbc, "SELECT * FROM container_main_view_3 WHERE BL LIKE '%$e%'");

     while ($f = mysqli_fetch_assoc($result)) {

          echo "<div class='return_search_results consignee_hbl_invoicing_search hide_div_note' dt='$f[Date]' shipperId='$f[ShipperID]'  mbl='$f[BL]' ><b>" . $f['ShipperName'] . "</b> " . $f['BL'] . "</div>";
     }
}

?>

<script>
     $('.consignee_hbl_invoicing_search').click(function() {

          // var cns = $(this).attr('cns');
          // var cnm = $(this).attr('cnm');
          var mbl = $(this).attr('mbl');
          var shipperId = $(this).attr('shipperId');
          var dt = $(this).attr('dt');
          var m = $(this).text();
          $('.ep').text('');

          $('#new-house-bl-invoice-panel').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');

          $.post('load_consignee_invoice_temp_tbl.php', {
               mbl
          }, function(a) {
               $('#invoicing_hbl_search_conisgnee').val(m);
               $('#mbl_invoice_search').text(mbl);
               $('#cosignee_hbl_invoice_display_details').html(a);

               $.post("load_consignee_handling_charges_temp_tbl.php", {}, function(a) {
                    $("#cosignee_hbl_invoice_charges_display").html(a);
                    
               });

               $('#sel_hBL_acc_invoice').load('load_sel_billing_account.php');

               $('.progress-loader').remove();
          });

          //
          // $.post('add_hbl_charges_invoice_temp.php', {
          //      mbl,
          //      shipperId,
          //      dt
          // }, function(a) {
          //      if (a == 1) {
          //           $('#hBL_rcpt_id_invoice').text(a);

          //           $.post('get_receipt_no.php', {
          //                dt: dt
          //           }, function(a) {
          //                $('#hBL_rcpt_no_invoice').text(a);
          //           });
          //           $.post('get_receipt_id.php', {
          //                dt: dt
          //           }, function(a) {
          //                $('#hBL_rcpt_id_invoice').text(a);
          //           });

          //           //Display Consignee manifestation details


          //           //Display Consignee handling charges
          //           $.post('load_consignee_handling_charges_temp_tbl.php', {
          //                cns: cns
          //           }, function(a) {
          //                $('#cosignee_hbl_invoice_charges_display').html(a);
          //           });

          //           $('#sel_hBL_acc_invoice').load('load_sel_billing_account.php');

          //           $('#invoicing_hbl_search_conisgnee').val(m);
          //           $('#seach_hbl_invoicing_consignee').text(cns);
          //           $('#hBL_hblid_invoice').text(hbl);
          //           $('#hBL_mblid_invoice').text(mbl);
          //           $('#search_hbl_consignee2_fname').focus();

          //           $('.progress-loader').remove();
          //      } else {
          //           $('.progress-loader').remove();
          //           alert(a);
          //      }


          // });

          // $('#mapp_StaffClass').load('load_staff_class_map.php');
          //  $('#mapp_StaffSubject').load('load_staff_subject_map.php');

          $('.consignee_hbl_invoicing_search').toggle();
     });
</script>