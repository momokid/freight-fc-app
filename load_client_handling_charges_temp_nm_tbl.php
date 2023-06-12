<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if (!isset($_SESSION['Uname'])) {
  header('Location: login');
} else {
  $a = mysqli_query($dbc, "select * from temp_other_invoice_non_manifest_view_0 where Username='$Uname' order by Time");


  if (mysqli_num_rows($a) == 0) {
    echo '<table class="table table-bordered table-responsive" style="padding:0px;" id="dataTables">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ACCOUNT NAME</th>
                        <th scope="col">CHARGES</th>
                        <th scope="col">21%</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>';
  } else {

    // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
    echo '<table class="table table-bordered table-stripered" style="padding:0px;" id="LedgerControlTbl">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ACCOUNT NAME</th>
                        <th scope="col">CHARGES</th>
                        <th scope="col">21%</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                   <tbody>';
    //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
    while ($an = mysqli_fetch_assoc($a)) {
      $Total = $an['GetFundVal'] + $an['NHILVal'] + $an['CovidVal'] + $an['VATVal'];
      echo '
                <tr>
                  <td scope="col"><a title="' . $an['Description'] . '">' . $an['AccountName'] . '</a></td>
                  <td scope="col">' . number_format($an['Amount'], 2, '.', ',') . '</td>
                  <td scope="col">' . number_format($Total, 2, '.', ',') . '</td>
                  <td scope="col">' . number_format($an['GTotal'], 2, '.', ',') . '</td>';
      echo '<td scope="col"><i class="fa fa-trash text-danger rm-client-charges-nonm ml-3" acc="' . $an['AccountNo'] . '"></i></td>';
    }
    $c = mysqli_query($dbc, "select round(sum(GTotal),2) as Total from  temp_other_invoice_non_manifest_view_0 where Username='$Uname'");
    while ($cn = mysqli_fetch_assoc($c)) {
      echo '
                <tr>
                  <td scope="col" class="text-right">TOTAL CHARGES:</td>
                  <td scope="col" colspan="3"><b>' . number_format($cn['Total'], 2, '.', ',') . '</b></td>
                  <td scope="col"></td>
                </tr> ';
    }

    echo '</tbody>
             </table>
             <div class="btn-group btn-group-toggle mb-3 sr-only" data-toggle="buttons">
                <label class="btn btn-secondary active">
                  <input type="radio" name="options" id="option1" autocomplete="off" checked> Add VAT
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="options" id="option3" autocomplete="off"> No VAT
                </label>
              </div>';

    echo '
                <div class="form-group row">
                    <form class="user">
                      <a class="btn btn-warning btn-user btn-block font-weight-bold" id="btn_save_client_invoice_nonm">
                        Save Client Invoice
                      </a>
                    </form>
                </div>';
  }
}
?>

<style>
  .thead-lig {
    background: green;
    color: white;
  }

  .table-r0:hover {
    background: black;
    color: white;
    cursor: pointer;
  }
</style>

<script>
  //
  $('.client_tax_charge').click(function() {
    let acc = $.trim($(this).attr('acc'));

    if ($(this).prop("checked") == true) {
      $.post('add_client_tax.php', {
        acc: acc
      }, function(a) {
        if (a == 1) {
          $('#client_charges_display_details').load('load_client_handling_charges_temp_tbl.php');
        } else {
          alert(a);
        }
      });
    } else {
      $.post('remove_client_tax.php', {
        acc: acc
      }, function(a) {
        if (a == 1) {
          $('#client_charges_display_details').load('load_client_handling_charges_temp_tbl.php');
        } else {
          alert(a);
        }
      });
    }
  });

  //
  $('#btn_save_client_invoice_nonm').click(function() {
    let rid = $.trim($('#client_rcpt_id_invoice_nonm').text());
    let rno = $.trim($('#client_rcpt_no_invoice_nonm').text());
    let cid = $.trim($('#consignee_id_invoice_nonm').text());
    let dot = $.trim($('#client_dot_invoice_nonm').val());
    let desc = $.trim($('#client_desc_invoice_nonm').val());
    let name = $.trim($('#search_consignee_manifest').val());
    let mbl = $("#sel_bl_invoice_nonm :selected").attr('mbl');
    let hbl = $("#sel_bl_invoice_nonm :selected").attr('hbl');

    if (dot === '') {
      alert('Select transaction date');
      return false;
    } else {
      $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
      q = confirm("Save client invoice?");

      if (q) {
        $.post('add_new_client_charges_non_mainfest.php', {
          rid: rid,
          rno: rno,
          cid: cid,
          dot: dot,
          desc: desc,
          name: name,
          mbl: mbl,
          hbl: hbl
        }, function(a) {
          if (a == 1) {
            $('.ep').text('');
            $('.ep').val('');
            $('#client_charges_display_details_nonm').load('load_client_handling_charges_temp_nm_tbl.php');
            $('#sel_ots_acc_invoice_nonm').load('load_sel_billing_account.php');
            /** $.post('load_consignee_invoice_temp_tbl.php',{},function(a){
                      $('#cosignee_hbl_invoice_display_details').html(a);
              });**/

            $.post('insert_recno_rpt.php', {
              sid: rno
            }, function() {
              var win = window.open();
              win.location = "invoice_other_services_non_manifest.php", "_blank";
              win.opener = null;
              win.blur();
              window.focus();
              $('.progress-loader').remove();
            });

            $('#btn_consignee_manifestation').focus();
          } else {
            alert(a);
            $('.progress-loader').remove();
            return false;
          }
        });
      } else {
        $('.progress-loader').remove();
        return false;
      }
    }
  });

  $('.rm-client-charges-nonm').click(function() {
    let acc = $.trim($(this).attr('acc'));

    q = confirm('Remove account?');

    if (q) {
      $('#new-house-bl-invoice-panel').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
      $.post('remove_client_charge_account_temp_nonm.php', {
        cid: acc
      }, function(a) {
        if (a == 1) {
          //Display Consignee handling charges
          $('#client_charges_display_details_nonm').load('load_client_handling_charges_temp_nm_tbl.php');
        } else {
          alert(a);
          $('.progress-loader').remove();
        }
      });
    }
  });
</script>