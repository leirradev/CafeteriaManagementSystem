<?php
	date_default_timezone_set('Asia/Manila');
	$time = date('h:i A', time());
	echo $time;
	require_once("include/connection.php");
	if(isset($_GET['transaction_id']))
	{
	$get_productid = $_GET['transaction_id'];
	}
	else
	{
	$get_productid=NULL;
	}
	$query2 = mysql_query("UPDATE transaction SET status = 'CLAIM', timeClaim = '{$time}' WHERE id = {$get_productid}") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:receipt.php?id=$get_productid")or die("MALI".mysql_error());
?>