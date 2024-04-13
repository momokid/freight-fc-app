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

  echo '<table class="table table-bordered table-responsive" style="padding:0px;">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ACCOUNT NAME</th>
                  <th scope="col">CASH RECEIVED</th>
                  <th scope="col">EXPENSE</th>
                </tr>
              </thead>
              <tbody>';

  $a = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis_view WHERE Username='$Uname' AND BL='$mbl' AND HouseBL='$hbl' and ConsigneeID='$consigneeID' ORDER BY Type DESC");

  if (mysqli_num_rows($a) > 0) {
    while ($an = mysqli_fetch_assoc($a)) {

      if ($an['Type'] == 'INCOME') {
        echo '
            <tr>
              <td scope="col" class="income_input_label">' . $an['AccountName'] . '</td>
              <td scope="col"><input class="income_input_value" type="number" value="' . $an['Amount'] . '"  data-consignee="' . $an['ConsigneeID'] . '" data-hbl="' . $an['HouseBL'] . '" data-accountno="' . $an['AccountNo'] . '" /></td>
              <td scope="col"></td>
            </tr> ';
      } else {
        echo '
            <tr>
              <td scope="col" class="expense_input_label">' . $an['AccountName'] . '</td>
              <td scope="col"></td>
              <td scope="col"><input class="income_input_value" type="number" value="' . $an['Amount'] . '"  data-consignee="' . $an['ConsigneeID'] . '" data-hbl="' . $an['HouseBL'] . '" data-accountno="' . $an['AccountNo'] . '" /></td>
            </tr> ';
      }
    }
  } else {
  }

  echo '</tbody>
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
</style>

<script>
  $(document).ready(function() {

    $('.income_input_value').blur(function() {

      const consigneeID = $.trim($(this).attr('data-consignee'));
      const hbl = $.trim($(this).attr('data-hbl'));
      const amount = this.value.trim();
      const accountNo = $.trim($(this).attr('data-accountno'));

      //console.log(`${consigneeID} ${hbl} ${amount} ${accountno}`)

      $.post('disbursement_update_payment.php',{consigneeID, hbl, amount, accountNo},function(){

      })
    })

  });
</script>