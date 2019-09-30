<?php
	session_start();
	define('HOST','localhost');
	define('USER','root');
	define('DB','onlinemarketplace');
	$con = mysql_connect(HOST,USER,'') or die('Database Connection Failed' . mysql_error());
	$db = mysql_select_db(DB,$con) or die('Database Selection Failed' . mysql_error());
	$username = mysql_escape_string($_POST['username']);
	$password = mysql_escape_string($_POST['password']);
	$sql = "Select * from admin where (username='{$username}' and password='{$password}')";
	$query = mysql_query($sql,$con) or die('Database Query Failed' . mysql_error());
	$row = mysql_num_rows($query);
	$fetch = mysql_fetch_array($query);

	if($row == 1)
	{
		$_SESSION['user'] = $username;
		header("Location:admin.php");
	}
	else
	{
		header("Location:index.php");
	}
?>