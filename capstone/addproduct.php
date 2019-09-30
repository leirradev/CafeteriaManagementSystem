<?php
	session_start();
	require_once("include/connection.php");	
	$url	=	rand();
	$name	=	$_POST['name'];
	$desc	=	$_POST['desc'];
	$cate	=	$_POST['cate'];
	$pric	=	$_POST['pric'];
	$uplo	=	$_SESSION['user'];
	if(empty($_FILES['dp']['tmp_name'])){
		mysql_close($con);
		die("ERROR");
	}
	else{
		$file = $_FILES['dp']['tmp_name'] or die("MALI1".mysql_error());
		move_uploaded_file($file,"images/products/{$url}.jpg") or die("MALI3".mysql_error());
		$query2 = mysql_query("INSERT INTO product (images, name, description, category, price, uploadedby,deleted) VALUES ('{$url}.jpg','{$name}','{$desc}','{$cate}','{$pric}',{$uplo},0)") or die("MALI4".mysql_error());
		if (!$query2){ // add this check.
			die('Invalid query: ' . mysql_error());
		}
		mysql_close($con);
		header("Location:loadxml.php")or die("MALI".mysql_error());
	}
?>