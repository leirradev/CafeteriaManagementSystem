<?php
require_once("include/connection.php");
$user = $_GET['user'];
$pass = $_GET['pass'];
$cnum = $_GET['cnum'];
$pnum = $_GET['pnum'];
$load = $_GET['load'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
print_r($user);
print_r($pass);
print_r($fname);
print_r($lname);
print_r($cnum);
print_r($pnum);
print_r($load);
require('textlocal.class.php');

$textlocal = new Textlocal('j_reyesarme18@yahoo.com', '12345678xX');

$numbers = array($cnum);
$sender = 'Dominic';
$message = "Welcome to Prepaid Cafeteria! Your username is ".$user." and your password is ".$pass;
try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    print_r($result);
	$query2 = mysql_query("INSERT INTO user (_username,_password,fname,lname,_contact_no,_contact_no_of_guardian,_load,_status,deleted) VALUES ('{$user}','{$pass}','{$fname}','{$lname}','{$cnum}','{$pnum}','{$load}','ACTIVE',0)") or die("MALI4".mysql_error());
	if (!$query2){ // add this check.
		die('Invalid query: ' . mysql_error());
	}
	mysql_close($con);
	header("Location:userloadxml3.php");
} catch (Exception $e) {
	header("Location:user.php?status=".$e->getMessage());
    die('Error: ' . $e->getMessage());
	header("Location:user.php?status=".$e->getMessage());
}
?>