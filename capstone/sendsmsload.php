<?php
require_once("include/connection.php");
$user = $_GET['username'];
$load = $_GET['load'];
$snum = $_GET['snum'];
$pnum = $_GET['pnum'];
print_r($user);
print_r($load);
print_r($snum);
print_r($pnum);
require('textlocal.class.php');

$textlocal = new Textlocal('j_reyesarme18@yahoo.com', '12345678xX');

$numbers = array($snum);
$sender = 'Dominic';
$message = "Welcome to Prepaid Cafeteria! Your load balance is now ".$load;
try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    print_r($result);
	$query2 = mysql_query("UPDATE user SET _load='{$load}', _contact_no='{$snum}'
	, _contact_no_of_guardian='{$pnum}', deleted=0 WHERE _username = {$user}") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:userloadxml2.php")or die("MALI".mysql_error());
} catch (Exception $e) {
	header("Location:edituser.php?status=".$e->getMessage());
    die('Error: ' . $e->getMessage());
	header("Location:edituser.php?status=".$e->getMessage());
}
?>