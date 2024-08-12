<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$acc=  intval(trim(mysqli_real_escape_string($dbc,$_POST['acc'])));
$amt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['amt'])));
$mbl=  (trim(mysqli_real_escape_string($dbc,$_POST['mbl'])));
$accName=  (trim(mysqli_real_escape_string($dbc,$_POST['accName'])));
$taxStatus=  trim(mysqli_real_escape_string($dbc,$_POST['taxStatus']));


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($acc==''){
    $result = [
        'code'=>401,
        'msg'=>'Select Account',
    ];
}elseif($amt<=0){
    $result = [
        'code'=>401,
        'msg'=>'Select Amount',
    ];
}else{
    $t = mysqli_query($dbc, "SELECT * from charge_taxes");
    if(mysqli_num_rows($t)==0){
        $result = [
            'code'=>401,
            'msg'=>'Taxes not configured',
        ];
    }else{
    $a = mysqli_query($dbc, "SELECT * FROM hbl_invoice_consignee_temp WHERE Username<>'$Uname'");
    
    if(mysqli_num_rows($a)>0){
        $result = [
            'code'=>401,
            'msg'=>'Invoicing already initiated by '.$Uname,
        ];
    }else{

        $tn = mysqli_fetch_assoc($t);
        if($taxStatus == 'false'){
            $tn['GetFund']=0;
            $tn['VAT']=0;
            $tn['Covid']=0;
        }

        $b = mysqli_query($dbc, "SELECT DISTINCT MainBL,HouseBL, ConsignmentID FROM hbl_invoice_consignee_temp WHERE Username='$Uname'"); 
        
        if(mysqli_num_rows($b)>1){
            $result = [
                'code'=>401,
                'msg'=>'Multiple processing detecting for this user',
            ];
        }else{
            $an = mysqli_fetch_assoc($b);
            $e = mysqli_query($dbc, "SELECT * FROM hbl_invoice_consignee_temp WHERE Username='$Uname' AND AccountNo='$acc'");
            
            if(mysqli_num_rows($e)>0){
                $c = mysqli_query($dbc, "UPDATE hbl_invoice_consignee_temp SET Amount='$amt',VAT='$tn[VAT]',Covid='$tn[Covid]',GetFundNHIL='$tn[GetFund]' where Username='$Uname' and AccountNo='$acc' and MainBL='$an[MainBL]'  and ConsignmentID='$an[ConsignmentID]'");
                if($c){
                    $result = [
                        'code'=>200,
                        'msg'=>'Update successfully',
                    ];
                }else{
                    $result = [
                        'code'=>401,
                        'msg'=>$ERR,
                    ];
                }
            }else{
                $c = $dbc->query("INSERT INTO hbl_invoice_consignee_temp VALUES('','$mbl','$an[HouseBL]','$an[ConsigneeID]','$acc','$tn[GetFund]','$tn[Covid]','$tn[VAT]','$amt','$ajaxDate','$ajaxTime','$Uname') ");
            
                if($c){
                    $result = [
                        'code'=>200,
                        'msg'=>"$accName added successfully",
                    ];
                }else{
                    $result = [
                        'code'=>401,
                        'msg'=>$ERR,
                    ];
                }
            }
            
        }
        
        }
    } 
        
}

echo json_encode($result);