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
$totalload = 0;
?>
<?php
							$sql="SELECT * FROM loadbalance";
							$res=mysql_query($sql) or die ("db query failed" .mysql_error());
							while($fet=mysql_fetch_array($res)){
								$maxload = $fet['maxload'];
								$minload = $fet['minload'];
							}
?>
<?php

$id = "";
if ($_POST) {
   if (empty($_POST["adminpass"])) {

   } else {
     $id = $_POST["numnistudent"];
	 header("Location:deleteuser.php?user_id=$id");
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
    $result = $_GET['status'] == "success"; // Dummy result
  }
?>
<?php
	if(isset($_GET['user_id']))
	{
		$get_studid = $_GET['user_id'];
		$sql="SELECT * FROM user WHERE _id = {$get_studid}";
		$res=mysql_query($sql) or die ("db query failed" .mysql_error());
		while($fet=mysql_fetch_array($res)){
			$user = $fet['_username'];
			$pass = $fet['_password'];
			$cno = $fet['_contact_no'];
			$cnoofg = $fet['_contact_no_of_guardian'];
			$newload = $fet['_load'];
		}
		
	}
	else
	{
		$get_studid=NULL;
	}
	
	
	if(isset($_POST['frmEdit']))
	{
		$name	= $_POST['name'];
		$desc	= $_POST['desc'];
		$cate	= $_POST['cpnum'];
		$pric	= $_POST['pric'];
		$load1  = $_POST['load'];
		$load2  = $_POST['load1'];
		$totalload = $load1 + $load2;
		//if ((preg_match("/^(639|\+639)[\d]{9}$/m", $cate)) && (preg_match("/^(639|\+639)[\d]{9}$/m", $pric))) {
			if(($desc == $pass)&&($load2 == "")){
			$query2 = mysql_query("UPDATE user SET _username='{$name}', _password='{$desc}', _contact_no='{$cate}', _contact_no_of_guardian='{$pric}'
			, _load='{$totalload}', deleted=0 WHERE _id = {$get_studid}") or die("MALI4".mysql_error());
			if (!$query2){
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:userloadxml2.php")or die("MALI".mysql_error());
			}else if(($desc == $pass)&&($load2 != "")){
			header("Location:sendsmsload.php?username=$name&load=$totalload&snum=$cate&pnum=$pric") or die("MALI".mysql_error());
			}else if(($desc != $pass)&&($load2 != "")){
			header("Location:sendsms2.php?username=$name&newpass=$desc&load=$totalload&snum=$cate&pnum=$pric") or die("MALI".mysql_error());
			}else{
			header("Location:sendsmsupdate.php?username=$name&newpass=$desc&snum=$cate&pnum=$pric&load=$totalload")or die("MALI".mysql_error());
			}
			
	}
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<link rel="stylesheet" type="text/css" href="css/productedit.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productedit.js"></script>
		<script type = "text/javascript" src="js/search2.js"></script>
		<script>
			$( document ).ready(function() {
				var id = <?php echo"{$get_studid}"; ?>;
				//alert(id);
				if(id != null){
					$("#editcon").animate({top: 100,});
					document.getElementById('name').value =  "<?php echo"{$user}"; ?>";
					document.getElementById('desc').value =  "<?php echo"{$pass}"; ?>";
					document.getElementById('cpnum').value =  "<?php echo"{$cno}"; ?>";
					document.getElementById('pric').value =  "<?php echo"{$cnoofg}"; ?>";
					document.getElementById('load').value =  "<?php echo"{$newload}"; ?>";
				}
		});
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
table#tablecontainer tr:nth-child(even) {
  background-color: #eee;
}
table#tablecontainer tr:nth-child(odd) {
  background-color: #fff;
}
table#tablecontainer th {
  color: white;
  background-color: black;
}
table#tablecontainer tr:hover{
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
		
			</div>						
			<div id="editcontent">
				<span id="addtitle">MEMBER REPORTS</span></br></br>
				
				<div id="search" style="position:relative;">
					Search:
					<select id="seacat">
						<option value="name">Username</option>
						<option value="status">Status</option>
					</select>
					<input type="text" onkeypress="doSearchNow(this.value,document.getElementById('seacat').value)" onkeydown="doSearchNow(this.value,document.getElementById('seacat').value)" />
				</div>
				<?php
				@$conn = mysql_connect("localhost","root","");
				mysql_select_db("onlinemarketplace",$conn);
				@$sql = "SELECT * FROM user where deleted = 0";
				@$lle = mysql_query($sql);
				$totalnumero = 0;
				while(@$llle = mysql_fetch_array($lle)){
					$numero 			= count($llle['_id']);
					$totalnumero = $totalnumero + $numero;
				}					
				?>
				<div id="totalcount" style="position:relative;margin-left:70%;">
					<?php echo "Total Registered Member: ".$totalnumero;?>
				</div>
				<table id="tablecontainer" style="margin-left:20%;">
					<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							USERNAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							CONTACT NUMBER
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    PARENTS CONTACT NUMBER
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    LOAD
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    STATUS
						</td>
					</tr>
					<?php
						$sql="SELECT * FROM user where deleted = 0 order by _username";
						$res=mysql_query($sql) or die ("db query failed" .mysql_error());
						while($fet=mysql_fetch_array($res)){
							echo "<tr>";
								echo "<td>";
									echo "{$fet['_username']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['_contact_no']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['_contact_no_of_guardian']}";
								echo "</td>";
								echo "<td>";
									echo "Php ".$fet['_load'].".00";
								echo "</td>";
								echo "<td>";
									echo "{$fet['_status']}";
								echo "</td>";
							echo "</tr>";
							//$total = $fet['total'] + $total;
						}
						?>
						<tr><td colspan="5" align="center"><?php echo "<a href=membersreport.php style='text-decoration:none;'><button class='form-control'>Print</button></a></td></tr>";?><?php
					?>
				</table>
			</div>
		</div>
		</div>
	</body>
	<script>
		$("#closefrm").click(function() {
			$("#editcon").animate({left: 2000});
		});
	</script>
	<script>
	function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
	}
	</script>
</html>