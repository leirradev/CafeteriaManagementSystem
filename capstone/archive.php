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
//$total = 0;
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
		<link rel="stylesheet" type="text/css" href="css/productedit.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productedit.js"></script>
		<script type = "text/javascript" src="js/transactionsearch.js"></script>
		
	</head>
	<style type="text/css">
table#sample tr:nth-child(even) {
  background-color: #eee;
}
table#sample tr:nth-child(odd) {
  background-color: #fff;
}
table#sample th {
  color: white;
  background-color: black;
}
table#sample td {
  text-align:center;
}
table#sample tr:hover{
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
		<div id="productcontainer" style="position:relative;">
			<div id="productcontainerlinks">
			
			</div>						
			<div id="editcontent">
				<span id="addtitle">RECYCLE BIN</span></br></br>
				<?php
					if( $posted ) {
					if( $result ) {
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Successfully Restored!
						  </div><?php
					}else{
						
						}
					}
				?>
				<div class="col-lg-12" style="margin-top:1%;">
					<div class="panel panel-default" style="background-color:#7FA3BF;">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> DELETED MEMBERS </h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="sample" style="margin-left:70;">
                                        <thead>
                                            <tr>
												<th>USERNAME</th>
                                                <th>CONTACT NUMBER</th>
                                                <th>PARENTS CONTACT NUMBER</th>
                                                <th>LOAD</th>
												<th>STATUS</th>
												<th>MANAGE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $query="SELECT * FROM user where deleted = 1 order by _id desc";


										foreach ($dbo->query($query) as $row) {
                                            echo "<tr>
                                                <td>$row[_username]</td>
                                                <td>$row[_contact_no]</td>
                                                <td>$row[_contact_no_of_guardian]</td>
												<td>$row[_load]</td>
												<td>$row[_status]</td>
												<td><a href='restoreaccount.php?user_id=$row[_id]'>
												<img src='restore.png' style='width:70px;heigth:70px;'>
												</a></td>
                                            </tr>";
										}?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    
                                </div>
                            </div>
                        </div>
				</div>
				<div class="col-lg-12">
					<div class="panel panel-default" style="background-color:#7FA3BF;">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> DELETED MEALS </h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="sample" style="margin-left:0;">
                                        <thead>
                                            <tr>
												<th>IMAGE</th>
                                                <th>NAME</th>
												<th>DESCRIPTION</th>
                                                <th>CATEGORY</th>
                                                <th>PRICE</th>
                                                <th>STATUS</th>
												<th>MANAGE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $query=" SELECT * FROM product where deleted = 1 order by name";


										foreach ($dbo->query($query) as $row) {
                                            echo "<tr>
												<td><img src='images/products/$row[images]' style='width:80px;height:80px;'></td>
                                                <td>$row[name]</td>
                                                <td>$row[description]</td>
                                                <td>$row[category]</td>
                                                <td>$row[price]</td>
												<td>$row[status]</td>
												<td><a href='restoreproduct.php?product_id=$row[id]'>
												<img src='restore.png' style='width:70px;heigth:70px;'>
												</a></td>
                                            </tr>";
										}?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    
                                </div>
                            </div>
                        </div>
				</div>
				
			</div>
		</div>
		</div>
	</body>
</html>