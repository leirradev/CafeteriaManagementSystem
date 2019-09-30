<?php
	require_once("include/connection.php");	
	if(isset($_GET['banid']))
	{
	$banid = $_GET['banid'];
	}
	else
	{
	$banid=NULL;
	}
	$query2 = mysql_query("DELETE FROM banner WHERE id = {$banid}") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:editwebsite.php")or die("MALI".mysql_error());
?>