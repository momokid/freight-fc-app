<?php



//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$id=  trim(mysqli_real_escape_string($dbc, $_POST['id']));
$bl=  trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$eta=  trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d',strtotime($_POST['eta']))));


if(!isset($_SESSION['Uname'])){
	
	header('Location: login');
	
}elseif(!isset($_SESSION['BranchID'])){
	header('Location: login');
}else if(!$_POST['bl']){
	echo json_encode(array('code'=>500,'msg'=>'Main BL not found.'));
}else if(!$_POST['id']){
	echo json_encode(array('code'=>500,'msg'=>'Consignment details not found.'));
}else{
	$a = mysqli_query($dbc, "SELECT * from eta_web_track where MainBL='$bl'");

	if(mysqli_num_rows($a)>0){
		echo json_encode(array('code'=>500,'msg'=>'Main BL already tracked. Please consider editing tracking details.'));
	}else{
		$b = mysqli_query($dbc,"INSERT INTO eta_web_track VALUES('$id','$bl','$eta','','1','$Uname','$ajaxTime')");

		if($b){
			echo json_encode(array('code'=>200,'msg'=>'Records updated successfully.'));
		}else{
			echo json_encode(array('code'=>500,'msg'=>'Records not updated successfully.'));
		}
	}
}




?>