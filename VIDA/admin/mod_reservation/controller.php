<?php
require_once("../../includes/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'modify' :
	dbMODIFY();
	break;
	
	case 'delete' :
	doDelete();
	break;
	
	case 'deleteOne' :
	dbDELETEONE();
	break;
	case 'confirm' :
	doConfirm();
	break;
	case 'cancel' :
	doCancel();
	break;
	case 'checkin' :
	doCheckin();
	break;
	case 'checkout' :
	doCheckout();
	break;
	case 'cancelroom' :
	doCancelRoom();
	break;
	case 'clean' :
	doClean();
	break;
	case 'touched' :
	doTouched();
	break;
	case 'cleaning' :
	doCleaning();
	break;
	case 'dirty' :
	doDirty();
	break;
	case 'checked' :
	doChecked();
	break;
	case 'outofservice' :
	outofservice();
	break;
	case 'outoforder' :
	outofservice();
	break;
	}
function outoforder(){
		global $mydb;
		
		$query="SELECT * FROM `tblreservation` WHERE  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($query);
		$res = $mydb->loadResultList();

		foreach ($res as $cur) {
		$ROOMNAME=$cur->ROOMID;
		}

		$sql = "INSERT INTO tblhousekeeping (HK_DES, HK_ASSISTANT, HK_ACTION, HK_STATUS) VALUES ('ROOM #: $ROOMNAME','STAFF','UNDER RENOVATION','OUT OF ORDER')";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
		

		message("ROOM IS OUT OF ORDER!", "success");
		redirect('index.php');
}
	function outofservice(){
		global $mydb;
		
		$query="SELECT * FROM `tblreservation` WHERE  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($query);
		$res = $mydb->loadResultList();

		foreach ($res as $cur) {
		$ROOMNAME=$cur->ROOMID;
		}

		$sql = "INSERT INTO tblhousekeeping (HK_DES, HK_ASSISTANT, HK_ACTION, HK_STATUS) VALUES ('ROOM #: $ROOMNAME','STAFF','UNDER MAINTENANCE','OUT OF SERVICE')";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
		

		message("ROOM IS OUT OF SERVICE!", "success");
		redirect('index.php');
}
	function doDirty(){
		global $mydb;
		
		$query="SELECT * FROM `tblreservation` WHERE  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($query);
		$res = $mydb->loadResultList();

		foreach ($res as $cur) {
		$ROOMNAME=$cur->ROOMID;
		}

		$sql = "INSERT INTO tblhousekeeping (HK_DES, HK_ASSISTANT, HK_ACTION, HK_STATUS) VALUES ('ROOM #: $ROOMNAME','STAFF','CLEAN ROOM','DIRTY')";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
		

		message("DIRTY ROOM HAS BEEN REPORTED!", "success");
		redirect('index.php');
}
function doTouched(){
		global $mydb;
		
		$query="SELECT * FROM `tblreservation` WHERE  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($query);
		$res = $mydb->loadResultList();

		foreach ($res as $cur) {
		$ROOMNAME=$cur->ROOMID;
		}

		$sql = "INSERT INTO tblhousekeeping (HK_DES, HK_ASSISTANT, HK_ACTION, HK_STATUS) VALUES ('ROOM #: $ROOMNAME','STAFF','INSPECTED ROOM','TOUCHED')";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
		

		message("ROOM HAS BEEN TOUCHED!", "success");
		redirect('index.php');
}
function doChecked(){
		global $mydb;
		
		$query="SELECT * FROM `tblreservation` WHERE  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($query);
		$res = $mydb->loadResultList();

		foreach ($res as $cur) {
		$ROOMNAME=$cur->ROOMID;
		}

		$sql = "INSERT INTO tblhousekeeping (HK_DES, HK_ASSISTANT, HK_ACTION, HK_STATUS) VALUES ('ROOM #: $ROOMNAME','STAFF','INSPECTED ROOM','CHECKED')";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
		

		message("ROOM IS DONE ON INSPECTION!", "success");
		redirect('index.php');
}

function doCleaning(){
		global $mydb;
		
		$query="SELECT * FROM `tblreservation` WHERE  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($query);
		$res = $mydb->loadResultList();

		foreach ($res as $cur) {
		$ROOMNAME=$cur->ROOMID;
		}

		$sql = "INSERT INTO tblhousekeeping (HK_DES, HK_ASSISTANT, HK_ACTION, HK_STATUS) VALUES ('ROOM #: $ROOMNAME','STAFF','UNDER MAINTENANCE','CLEANING')";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
		

		message("ROOM IS CURRENTLY CLEANING BY PERSON IN CHARGED!", "success");
		redirect('index.php');
}
	function doClean(){
		global $mydb;
		
		$query="SELECT * FROM `tblreservation` WHERE  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
		$mydb->setQuery($query);
		$res = $mydb->loadResultList();

		foreach ($res as $cur) {
		$ROOMNAME=$cur->ROOMID;
		}

		$sql = "INSERT INTO tblhousekeeping (HK_DES, HK_ASSISTANT, HK_ACTION, HK_STATUS) VALUES ('ROOM #: $ROOMNAME','STAFF','APPROVED ROOM','CLEAN')";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
		

		message("ROOM IS READY FOR THE GUEST!", "success");
		redirect('index.php');
}
function doCheckout(){

		global $mydb;

		$sql = "UPDATE `tblreservation` SET `STATUS`='Checkedout' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'"; 
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 

		$sql = "UPDATE `tblpayment` SET `STATUS`='Checkedout' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'"; 
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
					
		message("Reservation Upadated successfully!", "success");
		redirect('index.php');

}
function doCheckin(){
 
 global $mydb;

$sql = "UPDATE `tblreservation` SET `STATUS`='Checkedin' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'"; 
$mydb->setQuery($sql);
$mydb->executeQuery(); 
 

$sql = "UPDATE `tblpayment` SET `STATUS`='Checkedin' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'"; 
$mydb->setQuery($sql);
$mydb->executeQuery(); 

 
message("Reservation Upadated successfully!", "success");
redirect('index.php');



}


function doCancel(){
global $mydb;

$sql = "UPDATE `tblreservation` r,tblroom rm SET ROOMNUM=ROOMNUM + 1 WHERE r.`ROOMID`=rm.`ROOMID` AND `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
$mydb->setQuery($sql);
$mydb->executeQuery(); 


$sql = "UPDATE `tblreservation` SET `STATUS`='Cancelled' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'"; 
$mydb->setQuery($sql);
$mydb->executeQuery(); 


$sql = "UPDATE `tblpayment` SET `STATUS`='Cancelled' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'"; 
$mydb->setQuery($sql);
$mydb->executeQuery(); 

				
message("Reservation Upadated successfully!", "success");
redirect('index.php');

}
function doCancelRoom(){ 
	global $mydb;

	$mydb->setQuery("SELECT * FROM `tblreservation` WHERE  `RESERVEID` ='" . $_GET['id'] ."'");
	$cur = $mydb->loadResultList(); 
	foreach ($cur as $result) {  

	$room = new Room(); 
	$room->ROOMNUM    = $room->ROOMNUM + 1; 
	$room->update($result->ROOMID); 

	}


$sql = "UPDATE `tblreservation` SET `STATUS`='Cancelled' WHERE `RESERVEID` ='" . $_GET['id'] ."'";
mysql_query($sql) or die(mysql_error());

				
message("Reservation Upadated successfully!", "success");
redirect('index.php');

}

function doConfirm(){
global $mydb; 

$sql = "UPDATE `tblreservation` r,tblroom rm SET ROOMNUM=ROOMNUM - 1 WHERE r.`ROOMID`=rm.`ROOMID` AND  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";

$mydb->setQuery($sql);
$mydb->executeQuery();


$sql = "UPDATE `tblreservation` SET `STATUS`='Confirmed' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";

$mydb->setQuery($sql);
$mydb->executeQuery(); 

$sql = "UPDATE `tblpayment` SET `STATUS`='Confirmed' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";

$mydb->setQuery($sql);
$mydb->executeQuery();






message("Reservation Upadated successfully!", "success");
redirect('index.php');

}	
 
function doDelete(){

	global $mydb;

	$sql = "DELETE FROM tblpayment WHERE CONFIRMATIONCODE='" . $_GET['code'] ."'"; 
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	
	$sql = "DELETE FROM tblreservation WHERE CONFIRMATIONCODE='" . $_GET['code'] ."'"; 
	$mydb->setQuery($sql);
	$res = $mydb->executeQuery();
	if ($res) {
		# code...
	message("Reservation Deleted successfully!", "success");
 	redirect('index.php');
	}else{
	message("Reservation cannot be deleted!", "error");
 	redirect('index.php');
	}
  }
?>