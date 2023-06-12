
<?php
//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cnt = mysqli_real_escape_string($dbc, $_POST['cnt']);
$seal = mysqli_real_escape_string($dbc, $_POST['seal']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($cnt == '') {
    die('Container No. not found');
} elseif ($seal == '') {
    die('Missing Seal No.');
} else {
    $c =  mysqli_query($dbc, "select * from new_container_temp where ContainerNo='$cnt' and SealNo='$seal'  and Username='$Uname'");

    if (mysqli_num_rows($c) > 0) {

        $b =  mysqli_query($dbc, "delete from  new_container_temp where ContainerNo='$cnt' and SealNo='$seal'  and Username='$Uname'");

        if ($b) {
            echo '1';
        } else {
            die($ERR);
        }
    } else {
        die('Container details not found' . $seal);
    }
}

?>