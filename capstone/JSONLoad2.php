<?php
  //error_reporting(0);
  $conn = mysql_connect("localhost","root","") or die("cannot connect");
  mysql_select_db("onlinemarketplace") or die("invalid db");

  // array for JSON response
  $person = array();

if( isset($_GET['_username'] ) ) {
    $un=$_GET['_username'];
    //$load=$_GET['_load'];
    $result = mysql_query("select * from user where _username='$un' ") or die(mysql_error());
	$count = 0;
	if(mysql_num_rows($result)){
		while($row = mysql_fetch_assoc($result)){
			$person[$count] = array('_username' => $row['_username'],'_load' => $row['_load'],'_contact_no_of_guardian' => $row['_contact_no_of_guardian']);
			$count++;
		}
	}
  // echoing JSON response
  echo json_encode($person);
}
?>