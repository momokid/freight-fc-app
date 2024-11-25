<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$mbl = mysqli_real_escape_string($dbc, $_POST['mbl']);
$hbl = mysqli_real_escape_string($dbc, $_POST['hbl']);
$consigneeID = mysqli_real_escape_string($dbc, $_POST['consigneeID']);


if (!isset($_SESSION['Uname'])) {
  header('Location: login');
} else {


  $c = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis_view_0 WHERE Username='$Uname' AND BL='$mbl'  and ConsigneeID='$consigneeID' ORDER BY Time ASC");
  $cn = mysqli_fetch_assoc($c); ?>

  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
        <td colspan="3" class="table-title"> <span class="text-danger"><?= $cn['BL'] ?></span> - <?= $cn['ConsigneeName'] ?></td>
      </tr>
    </table>

    <table class="table table-bordered table-responsive" style="padding:0px;">
      <thead class="thead-light">
        <tr>
          <th scope="col">ACCOUNT NAME</th>
          <th scope="col">AMOUNT</th>
          <th scope="col">PAYMENT DATE</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>


        <?php
        //Check if payment has been initiated
        $a = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis_view_0 WHERE Username='$Uname' AND BL='$mbl'  AND ConsigneeID='$consigneeID' ORDER BY Status ASC");

        
        if (mysqli_num_rows($a) > 0) {

          while ($an = mysqli_fetch_assoc($a)) { ?>

            <?php
            if ($an['Status'] == 0) {
              $g = mysqli_query($dbc, "SELECT * FROM disbursement_analysis WHERE BL='$mbl'   AND AccountID='$an[AccountNo]' ORDER BY DATE DESC");
              if (mysqli_num_rows($g) == 1) {
                $gn = mysqli_fetch_assoc($g);
                $status = ($gn['Status'] == 0) ? "success" : "warning";
            ?>

                <tr>
                  <td scope="col" class="expense_input_label"><?= $an['AccountName'] ?></td>
                  <td scope="col"><?= formatToCurrency($gn['Expenditure']) ?></td>
                  <td scope="col"><?= formatDate($gn['Date'] ) ?></td>
                  <td class="text-center">
                    <i class="fas fa-check text-<?= $status ?>"></i>
                  </td>
                </tr>
              <?php }

              ?>


            <?php   } else { ?>

              <tr>
                <td scope="col" class="expense_input_label"><?= $an['AccountName'] ?></td>
                <td scope="col"><input class="income_input_value" type="number" value="<?= $an['Amount'] ?>" data-consignee="<?= $an['ConsigneeID'] ?>" data-hbl="<?= $an['HouseBL'] ?>" data-accountno="<?= $an['AccountNo'] ?>" /></td>
                <td scope="col"></td>
                <td class="text-danger text-center">
                  <button type="button" class="btn remove_expense_account" id="remove_expense_account" data-mbl="<?= $mbl ?>" data-hbl="<?= $hbl ?>" data-accountNo="<?= $an['AccountNo'] ?>" data-consignee="<?= $an['ConsigneeID'] ?>">
                    <i class="fas fa-minus-circle text-danger"></i>
                </td>
                </button>
              </tr>

          <?php }
          } ?>
          <tr>
            <td colspan="1">
              <select class="custom-select custom-select-sm sl-form-ctrl form-control" aria-label="Default select example" id="disbursement_temp_expense_account">
                <option selected></option>
              </select>
            </td>

            <td colspan="3" class="text-primary">
              <button type="button" class="btn" id="add_new_expense_account" data-mbl="<?= $mbl ?>" data-hbl="<?= $hbl ?>" data-consignee="<?= $consigneeID ?>" data-container="<?= $an['AccountNo'] ?>">
                <i class="fas fa-plus-circle text-primary"></i>
              </button>
            </td>

          </tr>
        <?php } else {
        }

        $f = totalDisbursementExpenseBL($hbl, $consigneeID);
        $g = totalDisbursementExpense($Uname);
        ?>

        <!-- <tr>
                <td>BL SUBTOTAL</td>
                <td colspan="2">
                    <label class="text-danger font-weight-bold" id="txtSubTotalExpnsePerBL">' . formatToCurrency($f) . '</label>
                </td>
              </tr> -->

        <tr>
          <td>DISBURSEMENT TOTAL</td>
          <td colspan="3">
            <label class="text-danger font-weight-bold" id="txtDisbursementTotalExpense"><?= formatToCurrency($g) ?></label>
          </td>
        </tr>

      </tbody>
    </table>
  </div>
<?php  }

?>

<style>
  .table-r0:hover {
    background: black;
    color: white;
    cursor: pointer;
  }

  .income_input_label {
    text-transform: uppercase;
    font-weight: bold;
    color: green;
  }

  .thead-light {
    text-align: center;
  }

  .income_input_value {
    outline: 0px;
    border: 1px solid green;
    width: 100px;
  }

  .expense_input_label {
    color: red;
  }

  .table-title {
    text-align: center;
    font-weight: bold;
    background-color: black;
    color: white;
  }
</style>

<script>
  $(document).ready(function() {

    $('#disbursement_temp_expense_account').load("load_sel_disbursement_account.php")

    //Update Disbursement balance
    $('.income_input_value').blur(function() {

      const consigneeID = $.trim($(this).attr('data-consignee'));
      const hbl = $.trim($(this).attr('data-hbl'));
      const amount = this.value.trim();
      const accountNo = $.trim($(this).attr('data-accountno'));
      const totalAmount = $.trim($('#txtTotalDisbursementIncome').val());

      console.log(`Total Amount is ${totalAmount}`);

      //console.log(`${consigneeID} ${hbl} ${amount} ${accountno}`)

      $.post('disbursement_update_payment.php', {
        consigneeID,
        hbl,
        amount,
        accountNo,
      }, function(data) {
        let result = JSON.parse(data);

        if (result.status_code == 201) {

          $.post('disbursement_fetch_subtotal_bl.php', {
            consigneeID,
            hbl,
            totalAmount
          }, function(data) {
            let result = JSON.parse(data);
            $('#txtSubTotalExpnsePerBL').html(result.totalExpenditureBL);
            $('#txtDisbursementTotalExpense').html(result.totalExpenditure);
            $('#lblTotalDisbursement').html(result.NetPNL)
            console.log(data)
          });

        } else {
          console.error('error gettting the resul');
        }

      })
    })

    //Add new disbursement expense account
    $('#add_new_expense_account').click(function() {
      let mbl = $(this).attr("data-mbl")
      let hbl = $(this).attr("data-hbl")
      let consigneeID = $(this).attr("data-consignee")
      let accountNo = $("#disbursement_temp_expense_account :selected").attr("id");
      let accountName = $('#disbursement_temp_expense_account :selected').val();

      $(".progress-loader").remove();
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post('add_new_temp_disbursement_expense.php', {
        mbl,
        hbl,
        accountNo,
        accountName
      }, function(response) {
        let data = JSON.parse(response);

        if (data.status_code == 200) {

          $.post('fetch_disbursement_expense_accounts_table.php', {
            mbl,
            hbl,
            consigneeID
          }, function(result) {

            $('#disbursement_fcl_account_display').html(result);
          })

          $(".progress-loader").remove();

        } else {

          alert(data.msg)
          $(".progress-loader").remove();
        }

      })

    });

    //Remove disbursement expense account
    $('.remove_expense_account').click(function() {
      let mbl = $(this).attr("data-mbl")
      let hbl = $(this).attr("data-hbl")
      let consigneeID = $(this).attr("data-consignee")
      let accountNo = $(this).attr("data-accountNo")


      let q = confirm("Remove account?");

      if (q) {
        $(".progress-loader").remove();
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );

        $.post('remove_temp_disbursement_expense.php', {
          mbl,
          hbl,
          accountNo
        }, function(response) {

          let data = JSON.parse(response);

          if (data.status_code == 200) {

            $.post('fetch_disbursement_expense_accounts_table.php', {
              mbl,
              hbl,
              consigneeID
            }, function(result) {

              $('#disbursement_fcl_account_display').html(result);
            })

            $(".progress-loader").remove();

          } else {

            alert(data.msg)
            $(".progress-loader").remove();
          }
        })
      } else {
        return false;
      }
    })

  });
</script>