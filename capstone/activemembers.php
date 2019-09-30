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
				<span id="addtitle">ACTIVE MEMBERS</span></br></br>
				<?php
$page_name="activemembers.php"; 
$start=$_GET['start'];
if(strlen($start) > 0 and !is_numeric($start)){
echo "Data Error";
exit;
}


$eu = ($start - 0); 
$limit = 10;                               
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 



$nume = $dbo->query("select count(_id) from user where deleted = 0 and _status='ACTIVE'")->fetchColumn();


echo "<table id='sample' style='margin-left:130;margin-top:2%;'>";
echo  "<tr style='text-align:center;'><th style='text-align:center;'>USERNAME</th><th style='text-align:center;'>CONTACT NUMBER</th><th style='text-align:center;'>PARENTS CONTACT NUMBER</th><th style='text-align:center;'>LOAD</th>
<th style='text-align:center;'>STATUS</th></tr>";


$query=" SELECT * FROM user where deleted=0 and _status='ACTIVE' order by _username limit $eu, $limit ";


foreach ($dbo->query($query) as $row) {
$m=$i%2; 
$i=$i+1;   

echo "<tr class='r$m'><td>$row[_username]</td><td>$row[_contact_no]</td><td>$row[_contact_no_of_guardian]</td>
<td>$row[_load]</td><td>$row[_status]</td></tr>";
}
echo "</table>";

 
if($nume > $limit ){ 


echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";

if($back >=0) { 
print "<a href='$page_name?start=$back'><font face='Verdana' size='2'>PREV</font></a>"; 
} 

echo "</td><td align=center width='30%'>";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
if($i <> $eu){
echo " <a href='$page_name?start=$i'><font face='Verdana' size='2'>$l</font></a> ";
}
else { echo "<font face='Verdana' size='4' color=red>$l</font>";}        
$l=$l+1;
}


echo "</td><td  align='right' width='30%'>";

if($this1 < $nume) { 
print "<a href='$page_name?start=$next'><font face='Verdana' size='2'>NEXT</font></a>";} 
echo "</td></tr></table>";
}
?>
				
			</div>
		</div>
		</div>
	</body>
</html>