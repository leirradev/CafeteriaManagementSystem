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
	 header("Location:deleteproduct.php?product_id=$id");
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
<?php
	if(isset($_GET['product_id'])){
		$prodid = $_GET['product_id'];
		
		$sql="SELECT * FROM product WHERE id = {$prodid}";
		$res=mysql_query($sql) or die ("db query failed" .mysql_error());
		while($fet=mysql_fetch_array($res)){
			$imag = $fet['images'];
			$name = $fet['name'];
			$desc = $fet['description'];
			$cate = $fet['category'];
			$pric = $fet['price'];
		}
	}
	else
	{
		$prodid=NULL;
	}
	
	if(isset($_POST['frmEdit']))
	{
		$url	= $imag;
		$name	= $_POST['name'];
		$desc	= $_POST['desc'];
		$cate	= $_POST['cate'];
		$pric	= $_POST['pric'];
		if(empty($_FILES['fileimage']['tmp_name'])){
			$query2 = mysql_query("UPDATE product SET name='{$name}', description='{$desc}', category='{$cate}', price='{$pric}', deleted=0 WHERE id = {$prodid}") or die("MALI4".mysql_error());
			if (!$query2){
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:loadeditproductxml.php")or die("MALI".mysql_error());
		}
		else{
			$file = $_FILES['fileimage']['tmp_name'] or die("MALI1".mysql_error());
			move_uploaded_file($file,"images/products/{$url}") or die("MALI3".mysql_error());
			$query2 = mysql_query("UPDATE product SET images='{$url}', name='{$name}', description='{$desc}', category='{$cate}', price='{$pric}', deleted=0 WHERE id = {$prodid}") or die("MALI4".mysql_error());
			if (!$query2){ // add this check.
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:loadeditproductxml.php")or die("MALI".mysql_error());
		}
	}
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<link rel="stylesheet" type="text/css" href="css/productedit.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productedit.js"></script>
		<script type = "text/javascript" src="js/search1.js"></script>
		<script>
			$( document ).ready(function() {
				var id = <?php echo"{$prodid}"; ?>;
				//alert(id);
				if(id != null){
					$("#editcon").animate({top: 120,});
					document.getElementById('editimage').src = "images/products/"+ "<?php echo"{$imag}"; ?>";
					document.getElementById('name').value =  "<?php echo"{$name}"; ?>";
					document.getElementById('desc').value =  "<?php echo"{$desc}"; ?>";
					document.getElementById('cate').value =  "<?php echo"{$cate}"; ?>";
					document.getElementById('pric').value =  "<?php echo"{$pric}"; ?>";
				}
		});
</script>
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
	</head>
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
				<span id="addtitle">MEALS REPORTS</span></br></br>
				
				<div id="search">
					Search:
					<select id="seacat">
						<option value="name">Name</option>
						<option value="category">Category</option>
						<option value="status">Status</option>
					</select>
					<input type="text" onkeypress="doSearchNow(this.value,document.getElementById('seacat').value)" onkeydown="doSearchNow(this.value,document.getElementById('seacat').value)" />
				</div>
				<?php
				@$conn = mysql_connect("localhost","root","");
				mysql_select_db("onlinemarketplace",$conn);
				@$sql = "SELECT * FROM product where deleted = 0";
				@$lle = mysql_query($sql);
				$totalnumero = 0;
				while(@$llle = mysql_fetch_array($lle)){
					$numero 			= count($llle['id']);
					$totalnumero = $totalnumero + $numero;
				}					
				?>
				<div id="totalcount" style="position:relative;margin-left:80%;">
					<?php echo "Total Meal: ".$totalnumero;?>
				</div>
				<table id="tablecontainer" style="margin-left:25%;">
					<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							NAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							CATEGORY
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    PRICE
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    STATUS
						</td>
					</tr>
					<?php
						$sql="SELECT * FROM product where deleted = 0 order by name";
						$res=mysql_query($sql) or die ("db query failed" .mysql_error());
						while($fet=mysql_fetch_array($res)){
							echo "<tr>";
								echo "<td>";
									echo "{$fet['name']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['category']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['price']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['status']}";
								echo "</td>";
							echo "</tr>";
							//$total = $fet['total'] + $total;
						}
						?>
						<tr><td colspan="4" align="center"><?php echo "<a href=meal.php style='text-decoration:none;'><button class='form-control'>Print</button></a></td></tr>";?><?php
					?>
				</table>
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