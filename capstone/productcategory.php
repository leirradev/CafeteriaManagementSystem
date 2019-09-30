<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
<html>
<title>Admin Portal</title>
<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	require_once("include/connection.php");	
	if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {

header ("Location: adminlogin.php");

}	
?>
<?php

$id = "";
if ($_POST) {
   if (empty($_POST["adminpass"])) {

   } else {
     $id = $_POST["numnistudent"];
	 header("Location:deletecategory.php?id=$id");
   }
   }
?>
<?php
@$conn = mysql_connect("localhost","root","");
mysql_select_db("onlinemarketplace",$conn);
@$sql = "SELECT * FROM admin";
@$llg = mysql_query($sql);
while(@$lllg = mysql_fetch_array($llg)){
		$passniadmin 			= $lllg['password'];
}
?>
<?php
  $posted = false;
  if( $_GET ) {
    $posted = true;

    // Database stuff here...
    // $result = mysql_query( ... )
    //$result = $_GET['status'] == "success"; // Dummy result
  }
?>

	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<link rel="stylesheet" type="text/css" href="css/productcategory.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productcategory.js"></script>
		<script type="text/javascript" src="js/addcategory.js"></script>
		<script>
			function ini(){
				document.onkeydown = keylistener;
			}
			
			function keylistener(e){
				e = window.event;
				if(e.keyCode == 13)
				{
					return false;
				}
			}
		</script>
		<script type="text/javascript">
			var timeout         = 50;
			var closetimer		= 0;
			var ddmenuitem      = 0;

			function jsddm_open()
			{	jsddm_canceltimer();
				jsddm_close();
				ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

			function jsddm_close()
			{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

			function jsddm_timer()
			{	closetimer = window.setTimeout(jsddm_close, timeout);}

			function jsddm_canceltimer()
			{	if(closetimer)
				{	window.clearTimeout(closetimer);
					closetimer = null;}}

			$(document).ready(function()
			{	$('#jsddm > li').bind('mouseover', jsddm_open);
				$('#jsddm > li').bind('mouseout',  jsddm_timer);});

			document.onclick = jsddm_close;
		</script>
		<script>
			function validatefrm(){
				var pass1 = document.getElementById('adminpass').value;
				var pass2 = document.getElementById('adminpass1').value;
				if(pass1 == pass2)
				{
					
				}
				else
				{	
					document.getElementById('invalidpassword1').innerHTML = "Password did not match.";
					document.getElementById('invalidpassword2').innerHTML = "Password did not match.";
					document.getElementById('spass').style.cssText = "background:indianred; width: 90%; color:white; border:2px solid indianred;";
					document.getElementById('spass1').style.cssText = "background:indianred; width: 90%; color:white; border:2px solid indianred;";
					return false;
				}
			}
		</script>
	</head>
	<style type="text/css">
table#tablecategory tr:nth-child(even) {
  background-color: #eee;
}
table#tablecategory tr:nth-child(odd) {
  background-color: #fff;
}
table#tablecategory th {
  color: white;
  background-color: black;
}
table#tablecategory tr {
  text-align:center;
}
table#tablecategory tr:hover{
  background-color: #ffff99;
}
</style>
<style> 
.isa_info, .isa_success, .isa_warning, .isa_error {
margin: 10px 0px;
padding:12px;
}
.isa_info {
    color: #00529B;
    background-color: #BDE5F8;
}
.isa_success {
    color: #4F8A10;
    background-color: #DFF2BF;
	font-size: 20px;
}
.isa_warning {
    color: #9F6000;
    background-color: #FEEFB3;
}
.isa_error {
    color: #D8000C;
    background-color: #FFBABA;
	font-size: 20px;
}
.isa_info i, .isa_success i, .isa_warning i, .isa_error i {
    margin:10px 22px;
    font-size:2em;
    vertical-align:middle;
}
</style>
	<body onload="startTime(),ini()">
		<div id="header">
			<img src="titoli.png" style="width:170px;left:100px;top:20px;position:relative;"/>
				
			<div id="time">
					<?php 
						  date_default_timezone_set('Asia/Manila');
						  $time = date('h:i A',time());
						  echo $time;
					?>
				</div>
				<div id="day">
				</div>
				<div id="date">
				</div>
		</div>
		<div id="setting">
			<ul id="jsddm">
					<li><a href="admin.php">HOME</a></li>
					<li><a href="productadd.php">MEALS</a></li>
					<li><a href="user.php">MEMBERS</a></li>
					<li><a>REPORTS</a>
						<ul>
							<a href="mealreports.php">MEALS</a>
							<a href="reports.php">MEMBERS</a>
						</ul>
					</li>
					<li><a href="transaction.php">TRANSACTIONS</a>
						<ul>
							<a href="daily.php">DAILY</a>
							<a href="weekly.php">WEEKLY</a>
							<a href="monthly.php">MONTHLY</a>
							<a href="yearly.php">ANNUAL</a>
						</ul>
					</li>
					<li style="position:relative;color:white;margin-left:500px;text-align:center;">
						<a href="manageaccounts.php">Admin</a>
					</li>
					<li style="color:white;text-align:center;"><a href="logout.php">
					<img src="images/logout.png" title="logout"/>
					</a></li>
				</ul>
		</div>
		<div id="homecontainer" style="position:relative;top:-25px;">
		<div id="productcontainer" style="top:10px;position:relative;">
			<div id="productcontainerlinks">
				<a href="productadd.php">
					<div id="btnadd"  style="text-decoration:none;">
						ADD MEALS
					</div>
				</a>
				<a href="productedit.php">
					<div id="btnedit"  style="text-decoration:none;">
						MANAGE MEALS
					</div>
				</a>
				<a href="productcategory.php">
					<div id="btnfeature"  style="text-decoration:none;">
						ADD CATEGORY
					</div>
				</a>
			</div>						
			<div id="featuredcontent">
				<span id="addtitle">ADD CATEGORY</span></br></br>
				<?php
				if( $posted ) {
					if( $_GET['status'] == "success" ) {
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Category Successfully Added!
						  </div><?php
					}else if( $_GET['status'] == "deleted" ){
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Category Successfully Deleted!
						  </div><?php
					}else{
					
						}
					}
				?>
				<form id="addcate" name="addcate" method="POST" action="addcategory.php">
					<table id="addtable"  style="position:relative;top:10;">
						<tr>
							<td><input type="submit" class="addprobtn" name="addCategory" value="ADD" id="addcatebtn"></td>
							<td>Category:</td>
							<td><input onchange="buildAjaxNow(this.value)" onblur="setBlur(this)" placeholder="Add Category Name" required="required" type="text" id="categoryname" name='categoryname'/></td>
							<td id="categoryerror"></td>
						</tr>
					</table>
				</form>
				<table id="tablecategory" style="position:relative;top:10;width:400;left:250;">
					<tr>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							CATEGORY
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							MANAGE
						</td>
					</tr>
					
<?php
require('include/connection.php');
$total = 0;
$sql = "SELECT * from category";
$res=mysql_query($sql) or die ("db query failed" .mysql_error());
while($fet=mysql_fetch_array($res)){
	$sample = $fet['categoryname'];
	$sample2 = $fet['id'];
	$newlist[] = $sample;
	$newlist1[] = $sample2;
}
//print_r($newlist);
foreach($newlist as $data){
$total = 0;
//$index = 0;
$sql2 = "SELECT * from product where category = '$data'";
$res1=mysql_query($sql2) or die ("db query failed" .mysql_error());
while($fet1=mysql_fetch_array($res1)){
	$sample = $fet1['category'];
	$total = $total + count($sample);
	$prodid[] = $fet1['id'];
	//echo $sample;
}
//$index++;
//"</br>";
//echo $total;
//echo $newlist[3];
if($total == 0){
	echo "<tr>";
		echo "<td>";
			echo $data;
		echo "</td>";
		echo "<td>";
		//dito lalagay ung href
			echo "<a href='productcategory.php?categoryname={$data}'><img src='images/Editing-Delete-icon.png' style='width:30px' title='DELETE'/></a></br>";
		echo "</td>";
	echo "</tr>";
	//$index++;
}
else{
	echo "<tr>";
		echo "<td>";
		echo $data;
		echo "</td>";
		echo "<td>";
		echo "<img src='images/Editing-Delete-icon.png' style='width:30px;' title='DELETE'/></br>";
		echo "</td>";
	echo "</tr>";
}    
}
?>
				</table>
				<?php
				@$conn = mysql_connect("localhost","root","");
				mysql_select_db("onlinemarketplace",$conn);
				@$sql = "SELECT * FROM category";
				@$lle = mysql_query($sql);
				while(@$llle = mysql_fetch_array($lle)){
					$numero 			= $llle['categoryname'];


					if( $posted ) {
					if( $_GET['categoryname'] == $numero ) {
						?><div class="isa_info" id="message" style="position:absolute;top:100px;width:50%;height:20%;left:220px;background-color:white;color:black;-webkit-box-shadow:2px 2px 100px 1px rgba(0,0,0,0.8) inset;">
								<div><img src="close_pop.png" style="margin-left:90%;" onclick="document.getElementById('message').style.display='none';"></div>
								<i class="fa fa-info-circle"></i>
								Enter admin password to delete the selected category :  
								<form method="post" onsubmit="return validatefrm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin-left:5%;">
								<label id="invalidpassword1"><label></br>
								<input type="password" name="adminpass" id="adminpass" required="required" style="margin-left:70px;"/>
								<input type="text" name="numnistudent" id="numnistudent" value="<?php echo $_GET['categoryname']; ?>" readonly style="display:none;" >
								<input type="text" name="adminpass1" id="adminpass1" value="<?php echo $passniadmin; ?>" readonly style="display:none;" >
								<input type="submit" id="frmAdmin" name="frmAdmin" value="ENTER">
								</form> 
						  </div><?php
						}
					}
					}
					
				?>
			</div>
		</div>
		</div>
	</body>
</html>