<?php
	require_once("include/connection.php");	
	if((isset($_GET['product_id']))&&(isset($_GET['status']))&&(isset($_GET['deleted'])))
	{
	$get_productid = $_GET['product_id'];
	$get_status = $_GET['status'];
	$get_deleted = $_GET['deleted'];
	if(($get_status == "AVAILABLE")&&($get_deleted == "0")){
		$sql = ("UPDATE product SET status = 'NOT AVAILABLE' WHERE id = {$get_productid}") or die("MALI4".mysql_error());
		mysql_query($sql);
		header("Location:loadxml2.php");
		}else if(($get_status == "NOT AVAILABLE")&&($get_deleted == "0")){
		$sql = ("UPDATE product SET status = 'AVAILABLE' WHERE id = {$get_productid}") or die("MALI4".mysql_error());
		mysql_query($sql);
		header("Location:loadxml2.php");		
		}else{
		header("Location:productedit.php?status=error");
		}
	}
	else
	{
	$get_productid=NULL;
	$get_status=NULL;
	}
?>