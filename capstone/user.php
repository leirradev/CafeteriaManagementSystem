<title>Admin Portal</title>
<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
require "config.php";
require_once("include/connection.php");
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {

header ("Location: index.php");
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
							$sql="SELECT * FROM loadbalance";
							$res=mysql_query($sql) or die ("db query failed" .mysql_error());
							while($fet=mysql_fetch_array($res)){
								$maxload = $fet['maxload'];
								$minload = $fet['minload'];
							}
?>
<?php
	if(isset($_POST['addbtn']))
	{
		
		$user = $_POST['snum'];
		$pass = $_POST['spass'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$cnum = $_POST['cnum'];
		$pnum = $_POST['pcontacts'];
		$load = $_POST['load'];
		
		if ((preg_match("/^(639|\+639)[\d]{9}$/m", $cnum)) && (preg_match("/^(639|\+639)[\d]{9}$/m", $pnum))) {
                // valid mobile number
                //header("Location:samplelng.php");
				header("Location:sendsms.php?user=$user&pass=$pass&cnum=$cnum&pnum=$pnum&load=$load&fname=$fname&lname=$lname") or die("MALI".mysql_error());
        }
		else{
				header("Location:user.php?status=Invalid Phone Number Format the correct format is +639xxxxxxxxx");
		}
			
		
	}
?>
<?php
	if(isset($_POST['addbtn1']))
	{
		$mload = $_POST['minload'];
		$mload1 = $_POST['maxload'];
		if((empty($mload))&&(!empty($mload1))){
		$query2 = mysql_query("UPDATE loadbalance SET maxload = '{$mload1}'") or die("MALI4".mysql_error());
		if (!$query2){ // add this check.
			die('Invalid query: ' . mysql_error());
		}
		mysql_close($con);
		header("Location:user.php?loadstatus=updated");
		}else if((empty($mload1))&&(!empty($mload))){
		$query2 = mysql_query("UPDATE loadbalance SET minload = '{$mload}'") or die("MALI4".mysql_error());
		if (!$query2){ // add this check.
			die('Invalid query: ' . mysql_error());
		}
		mysql_close($con);
		header("Location:user.php?loadstatus=updated");
		}else if((empty($mload))&&(empty($mload1))){
		
		}
		else{
		$query2 = mysql_query("UPDATE loadbalance SET minload = '{$mload}', maxload = '{$mload1}'") or die("MALI4".mysql_error());
		if (!$query2){ // add this check.
			die('Invalid query: ' . mysql_error());
		}
		mysql_close($con);
		header("Location:user.php?loadstatus=updated");
		}
	}
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productadd.js"></script>
		<script type="text/javascript" src="checkuser.js"></script>
		<script>
			function validatefrm(){
				var pass1 = document.getElementById('spass').value;
				var pass2 = document.getElementById('spass1').value;
				if(pass1 == pass2)
				{
					
				}
				else
				{	
					document.getElementById('invalidpassword1').innerHTML = "Password did not match.";
					document.getElementById('invalidpassword2').innerHTML = "Password did not match.";
					document.getElementById('spass').style.cssText = "background:indianred; width: 100%; color:white; border:2px solid indianred;";
					document.getElementById('spass1').style.cssText = "background:indianred; width: 100%; color:white; border:2px solid indianred;";
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
	</head>
	
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
	<body onload="startTime()">
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
				<a href="user.php">
					<div id="btnadd"  style="text-decoration:none;">
						ADD MEMBERS
					</div>
				</a>
				<a href="edituser.php">
					<div id="btnedit"  style="text-decoration:none;">
						MANAGE
					</div>
				</a>
			</div>			
			<div id="addcontent">
				
				<span id="addtitle">ADD USER</span></br></br>
				<h5 class="isa_info" style="width:37.5%;">
					All fields with * are required!
				</h5>
				<?php
					if( $posted ) {
					if( $_GET['loadstatus'] == "updated" ) {
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Load Successfully Updated!
						  </div><?php
					}else{
						
						}
					}
					if( $posted ) {
					if( $_GET['status'] == "success" ) {
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Member Successfully Added!
						  </div><?php
					}else if( $_GET['status'] ){
						?><div class="isa_error">
								<i class="fa fa-times-circle"></i>
								<?php echo $_GET['status'];?>
						  </div><?php
						}
					}
				?>
				<div class="form-group">
				<form id="addprod" name="addprod" onsubmit="return validatefrm()" method="POST" enctype="multipart/form-data">
				<label>Username *</label>
                <input class="form-control" onchange="buildAjaxNow(this.value)" onblur="setBlur(this)" name="snum" id="snum" placeholder="8 characters only" type="text" onkeypress="return isNumberKey(event);" pattern=".{8,8}" maxlength="8" required="required">
				<div id="invalidusername" style="font-size:12px;"></div>
				<label>Password *</label>
                <input class="form-control" maxlength="12" pattern=".{8,12}" name="spass" id="spass" placeholder="8 - 12 characters only" type="password" required="required">
				<div id="invalidpassword1" style="font-size:12px;"></div>
				<label>Confirm Password *</label>
                <input class="form-control" maxlength="12" pattern=".{8,12}" name="spass1" id="spass1" placeholder="Retype Password" type="password" required="required">
				<div id="invalidpassword2" style="font-size:12px;"></div>
				<label>First Name</label>
				<input class="form-control" name="fname" id="fname" placeholder="First Name" type="text" required="required">
				<label>Last Name</label>
				<input class="form-control" name="lname" id="lname" placeholder="Last Name" type="text" required="required">
				<label>Contact Number *</label>
                <input class="form-control" name="cnum" type="text"  placeholder="Ex. +639xxxxxxxxx" required="required">
				<label>Guardians Contact Number *</label>
                <input class="form-control" name="pcontacts" type="text" placeholder="Ex. +639xxxxxxxxx" required="required">
				<label>Load Amount *</label>
				<input class="form-control" maxlength="4" min="<?php echo $minload;?>" max="<?php echo $maxload;?>" required="required" type="number" name="load" id="load" placeholder="Enter load here"></br></br>
				<input class="form-control" name="addbtn" id="addbtn" type="submit" value="ADD">
				</form>
				</div>
				<div style="margin-left:60%;margin-top:-57.2%;position:relative;">
				<form id="addprod1" name="addprod1" method="POST" enctype="multipart/form-data">
				<label>Minimum Load Amount</label>
                <input class="form-control" maxlength="4" style="width:70%;" type="text" name="minload" id="minload" placeholder="Enter Minimum Load Here" onkeypress="return isNumberKey(event);">
				<div id="samplesample"></div>
				<label>Maximum Load Amount</label>
                <input class="form-control" maxlength="4" style="width:70%;" type="text" name="maxload" id="maxload" placeholder="Enter Maximum Load Here" onkeypress="return isNumberKey(event);"></br></br>
				<input class="form-control" style="width:70%;" name="addbtn1" id="addbtn1" type="submit" value="SAVE">
				</form>
				</div>
			</div>
		</div>
		</div>
	</body>
	<script>
	function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
	}
	</script>
</html>