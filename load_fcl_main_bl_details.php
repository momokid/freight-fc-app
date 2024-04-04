<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns =  (trim(mysqli_real_escape_string($dbc, $_POST['cns'])));
$mbl =  (trim(mysqli_real_escape_string($dbc, $_POST['mbl'])));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM  manifestation_breakdown_view_0 WHERE MainBL='$mbl'");

    echo '<table class="table table-bordered table-stripered" style="padding:0px;" id="LedgerControlTbl">
        <thead class="thead-dark">
            <tr>
            <th scope="col">CONSIGNEE</th>
            <th scope="col">MAIN BL</th>
            <th scope="col">CONTAINER#</th>
            <th scope="col">PARTICULARS</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>';

    if (mysqli_num_rows($a) == 1) {
        while ($an = mysqli_fetch_assoc($a)) {
            echo '
                <tr>
                  <td scope="col">' . $an['FullName'] . '</td>
                  <td scope="col">' . $an['MainBL'] . '</td>
                  <td scope="col">' . $an['ContainerNo'] . '</td>
                  <td scope="col">' . $an['Description'] . '</td>
                  <td scope="col"><button></button></td>
                </tr> ';
        }
    } else {
        echo '
                <tr>
                  <td scope="col" colspan="5">This BL contains multiple House BL. Try using LCL1 option.</td>
                </tr> ';
    }

    echo '</tbody>
        </table>';
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
    $(document).ready(function() {

    });
</script>