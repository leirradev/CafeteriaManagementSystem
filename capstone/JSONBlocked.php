<?php
  //error_reporting(0);
  $conn = mysql_connect("localhost","root","") or die("cannot connect");
  mysql_select_db("onlinemarketplace") or die("invalid db");

  // array for JSON response
  $response = array();

if( isset($_GET['_username'] ) ) {
    $un=$_GET['_username'];
    //$pw=$_GET['_password'];
	$status='BLOCKED';
	$status1='ACTIVE';
    $result = mysql_query("update user set _status='$status' where _username='$un' and _status='$status1' ") or die(mysql_error());

    $row_count = mysql_affected_rows();

    if($row_count>0){
         $response["success"] = 1;
         $response["message"] = "Updated Sucessfully.";
     }
    else{
        $response["success"] = 0;
        $response["message"] = "Failed To Update.";  
     }  
  // echoing JSON response
  echo json_encode($response);
}
?>