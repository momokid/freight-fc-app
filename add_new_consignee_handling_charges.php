<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$rid=  (trim(mysqli_real_escape_string($dbc,$_POST['rid'])));
$rno=  (trim(mysqli_real_escape_string($dbc,$_POST['rno'])));


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($rid==''){
    die('Missing Transaction ID');
}elseif($rno==''){
    die('Missing Transaction No.');
}else{
    $a = mysqli_query($dbc, "select * from hbl_invoice_consignee_temp_view_0 where Username='$Uname'");
    
    if(mysqli_num_rows($a)==0){
        die('Handling charge(s) not yet added');
    }else{
        $b = mysqli_query($dbc, "SELECT distinct MainBL,HouseBL, ConsignmentID,ConsigneeID,Date from hbl_invoice_consignee_temp_view_0 where (Username='$Uname' AND Amount>0)"); 
        
        if(mysqli_num_rows($b)<>1){
            die('Multiple processing detecting for this user');
        }else{
            $b1 = mysqli_query($dbc, "select * from receipt_main where ReceiptNo='$recno'");
            if(mysqli_num_rows($b1)>0){
                die('Receipt No. already exists');
            }else{
                $bn = mysqli_fetch_assoc($b);
                
                //Set Student Ctrl and School Fee Receivable Ctrl
                $stc = mysqli_real_escape_string($dbc, $_SESSION['stc']);
                $fc = mysqli_real_escape_string($dbc, $_SESSION['fc']);

                if($fc==''){
                    die('Fee Receivable Account not configured yet'.$fc['AccountID']);
                }elseif($stc==''){
                    die('Student Control Account not properly set');
                }else{
                
                $dbc->autocommit(FALSE);
                $r = mysqli_query($dbc, "insert into receipt_main values('$rid','$bn[Date]','$rno','$Uname','$ajaxTime')");

                while($an = mysqli_fetch_assoc($a)){
                    $c = mysqli_query($dbc,"insert into hbl_invoice values('$an[ConsignmentID]','$an[MainBL]','$an[HouseBL]','$an[ConsigneeID]','$rno','$an[AccountNo]','$an[Amount]','$an[GetFundPcnt]','$an[VATPcnt]','$an[Date]','$ajaxTime','$Uname','1')");
                    $d = mysqli_query($dbc, "insert into student_fee values('$an[ConsigneeID]','$an[MainBL]','$an[HouseBL]','$an[AccountNo]','BL','Cost of $an[AccountName] ifo $an[HouseBL]','$rno','$an[SubTotalTax]','0','$an[Date]','$ajaxTime','$Uname','1')");
                    $g = $dbc->query("insert into journal values('$fc','$fc','Cr','NCash','$rno','0','$an[SubTotal]','COST OF HANDLING CHARGES IFO $an[FullName]: $an[MainBL]~$an[HouseBL]','$an[Date]','$ajaxTime','$Uname','N.Auth','$BranchID','2')");
                    $h = $dbc->query("insert into journal values('$stc','$an[ConsignmentID]','Dr','NCash','$rno','$an[SubTotal]','0','COST OF HANDLING CHARGES IFO $an[FullName]: $an[MainBL]~$an[HouseBL]','$an[Date]','$ajaxTime','$Uname','N.Auth','$BranchID','2')");

                }
                if($r and  $c and $g and $h){
                    $e = mysqli_query($dbc, "delete from hbl_invoice_consignee_temp where Username='$Uname'");
                    if($e){
                       $dbc->commit();
                        echo '1'; 
                    }else{
                        die($ERR);
                    }

                }else{
                    die($ERR);
                }
            }
        }
        
    }
    
  }     
}

?>