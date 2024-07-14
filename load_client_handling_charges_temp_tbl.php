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
} else { ?>

  <table class="table table-bordered table-stripered" style="padding:0px;" id="LedgerControlTbl">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ACCOUNT NAME</th>
        <th scope="col">CHARGES</th>
        <th scope="col">TAX</th>
        <th scope="col">TOTAL</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>';


    <?php $a = mysqli_query($dbc, "select * from temp_other_invoice_view_0 where Username='$Uname' order by AccountName");

    if (mysqli_num_rows($a) > 0) {

      // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';

      //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
      while ($an = mysqli_fetch_assoc($a)) {
        $Total = $an['GetFundVal'] + $an['VATVal'];
        echo '
                <tr>
                  <td scope="col"><a title="' . $an['Description'] . '">' . $an['AccountName'] . '</a></td>
                  <td scope="col">' . number_format($an['Amount'], 2, '.', ',') . '</td>
                  <td scope="col">' . number_format($Total, 2, '.', ',') . '</td>
                  <td scope="col">' . number_format($an['GTotal'], 2, '.', ',') . '</td>';
        if ($an['GetFund'] || $an['VAT'] > 0) {
          echo '<td scope="col"><input type="checkbox" checked class="client_tax_charge" acc="' . $an['AccountNo'] . '"> <i class="fa fa-trash text-danger rm-client-charges ml-3" acc="' . $an['AccountNo'] . '"></i></td>
                </tr> ';
        } else {
          echo '<td scope="col"><input type="checkbox" class="client_tax_charge" acc="' . $an['AccountNo'] . '"> <i class="fa fa-trash text-danger rm-client-charges ml-3" acc="' . $an['AccountNo'] . '"></i></td>
                </tr> ';
        }
      }
      $c = mysqli_query($dbc, "select round(sum(GTotal),2) as Total from  temp_other_invoice_view_0 where Username='$Uname'");
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
                      <a class="btn btn-warning btn-user btn-block font-weight-bold" id="btn_save_client_invoice">
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

      $('#btn_save_client_invoice').click(function() {

        $('.progress-loader').remove();

        let rid = $.trim($('#client_rcpt_id_invoice').text());
        let rno = $.trim($('#client_rcpt_no_invoice').text());
        let cid = $.trim($('#search_client_oth_serv_id').text());
        let name = $.trim($('#search_client_other_invoice').val());
        let desc = $.trim($('#client_desc_invoice').val());
        let dot = $.trim($('#client_dot_invoice').val());

        if (dot == '') {
          alert('Select transaction date');
          return false;
        } else {
          $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
          q = confirm("Save client invoice?");

          if (q) {
            $.post('add_new_client_charges.php', {
              rid,
              rno,
              cid,
              dot,
              name,
              desc
            }, function(a) {
              if (a == 1) {
                $('.ep').text('');
                $('.ep').val('');
                $('#client_charges_display_details').load('load_client_handling_charges_temp_tbl.php');
                /** $.post('load_consignee_invoice_temp_tbl.php',{},function(a){
                          $('#cosignee_hbl_invoice_display_details').html(a);
                  });**/

                q = confirm('Proceed to generate Client Invoice?');
                if (q) {
                  $.post('insert_recno_rpt.php', {
                    sid: rno
                  }, function() {
                    var win = window.open();
                    win.location = "invoice_other_services.php", "_blank";
                    win.opener = null;
                    win.blur();
                    window.focus();
                    $('.progress-loader').remove();
                  });
                } else {
                  $('.progress-loader').remove();
                  return false;
                }
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

      $('.rm-client-charges').click(function() {
        let acc = $.trim($(this).attr('acc'));

        q = confirm('Remove account?');

        if (q) {
          $('#new-house-bl-invoice-panel').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
          $.post('remove_client_charge_account_temp.php', {
            cid: acc
          }, function(a) {
            if (a == 1) {
              //Display Consignee handling charges
              $('#client_charges_display_details').load('load_client_handling_charges_temp_tbl.php');
            } else {
              alert(a);
              $('.progress-loader').remove();
            }
          });
        }
      });
    </script>