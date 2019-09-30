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
@$conn = mysql_connect("localhost","root","");
mysql_select_db("onlinemarketplace",$conn);
@$sql = "SELECT * FROM admin";
@$llg = mysql_query($sql);
while(@$lllg = mysql_fetch_array($llg)){
		$passniadmin 			= $lllg['password'];
}
?>
<?Php
$dbhost_name = "localhost";
$database = "onlinemarketplace";// database name
$username = "root"; // user name
$password = ""; // password 

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productadd.js"></script>
		
		<script>
			function validatefrm(){
				var pass1 = document.getElementById('pass2').value;
				var pass2 = document.getElementById('pass3').value;
				var pass  = document.getElementById('pass1').value;
				var passadmin = document.getElementById('passniadmin').value;
				if(pass1 == pass2)
				{
					
				}
				else
				{	
					document.getElementById('invalidpassword1').innerHTML = "Password did not match.";
					document.getElementById('pass2').style.cssText = "background:indianred; color:white; border:2px solid indianred;";
					document.getElementById('invalidpassword2').innerHTML = "Password did not match.";
					document.getElementById('pass3').style.cssText = "background:indianred; color:white; border:2px solid indianred;";
					return false;
				}
				if(pass == passadmin)
				{
				
				}
				else
				{	
					document.getElementById('invalidpassword').innerHTML = "Password did not match.";
					document.getElementById('pass1').style.cssText = "background:indianred; color:white; border:2px solid indianred;";
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
				
			</div>			
			<div id="addcontent" style="height:430;">
				
				<span id="addtitle">ADMIN ACCOUNT SETTINGS</span></br></br>
				<h5 class="isa_info">
					<i class="fa fa-info"></i>
					Fields with * are required to be filled
				</h5>
				<?php
					if( $posted ) {
					if( $result ) {
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Successfully Edited!
						  </div><?php
					}else{
						
						}
					}
				?>	
				<div class="form-group">
				<form onsubmit="return validatefrm()" action="changeadminpassword.php" method="post">
				<label>Username</label>
                <input class="form-control" id="name" name="name" type="text" value="<?php echo "{$_SESSION['username']}";?>" readonly required="required" maxlength="12">
				<label>Old Password *</label>
                <input class="form-control" id="pass1" name="pass1" type="password" required="required" maxlength="12">
				<input class="form-control" id="passniadmin" name="passniadmin" type="text" value="<?php echo "{$passniadmin}";?>" required="required" maxlength="12" style="display:none;">
				<div id="invalidpassword"></div>
                <label>New Password *</label>
                <input class="form-control" id="pass2" name="pass2" type="password" required="required" maxlength="12">
                <div id="invalidpassword1"></div>
				<label>Retype New Password *</label>
                <input class="form-control" id="pass3" name="pass3" type="password" required="required" maxlength="12">
                <div id="invalidpassword2"></div></br></br>
				<input class="form-control" type="submit" value="SAVE">
				</form>
				</div>
			</div>
		</div>
		</div>
	</body>
</html>