<?php
	$category = $_POST['categoryname'];
	$conn = mysql_connect('localhost', 'root', '');
	mysql_select_db('onlinemarketplace');
	$sql = "INSERT INTO category (id,categoryname) VALUES('','{$category}')";
	mysql_query($sql);
	mysql_close($conn);
	header("Location: productcategory.php?status=success");
?>