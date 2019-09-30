<?php
	date_default_timezone_set('Asia/Manila');
	$time = date('h:i A', time());
	echo $time;
	require_once("include/connection.php");
	if(isset($_GET['transaction_id']))
	{
	$get_productid = $_GET['transaction_id'];
	$get_refund = $_GET['refund'];
	$get_user = $_GET['username'];
	}
	else
	{
	$get_productid=NULL;
	$get_refund=NULL;
	$get_user=NULL;
	}
	$total = 0;
	$sql="SELECT * FROM user where _username = '{$get_user}'";
						$res=mysql_query($sql) or die ("db query failed" .mysql_error());
						while($fet=mysql_fetch_array($res)){
							$number1 = $fet['_contact_no'];
							$number2 = $fet['_contact_no_of_guardian'];
							$total = $fet['_load'] + $get_refund;
						}
	$query2 = mysql_query("UPDATE transaction SET status = 'CANCEL', timeClaim = 'NONE' WHERE id = {$get_productid}") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	//mysql_close($con);
	header("Location:sendrefundsms.php?load=$total&snum=$number1&pnum=$number2&user=$get_user&refund=$get_refund")or die("MALI".mysql_error());
?>