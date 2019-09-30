<?php
	require_once("include/connection.php");
		$name	= $_POST['name'];
		$newpass	= $_POST['pass2'];
		echo $name;
		$query2 = mysql_query("UPDATE admin SET password = '{$newpass}' WHERE username = '{$name}'") or die("MALI4".mysql_error());
			if (!$query2){
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:manageaccounts.php?status=success")or die("MALI".mysql_error());	
?>