<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
<html>
<?php
	session_start();
	require_once("include/connection.php");	
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {

header ("Location: adminlogin.php");

}	
?>
	<title>Admin Portal</title>
	<head>
        
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<script type="text/javascript" src="js/admin.js"></script>
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/js1.js"></script>
		<link href="jquery/ui-examples.css" rel="stylesheet">
		<link href="jquery/jquery.ui/css/cupertino/jquery-ui-1.10.3.custom.css" rel="stylesheet">
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
	<body onload="startTime(),ini()">
		<div id="container">
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
			
			<div id="homecontainer">
				<div id="lalagyan">
					<img src="simplelogo.png" style="width:700px;"/>
					<div class="panel1" style="position:relative;top:-450;width:300;left:680;">
                        <div class="panel panel-yellow">
							<div class="panel-heading">
                                <div class="row"  style="height:100;">
                                    <div class="col-xs-3">
                                        <i><img src="meal.png" style="width:100px;height:100px;"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
										
                                        <div class="huge">
										<?php
										require_once("include/connection.php");
										$total = 0;
										$sql="SELECT * FROM product WHERE status = 'AVAILABLE'";
										$res=mysql_query($sql) or die ("db query failed" .mysql_error());
										while($fet=mysql_fetch_array($res)){
											//echo count($fet['id']);
											$total = $total + count($fet['id']);
										}
										echo $total;
										?></div>
                                        <div>Meals Available</div>
                                    </div>
                                </div>
                            </div>
							<a href="meals.php">
                                <div class="panel-footer" style="height:10;">
                                    <span class="pull-right">View Details</span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
						</div>
					</div>
					<div class="panel1" style="position:relative;top:-390;width:300;left:680;">
                        <div class="panel panel-blue">
							<div class="panel-heading">
                                <div class="row"  style="height:100;">
                                    <div class="col-xs-3">
                                        <i><img src="member.png" style="width:100px;height:100px;"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
										
                                        <div class="huge">
										<?php
										require_once("include/connection.php");
										$total = 0;
										$sql="SELECT * FROM user where _status='ACTIVE'";
										$res=mysql_query($sql) or die ("db query failed" .mysql_error());
										while($fet=mysql_fetch_array($res)){
											//echo count($fet['id']);
											$total = $total + count($fet['_id']);
										}
										echo $total;
										?></div>
                                        <div>Active Members</div>
                                    </div>
                                </div>
                            </div>
							<a href="activemembers.php">
                                <div class="panel-footer" style="height:10;">
                                    <span class="pull-right">View Details</span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
						</div>
					</div>
					<div class="panel1" style="position:relative;top:-798;width:300;left:1000;">
                        <div class="panel panel-green">
							<div class="panel-heading">
                                <div class="row"  style="height:100;">
                                    <div class="col-xs-3">
                                         <i><img src="transaction.png" style="width:80px;height:100px;"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
										
                                        <div class="huge">
										<?php
										$date = date("m/d/Y");
										require_once("include/connection.php");
										$total = 0;
										$sql="SELECT * FROM transaction where status = 'PENDING' and date = '{$date}'";
										$res=mysql_query($sql) or die ("db query failed" .mysql_error());
										while($fet=mysql_fetch_array($res)){
											//echo count($fet['id']);
											$total = $total + count($fet['id']);
										}
										echo $total;
										?></div>
                                        <div>Ongoing Transactions</div>
                                    </div>
                                </div>
                            </div>
							<a href="ongoingtransaction.php">
                                <div class="panel-footer" style="height:10;">
                                    <span class="pull-right">View Details</span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
						</div>
					</div>
					<div class="panel1" style="position:relative;top:-740;width:300;left:1000;">
                        <div class="panel panel-red">
							<div class="panel-heading">
                                <div class="row"  style="height:100;">
                                    <div class="col-xs-3">
                                         <i><img src="Iconshock-Vista-General-Trash.ico" style="width:100px;height:100px;"></i>
                                   
                                    </div>
                                    <div class="col-xs-9 text-right">
										
                                        <div class="huge">
										<?php
										require_once("include/connection.php");
										$total = 0;
										$total1 = 0;
										$totalcount = 0;
										$sql="SELECT * FROM user where deleted = 1";
										$res=mysql_query($sql) or die ("db query failed" .mysql_error());
										while($fet=mysql_fetch_array($res)){
											//echo count($fet['id']);
											$total = $total + count($fet['_id']);
										}
										$sql1="SELECT * FROM product where deleted = 1";
										$res1=mysql_query($sql1) or die ("db query failed" .mysql_error());
										while($fet1=mysql_fetch_array($res1)){
											//echo count($fet['id']);
											$total1 = $total1 + count($fet1['id']);
										}
										$totalcount = $total + $total1;
										echo $totalcount;
										?></div>
                                        <div>Recycle Bin</div>
                                    </div>
                                </div>
                            </div>
							<a href="archive.php">
                                <div class="panel-footer" style="height:10;">
                                    <span class="pull-right">View Details</span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
						</div>
					</div>
			</div>
		</div>
	</body>
	
</html>