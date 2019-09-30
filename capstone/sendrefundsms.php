<?php
require_once("include/connection.php");
$cnum = $_GET['snum'];
$pnum = $_GET['pnum'];
$load = $_GET['load'];
$user = $_GET['user'];
$refund = $_GET['refund'];
print_r($cnum);
print_r($pnum);
print_r($load);
print_r($user);
print_r($refund);
require('textlocal.class.php');

$textlocal = new Textlocal('j_reyesarme18@yahoo.com', '12345678xX');

$numbers = array($cnum);
$sender = 'Dominic';
$message = "Welcome to Prepaid Cafeteria! Your ordered has been cancelled, You received a refund of: ".$refund.". Your load balance is now: ".$load;
try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    print_r($result);
	$query2 = mysql_query("UPDATE user SET _load = '$load' WHERE _username = '{$user}'") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:userloadxml4.php");
} catch (Exception $e) {
	header("Location:ongoingtransaction.php?status=".$e->getMessage());
    die('Error: ' . $e->getMessage());
	header("Location:ongoingtransaction.php?status=".$e->getMessage());
}
?>