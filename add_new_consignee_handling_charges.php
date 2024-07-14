<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$recID =  (trim(mysqli_real_escape_string($dbc, $_POST['rid'])));
$recNo =  (trim(mysqli_real_escape_string($dbc, $_POST['rno'])));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    $a = mysqli_query($dbc, "SELECT * FROM mbl_invoice_temp_view_1 where Username='$Uname'");

    if (mysqli_num_rows($a) == 0) {
        $result = [
            'code' => 301,
            'msg' => 'Handling charge(s) not yet added',
        ];
    } else {
        $b = mysqli_query($dbc, "SELECT distinct MainBL,Date from mbl_invoice_temp_view_1 where (Username='$Uname' AND Amount>0)");

        if (mysqli_num_rows($b) <> 1) {
            $result = [
                'code' => 401,
                'msg' => 'Multiple processing detecting for this user',
            ];
        } else {

            $bn = mysqli_fetch_assoc($b);

            //Receipt Number and ID
            $r = getReceiptDetails($bn['Date']);
            $recID = $r['Id'];
            $recNo = $r['number'];

            $b1 = mysqli_query($dbc, "SELECT * from receipt_main where ReceiptNo='$recNo'");
            if (mysqli_num_rows($b1) > 0) {
                $result = [
                    'code' => 401,
                    'msg' => 'Receipt No. already exists ' . $bn['Date'],
                ];
            } else {

                //Set Student Ctrl and School Fee Receivable Ctrl
                $stc = mysqli_real_escape_string($dbc, $_SESSION['stc']);
                $fc = mysqli_real_escape_string($dbc, $_SESSION['fc']);

                if ($fc == '') {
                    $result = [
                        'code' => 401,
                        'msg' => 'Receivable Account not configured yet' . $fc['AccountID']
                    ];
                } elseif ($stc == '') {
                    $result = [
                        'code' => 401,
                        'msg' => 'Receivable Account not configured yet' . $fc['AccountID']
                    ];
                } else {

                    $dbc->autocommit(FALSE);

                    $r = mysqli_query($dbc, "insert into receipt_main values('$recID','$bn[Date]','$recNo','$Uname','$ajaxTime')");

                    while ($an = mysqli_fetch_assoc($a)) {
                        $c = mysqli_query($dbc, "insert into bl_invoice values('$an[ConsignmentID]','$an[MainBL]','$an[ConsigneeID]','$recNo','$an[AccountNo]','$an[Amount]','$an[GetFundPcnt]','$an[VATPcnt]','$an[Date]','$ajaxTime','$Uname','1')");
                        $d = mysqli_query($dbc, "insert into student_fee values('$an[ConsigneeID]','$an[MainBL]','$an[MainBL]','$an[AccountNo]','BL','Cost of $an[AccountName] ifo $an[MainBL]','$recNo','$an[SubTotalTax]','0','$an[Date]','$ajaxTime','$Uname','1')");
                       // $g = $dbc->query("insert into journal values('$fc','$fc','Cr','NCash','$recNo','0','$an[SubTotal]','COST OF HANDLING CHARGES IFO $an[FullName]: $an[MainBL]~$an[MainBL]','$an[Date]','$ajaxTime','$Uname','N.Auth','$BranchID','2')");
                        // $h = $dbc->query("insert into journal values('$stc','$an[ConsignmentID]','Dr','NCash','$recNo','$an[SubTotal]','0','COST OF HANDLING CHARGES IFO $an[FullName]: $an[MainBL]~$an[MainBL]','$an[Date]','$ajaxTime','$Uname','N.Auth','$BranchID','2')");
                    }
                    if ($r && $c && $g && $h) {

                        $dbc->commit();

                        $e = mysqli_query($dbc, "DELETE from hbl_invoice_consignee_temp WHERE Username='$Uname'"); //
                        if ($e) {
                            $dbc->commit();
                            $result = [
                                'code' => 200,
                                'msg' => 'Invoice saved successfully',
                                'recNo'=>$recNo
                            ];
                        } else {
                            $result = [
                                'code' => 401,
                                'msg' => $ERR
                            ];
                        }
                    } else {
                        $result = [
                            'code' => 401,
                            'msg' => $ERR
                        ];
                    }
                }
            }
        }
    }
}


echo json_encode($result);
