<?php
include('ChikkaSMS.php');

session_start();
$user = $_GET['user'];
$pass = $_GET['pass'];
$pnum = $_GET['pnum'];
$char = "AaBbCcDdEeFfGgHhIiJjKkLMmNnPpQqRrSsTtUuVvWwXxYyZz23456789";
$uniqueID = "";
for($i = 0; $i < 6; $i++)
{
   $pos = mt_rand(0, 56);
   $uniqueID .= substr($char, $pos, 1);
}

$_SESSION['id'] = $uniqueID;


$clientId = 'e4290fe9bff9eed73221804bdf03b9cc067db6bac9943e973fcfd4777dc3b898';
$secretKey = '8138246b7f78855cdac83b38a6c2e742b8ab87a285fad6c44cb2cc7668a34529';
$shortCode = '29290145145';
$chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
$response = $chikkaAPI->sendText($_SESSION['id'], '639272000356', 'Your username is '.$user.' and password is '.$pass);


if($response->status != 200){
	header("HTTP/1.1 " . $response->status . " " . $response->message);
}

echo $response->description;
header("Location:userloadxml.php");
?>