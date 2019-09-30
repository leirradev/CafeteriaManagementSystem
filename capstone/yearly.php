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
$total = 0;
?>

	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<link rel="stylesheet" type="text/css" href="css/productedit.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productedit.js"></script>
		<script type = "text/javascript" src="js/yearlytransactionsearch.js"></script>
		
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
				<span id="addtitle">YEARLY TRANSACTION RECORDS</span></br></br>
				<div id="search">
					Search:
					<select id="seacat">
						<option value="name">Transaction Id</option>
						<option value="category">Username</option>
						<option value="product">Product Name</option>
						<option value="date">Date</option>
					</select>
					<input type="text" onkeypress="doSearchNow(this.value,document.getElementById('seacat').value)" onkeydown="doSearchNow(this.value,document.getElementById('seacat').value)" />
				</div>
				
				<table id="tablecontainer">
					<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							TRANSACTION ID
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							USERNAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    PRODUCT NAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    QUANTITY
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    SUBTOTAL
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    TOTAL
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    STATUS
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    TIME ORDERED
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    TIME CLAIMED
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    DATE PURCHASED
						</td>
					</tr>
					<?php
						 
						  date_default_timezone_set('Asia/Manila');
						  $date = date('Y');
						  //echo $date;
						$sql="SELECT * from transaction WHERE status = 'CLAIM' and date LIKE '%{$date}' order by id desc";
						$res=mysql_query($sql) or die ("db query failed" .mysql_error());
						while($fet=mysql_fetch_array($res)){
							$prod = $fet['product'];
							$qty = $fet['quantity'];
							$amt = $fet['amount'];
							$newprod = explode(",",$prod);
							$newqty = explode(",",$qty);
							$newamt = explode(",",$amt);
							echo "<tr>";
								echo "<td>";
									echo "{$fet['id']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['user']}";
								echo "</td>";
								echo "<td>";
									foreach($newprod as $data){
										echo $data."</br>";
									}
								echo "</td>";
								echo "<td>";
									foreach($newqty as $data1){
										echo $data1."</br>";
									}
								echo "</td>";
								echo "<td>";
									foreach($newamt as $data2){
										echo $data2."</br>";
									}
								echo "</td>";
								echo "<td>";
									echo "{$fet['total']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['status']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['timeOrder']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['timeClaim']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['date']}";
								echo "</td>";
							echo "</tr>";
							$total = $fet['total'] + $total;
						}
						?><tr><td colspan="10" align="center"><?php echo "Total: Php ".$total.""; ?></td></tr>
						<tr><td colspan="10" align="center"><?php echo "<a href=yearlytransactionreport.php?total=".$total."><button class='form-control'>Print</button></a></td></tr>";?><?php
					?>
				</table>
				
			</div>
		</div>
		</div>
	</body>
</html>