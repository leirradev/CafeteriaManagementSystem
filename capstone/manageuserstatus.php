<?php
	require_once("include/connection.php");	
	if((isset($_GET['user_id']))&&(isset($_GET['status']))&&(isset($_GET['deleted'])))
	{
	$get_productid = $_GET['user_id'];
	$get_status = $_GET['status'];
	$get_deleted = $_GET['deleted'];
	if(($get_status == "ACTIVE")&&($get_deleted == "0")){
		$sql = ("UPDATE user SET _status = 'BLOCKED' WHERE _id = {$get_productid}") or die("MALI4".mysql_error());
		mysql_query($sql);
		header("Location:userloadxml.php");
		}else if(($get_status == "BLOCKED")&&($get_deleted == "0")){
		$sql = ("UPDATE user SET _status = 'ACTIVE' WHERE _id = {$get_productid}") or die("MALI4".mysql_error());
		mysql_query($sql);
		header("Location:userloadxml.php");		
		}else{
		header("Location:edituser.php?status=error");
		}
	}
	else
	{
	$get_productid=NULL;
	$get_status=NULL;
	}
?>