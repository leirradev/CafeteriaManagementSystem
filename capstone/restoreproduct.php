<?php
	require_once("include/connection.php");
	if(isset($_GET['product_id']))
	{
	$get_productid = $_GET['product_id'];
	}
	else
	{
	$get_productid=NULL;
	}
	$query2 = mysql_query("UPDATE product SET deleted = 0, status = 'AVAILABLE' WHERE id = {$get_productid}") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:loadrestore.php")or die("MALI".mysql_error());
?>