<?php
	require_once("include/connection.php");
	if(isset($_GET['id']))
	{
	$get_productid = $_GET['id'];
	}
	else
	{
	$get_productid=NULL;
	}
	$query2 = mysql_query("DELETE FROM category WHERE categoryname = '{$get_productid}'") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:productcategory.php?status=deleted")or die("MALI".mysql_error());
?>