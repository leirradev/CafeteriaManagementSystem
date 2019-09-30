<?php
  //error_reporting(0);
  $conn = mysql_connect("localhost","root","") or die("cannot connect");
  mysql_select_db("onlinemarketplace") or die("invalid db");

  // array for JSON response
  $response = array();

if( isset($_GET['_username'] ) ) {
    $un=$_GET['_username'];
    $load=$_GET['_load'];
    $result = mysql_query("update user set _load='$load' where _username='$un' ") or die(mysql_error());

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