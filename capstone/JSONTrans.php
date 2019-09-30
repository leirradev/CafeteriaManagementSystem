<?php
$person = array();
$count = 0;
	$conn = mysql_connect("localhost","root","") or die("cannot connect");
	mysql_select_db("onlinemarketplace") or die("invalid db");
	if( isset($_GET['user'] ) ) {
	$user=$_GET['user'];
	$sql = "SELECT * from transaction where user='$user' ";
	$result = mysql_query($sql) or die('Unable to run query:'.mysql_error());
	$count = 0;
	if(mysql_num_rows($result)){
		while($row = mysql_fetch_assoc($result)){
			$person[$count] = array('id' => $row['id'],'user' => $row['user'],'product' => $row['product'],'quantity' => $row['quantity'],'total' => $row['total'],'status' => $row['status'],'timeOrder' => $row['timeOrder'],'timeClaim' => $row['timeClaim'],'date' => $row['date']);
			$count++;
		}
	}
	echo json_encode($person);
	}
?>