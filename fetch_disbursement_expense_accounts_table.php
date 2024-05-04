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


  $c = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis_view_0 WHERE Username='$Uname' AND BL='$mbl' AND HouseBL='$hbl' and ConsigneeID='$consigneeID' ORDER BY Type DESC");
  $cn = mysqli_fetch_assoc($c);

  echo '  <table>
              <tr>
                <td colspan="3" class="table-title">  ' . $cn['HouseBL'] . ' ' . $cn['ConsigneeName'] . '</td>
              </tr> 
            <table/>';

  echo '<table class="table table-bordered table-responsive" style="padding:0px;">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ACCOUNT NAME</th>
                  <th scope="col">CASH RECEIVED</th>
                  <th scope="col">EXPENSE</th>
                </tr>
              </thead>
              <tbody>';

  $a = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis_view_0 WHERE Username='$Uname' AND BL='$mbl' AND HouseBL='$hbl' and ConsigneeID='$consigneeID' ORDER BY Type DESC");

  if (mysqli_num_rows($a) > 0) {



    while ($an = mysqli_fetch_assoc($a)) {

      echo '
            <tr>
              <td scope="col" class="expense_input_label">' . $an['AccountName'] . '</td>
              <td scope="col"></td>
              <td scope="col"><input class="income_input_value" type="number" value="' . $an['Amount'] . '"  data-consignee="' . $an['ConsigneeID'] . '" data-hbl="' . $an['HouseBL'] . '" data-accountno="' . $an['AccountNo'] . '" /></td>
            </tr> ';
    }
  } else {
  }

  $f = totalDisbursementExpenseBL($hbl, $consigneeID);
  $g = totalDisbursementExpense($Uname);

  echo '
              <tr>
                <td>BL SUBTOTAL</td>
                <td colspan="2">
                    <label class="text-danger font-weight-bold" id="txtSubTotalExpnsePerBL">'.formatToCurrency($f).'</label>
                </td>
              </tr>

              <tr>
                <td>DISBURSEMENT TOTAL</td>
                <td colspan="2">
                    <label class="text-danger font-weight-bold" id="txtDisbursementTotalExpense">'.formatToCurrency($g).'</label>
                </td>
              </tr>


          </tbody>
        </table>';
}

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
        
        if(result.status_code == 201){
          
          $.post('disbursement_fetch_subtotal_bl.php',{consigneeID, hbl,totalAmount},function(data){
            let result = JSON.parse(data);
            $('#txtSubTotalExpnsePerBL').html(result.totalExpenditureBL);
            $('#txtDisbursementTotalExpense').html(result.totalExpenditure);
            $('#lblTotalDisbursement').html(result.NetPNL)
            console.log(data)
          });

        }else{
          console.error('error gettting the resul');
        }

      })
    })

  });
</script>