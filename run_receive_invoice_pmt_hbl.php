<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$stid=  trim(mysqli_real_escape_string($dbc,$_POST['stid']));
//$note=  trim(mysqli_real_escape_string($dbc,$_POST['note']));
$desc=  trim(mysqli_real_escape_string($dbc,$_POST['desc']));
$recid=  trim(mysqli_real_escape_string($dbc,$_POST['recid']));
$recno=  trim(mysqli_real_escape_string($dbc,$_POST['recno']));
$dt=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dt']))));
$amt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['amt'])));
$accid=  trim(mysqli_real_escape_string($dbc,$_POST['acc']));
$hbl=  trim(mysqli_real_escape_string($dbc,$_POST['hbl']));
$mbl=  trim(mysqli_real_escape_string($dbc,$_POST['mbl']));

if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}elseif($amt<=0){
    die('Missing Data: Enter Amount Paid');
}elseif($accid==''){
    die('Missing Data: Select Cash Account');
}elseif($dt==''){
    die('Missing Data: Select Transaction Date');
}elseif($desc==''){
    die('Missing Data: Enter Transaction Description ');
}elseif($recid=='' or $recno==''){
    die('Missing Data: Invalid Transaction ID/No');
}elseif($hbl==''){
    die('Missing Data: House BL#');
}else{
    $z = mysqli_query($dbc, "select * from  manifestation_breakdown_view where ConsigneeID='$stid' and MainBL='$mbl' and HouseBL='$hbl'");
    if(mysqli_num_rows($z)<>1){
        die('Error: Unknown Manifest Breakdown');
    }else{
        $zn = mysqli_fetch_assoc($z);
        
    $a = mysqli_query($dbc, "select * from  receipt_main where ReceiptNo='$recno'");
     if(mysqli_num_rows($a)>0){
         die('Receipt No already exists '.$recno);
     }else{
         
             //$bn = mysqli_fetch_assoc($b);
             if($dt<$zn['TDate']){
                 die('All payments must be after '. strftime("%d %b, %Y", strtotime($zn['TDate'])));
             }else{
                 $c = mysqli_query($dbc, "select * from student_fee_outstading_view_0 where StudentID='$stid' and CouponID='$hbl' and SubClassID='$mbl' and Balance>0");
                 if(mysqli_num_rows($c)==0){
                     die('Student debt details not found');
                 }else{
                     $cn= mysqli_fetch_assoc($c);
                     if($amt>$cn['Balance']){
                         die('Cannot pay mote than outstanding of '.number_format($cn['Balance'],2,'.',','));
                     }else{
                     
                     //Find the highest number in ccdb
                        $cc = mysqli_query($dbc, "select * from ccdb");
                        if(mysqli_num_rows($cc)==0){
                            $ccd = '1';
                        }else{
                            $cc2 = mysqli_query($dbc, "select max(ID) as ID from ccdb");
                            $ccn = mysqli_fetch_assoc($cc2);

                            $ccd = intval($ccn['ID'])+1;
                        }    
                         
                     //Get Activ IE account
                     $inc = mysqli_query($dbc, "select * from  active_ie");
                     if(mysqli_num_rows($inc)<>1){
                         die('Active IE account not configured');
                     }else{
                      $in = mysqli_fetch_assoc($inc);
                      
                     $d = mysqli_query($dbc, "select * from student_fee_outstading_view_order_1 where StudentID='$stid' and CouponID='$hbl' and SubClassID='$mbl' order by  PmtOrder");
                    if(mysqli_num_rows($d)==0){
                        echo 'Debt details not found';
                    }else{
                        //Set Student Ctrl and School Fee Receivable Ctrl
                        $stc = mysqli_real_escape_string($dbc, $_SESSION['stc']);
                        $fc = mysqli_real_escape_string($dbc, $_SESSION['fc']);
                        
                        if($fc==''){
                            die('Fee Receivable Account not configured yet'.$fc['AccountID']);
                        }elseif($stc==''){
                            die('Student Control Account not properly set');
                        }else{
                        
                        floatval($NB = $amt);
                        
                        $dbc->autocommit(FALSE);

                        $e = $dbc->query("insert into receipt_main values('$recid','$dt','$recno','$Uname','$ajaxTime')");
                        $f = $dbc->query("insert into journal values('$accid','$accid','Dr','NCash','$recno','$amt','0','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                        $m = $dbc->query("insert into journal values('$fc','$fc','Cr','NCash','$recno','$amt','0','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                        $n = $dbc->query("insert into journal values('$stc','$stc','Dr','NCash','$recno','0','$amt','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");

                        while($dn = mysqli_fetch_assoc($d)){
                            if($NB>=$dn['Balance']){
                                $g = $dbc->query("insert into student_fee values('$stid','$zn[MainBL]','$zn[HouseBL]','$dn[AccountNo]','BL','$desc','$recno','0','$dn[Balance]','$dt','$ajaxTime','$Uname','1')");
                                $g1 = $dbc->query("insert into pnl_transaction values('$dn[AccountNo]','BL','Cr','$zn[MainBL]','$zn[HouseBL]','$recno','$desc','0','$dn[Balance]','$dt','$ajaxTime','$BranchID','$Uname','1')");
                                $g2 = $dbc->query("insert into journal values('$in[AccountID]','$dn[AccountNo]','Cr','NCash','$recno','0','$dn[Balance]','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                                if($g and $g1){
                                   // $dbc->commit();
                                   
                                }else{
                                    die($ERR);
                                }
                                
                                $NB=$NB-$dn['Balance'];
                                if($NB<=0){
                                    $h1= mysqli_query($dbc, "select * from kaina");
                                    $h2= mysqli_query($dbc, "select * from kaina");
                                    $h= mysqli_query($dbc, "select * from kaina");
                                    break;
                                }
                            }elseif($NB<$dn['Balance']){
                                 $h = $dbc->query("insert into student_fee values('$stid','$zn[MainBL]','$zn[HouseBL]','$dn[AccountNo]','BL','$desc','$recno','0','$NB','$dt','$ajaxTime','$Uname','1')");
                                 $h1 = $dbc->query("insert into pnl_transaction values('$dn[AccountNo]','BL','Cr','$zn[MainBL]','$zn[HouseBL]','$recno','$desc','0','$NB','$dt','$ajaxTime','$BranchID','$Uname','1')");
                                 $h2 = $dbc->query("insert into journal values('$in[AccountID]','$dn[AccountNo]','Cr','NCash','$recno','0','$NB','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                                 if($h and $h1){
                                    //$dbc->commit();
                                    
                                }else{
                                    die($ERR);
                                }
                                    $g1= mysqli_query($dbc, "select * from kaina");
                                    $g2= mysqli_query($dbc, "select * from kaina");
                                    $g= mysqli_query($dbc, "select * from kaina");
                                break;
                            }
                           // echo $dn['AccountName']." is ".$dn['Balance']." and the Order is ".$dn['PmtOrder']." ";

                       }
                       $ccdb = $dbc->query("insert into ccdb values('$ccd','$desc IFO ~$stid on $dt','$Uname','$ajaxTime')");
                       
                       if($h and $h1 and $h2 and $g and $g1 and $g2 and $m and $n and $ccdb){
                            $dbc->commit();
                            echo '1';
                        }else{
                            die($ERR);
                        }
                     } 
                   }   
                 }
               }  
             }
           }
         }
     }
   } 


?>