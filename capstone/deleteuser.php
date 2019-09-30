<?php
	require_once("include/connection.php");
	if(isset($_GET['user_id']))
	{
	$get_productid = $_GET['user_id'];
	}
	else
	{
	$get_productid=NULL;
	}
	$query2 = mysql_query("UPDATE user SET deleted = 1, _status = 'BLOCKED' WHERE _id = {$get_productid}") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:userloadxml1.php")or die("MALI".mysql_error());
?>