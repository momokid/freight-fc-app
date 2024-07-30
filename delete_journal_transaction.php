<?php



//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$id =  trim(mysqli_real_escape_string($dbc, $_POST['id']));

if (!isset($_SESSION['Uname'])) {

    header('Location: login');
} elseif (!isset($_SESSION['BranchID'])) {

    header('Location: login');
} else {

    $b = mysqli_query($dbc, "SELECT * FROM receipt_main WHERE ReceiptNo='$id'");

    if (mysqli_num_rows($b) == 0) {
        $res = [
            'code' => 301,
            'msg' => "Receipt# details not found in the system."
        ];
    } else {

        $a = mysqli_query($dbc, "SELECT * FROM journal WHERE ReceiptNo='$id'");

        if (mysqli_num_rows($a) == 0) {
            $res = [
                'code' => 301,
                'msg' => "Transaction details not found in journal."
            ];
        } else {

            $dbc->autocommit(false);

            while ($an = mysqli_fetch_assoc($a)) {

                $journal_log = mysqli_query($dbc, "INSERT INTO journal_log VALUES('$an[AccountID]','$an[SubAccountID]','$an[Mode]','$an[TType]','$an[ReceiptNo]','$an[Dr]','$an[Cr]','$an[Description]','$an[Date]','$an[Time]','$an[Username]','$an[BranchID]','$an[Status]','$ajaxTime','$ajaxDate')");
            }

            //Update container status
            $isDisbursement = checkDisbursementAnalysis($id);
            if ($isDisbursement['status']) {

                $update_container_status = mysqli_query($dbc, "UPDATE container_main SET Status='1', LastUpdate='$ajaxTime' WHERE BL='$isDisbursement[bl]'");
            
            };

            $delete_transaction = mysqli_query($dbc,"DELETE FROM receipt_main WHERE ReceiptNo='$id'");

            if ( $journal_log) {

                $dbc->autocommit(true);

                $res = [
                    'code' => 200,
                    'msg' => "Transaction deleted successfully",
                ];
            } else {
                $res = [
                    'code' => 301,
                    'msg' => $ERR,
                ];
            }
        }
    }
}

echo json_encode($res);
