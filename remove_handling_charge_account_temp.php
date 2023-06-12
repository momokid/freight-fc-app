
<?php
//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns = mysqli_real_escape_string($dbc, $_POST['cns']);
$cnm = mysqli_real_escape_string($dbc, $_POST['cnm']);
$hbl = mysqli_real_escape_string($dbc, $_POST['hbl']);
$mbl = mysqli_real_escape_string($dbc, $_POST['mbl']);
$acc = mysqli_real_escape_string($dbc, $_POST['acc']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($acc == '') {
    die('Account details not found');
} elseif ($cns == '') {
    die('Missing Consignee ID');
} elseif ($cnm == '') {
    die('Missing Consignment ID');
} elseif ($mbl == '') {
    die('Missing Main BL');
} elseif ($hbl == '') {
    die('Mssing House BL');
} else {
    $c =  mysqli_query($dbc, "select * from hbl_invoice_consignee_temp where AccountNo='$acc' and ConsigneeID='$cns' and ConsignmentID='$cnm' and MainBL='$mbl' and HouseBL='$hbl' and Username='$Uname'");

    if (mysqli_num_rows($c) > 0) {

        $b =  mysqli_query($dbc, "delete from  hbl_invoice_consignee_temp where AccountNo='$acc' and ConsigneeID='$cns' and ConsignmentID='$cnm' and MainBL='$mbl' and HouseBL='$hbl' and Username='$Uname'");

        if ($b) {
            echo '1';
        } else {
            die($ERR);
        }
    } else {
        die('Handling charge account details not found');
    }
}

?>