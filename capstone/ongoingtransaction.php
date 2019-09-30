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
    //$result = $_GET['status'] == "success"; // Dummy result
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
<?php
$date = date('m/d/Y');
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<link rel="stylesheet" type="text/css" href="css/productedit.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productedit.js"></script>
		<script type = "text/javascript" src="transactionsearch2.js"></script>
		
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
	<style type="text/css">
table#catalogTable tr:nth-child(even) {
  background-color: #eee;
}
table#catalogTable tr:nth-child(odd) {
  background-color: #fff;
}
table#catalogTable th {
  color: white;
  background-color: black;
}
table#catalogTable td {
  text-align:center;
}
table#catalogTable tr:hover{
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
				<span id="addtitle">ONGOING TRANSACTIONS</span></br></br>
				<?php
				if( $posted ) {
					if( $_GET['status'] == "success" ) {
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Order Successfully Claimed!
						  </div><?php
					}else if( $_GET['status'] == "deleted" ){
						?><div class="isa_success">
								<i class="fa fa-check"></i>
								Order Successfully Canceled!
						  </div><?php
					}else{
					
						}
					}
				?>
				<div id="search" style="left:200px;">
					Search:
					<select id="seacat">
						<option value="name">Transaction ID</option>
						<option value="category">Username</option>
					</select>
					<input type="text" onkeypress="doSearchNow(this.value,document.getElementById('seacat').value)" onkeydown="doSearchNow(this.value,document.getElementById('seacat').value)" />
				</div></br></br>
				<div id="tablecategory" style="left:100px;text-align:center;">
				
				</div>
<?php
$page_name="ongoingtransaction.php"; 
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



$nume = $dbo->query("select count(id) from transaction where status = 'PENDING' and date = '{$date}'")->fetchColumn();


echo "<table id='sample' class='table table-bordered table-hover table-striped'>";
echo  "<tr><th>TRANSACTION ID</th><th>USERNAME</th><th>PRODUCT NAME</th><th>QUANTITY</th>
<th>AMOUNT</th><th>TOTAL PRICE</th><th>STATUS</th><th>TIME ORDERED</th><th>DATE</th><th>MANAGE</th></tr>";


$query=" SELECT * FROM transaction where status = 'PENDING' and date = '{$date}' limit $eu, $limit ";


foreach ($dbo->query($query) as $row) {
$m=$i%2; 
$i=$i+1;   
$item = $row[product];
$dami = $row[quantity];
$presyo = $row[amount];
$newitem = explode(",",$item);
$newdami = explode(",",$dami);
$newpresyo = explode(",",$presyo);
//print_r($newitem);
//print_r($newdami);
//print_r($newpresyo);
echo "<tr class='r$m'><td>$row[id]</td><td>$row[user]</td>
<td>";foreach($newitem as $data){
echo $data."</br>";
}echo "</td><td>";foreach($newdami as $data1){
echo $data1."</br>";
}echo "</td><td>";foreach($newpresyo as $data2){
echo $data2."</br>";
}echo "</td><td>$row[total]</td>
<td>$row[status]</td><td>$row[timeOrder]</td><td>$row[date]</td>
<td><a href='claimproduct.php?transaction_id=$row[id]' style='text-decoration:none;'>
<button type='button' class='btn btn-success'>Claim</button>
</a></br></br><a href='cancelproduct.php?transaction_id=$row[id]&refund=$row[total]&username=$row[user]' style='text-decoration:none;'>
<button type='button' class='btn btn-success'>Cancel</button>
</a></td></tr>";
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