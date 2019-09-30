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
	if(isset($_POST['addbtn']))
	{
		$url	=	rand();
		$name	=	$_POST['search-bar'];
		$desc	=	$_POST['desc'];
		$cate	=	$_POST['cate'];
		$pric	=	$_POST['pric'];
		
		
		if(empty($_FILES['fileimage']['tmp_name'])){
			mysql_close($con);
			die("ERROR");
		}
		else{
			$file = $_FILES['fileimage']['tmp_name'] or die("MALI1".mysql_error());
			move_uploaded_file($file,"images/products/{$url}.jpg") or die("MALI3".mysql_error());
			$query2 = mysql_query("INSERT INTO product (images, name, description, category, price, uploadedby,deleted,status) VALUES ('{$url}.jpg','{$name}','{$desc}','{$cate}','{$pric}','{$uplo}',0,'AVAILABLE')") or die("MALI4".mysql_error());
			if (!$query2){ // add this check.
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:loadaddprodxml.php") or die("MALI".mysql_error());
			
		}
	}
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/productadd.js"></script>
		<script type="text/javascript" src="checkproductname.js"></script>
	</head>
	<script>
		function imagepreview(){
			var input = document.getElementById('fileimage').value;
			var input2 = input.substr(12,input.length);
			var i = document.getElementById('i');
			i.setAttribute('src','images/'+input2);
			//document.getElementById('imageprev').appendChild(i);
			//alert(input2);
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
<style type="text/css">
table#sample tr:nth-child(even) {
  background-color: #eee;
}
table#sample tr:nth-child(odd) {
  background-color: #fff;
}
table#sample th {
  color: black;
  background-color: #eee;
}
table#sample tr:hover{
  background-color: #ffff99;
}
</style>
<style type="text/css">
#popups div:hover{
background-color:gray;
color: white;
border: solid;
}
#popups{
background-color:white;
width: 40%;
position:absolute;
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
			<div id="addcontent">
				
				<span id="addtitle">ADD MEALS</span></br></br>
				<?php
					if( $posted ) {
					if( $result ) {
						?><div class="isa_success" style="width:37%;">
								Meal Successfully Added!
						  </div><?php
					}else{
						echo "<script type='text/javascript'>alert('failed!')</script>";
						}
					}
				?>
				<h5 class="isa_info" style="width:37%;">
					All fields with * are required!
				</h5>
				
				<div class="form-group">
				<form id="addprod" name="addprod" onsubmit="return validatefrm()" method="POST" enctype="multipart/form-data">
				<label>Image *</label>
				<input class="form-control" type="file" id="fileimage" name='fileimage' value="Browse Picture" required="required" onblur="imagepreview()"/>
				<label>Name *</label>
                <input class="form-control" placeholder="Enter Meal Name" required="required" type='text' id='search-bar' name='search-bar' onkeyup='makeRequest()' autocomplete='off'>
				<div id='status' style="font-size:12px;"></div>
				<div id='popups'></div>
				<label>Description *</label>
                <textarea class="form-control" placeholder="Enter Meal Description" required="required" type="text" id="desc" name='desc'></textarea>
				<label>Category *</label></br>
                <select class="form-control" id="cate" name ="cate" >
								<?php
									$sql="SELECT * FROM category";
									$res=mysql_query($sql) or die ("db query failed" .mysql_error());
									while($fet=mysql_fetch_array($res)){
											echo "<option value = {$fet['categoryname']}>{$fet['categoryname']}</option>";
									}
								?>
				</select></br>
                <label>Price (Php) *</label>
                <input class="form-control" min="1.00" maxlength="4" required="required" type="number" id="pric" name='pric' placeholder="Enter Meal Price here"></br></br>
				<input class="form-control" name="addbtn" id="addbtn" type="submit" value="ADD">
				</form>
				</div>
				<div id="imageprev" style="color:white;-webkit-box-shadow:2px 2px 100px 1px rgba(0,0,0,0.8) inset;border-style:outset;border-radius:12px;width:300px;height:300px;margin-left:55%;margin-top:-40%;">
					&nbsp;&nbsp;&nbsp;&nbsp;IMAGE PREVIEW:
					<img id="i" style="width:300px;height:300px;border-radius:12px;">
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