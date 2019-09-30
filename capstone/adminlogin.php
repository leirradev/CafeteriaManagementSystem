<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
<html>
<title>Login</title>
<?php
session_start();
$message="";
if(count($_POST)>0) {
$conn = mysql_connect("localhost","root","");
mysql_select_db("onlinemarketplace",$conn);
$username = mysql_escape_string($_POST['txtUsername']);
$password = mysql_escape_string($_POST['txtPassword']);
$result = mysql_query("Select * from admin where (username='{$username}' and password='{$password}')");
$row  = mysql_fetch_array($result);
if(is_array($row)) {
$_SESSION["id"] = $row[id];
$_SESSION["username"] = $row[username];
} else {
?><script>alert("Invalid Username or Password");</script><?php
}
}
if(isset($_SESSION["username"])) {
header("Location:admin.php");
}

?>
	<head>
       
		<link rel="stylesheet" type="text/css" href="css/main.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/admin.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
		<link href="jquery/ui-examples.css" rel="stylesheet">
		<link href="jquery/jquery.ui/css/cupertino/jquery-ui-1.10.3.custom.css" rel="stylesheet">
		<style type="text/css">

.container {width: 960px; margin: 0 auto; overflow: hidden;}

#content {	float: left; width: 100%;}

.post { margin: 0 auto; padding-bottom: 50px; float: left; width: 960px; }

.btn-sign {
	width:120px;
	position:relative;
	top:-40px;
	left:1150px;
	padding:20px;
	border-radius:5px;
	background: -moz-linear-gradient(center top, #00c6ff, #018eb6);
    background: -webkit-gradient(linear, left top, left bottom, from(#00c6ff), to(#018eb6));
	background:  -o-linear-gradient(top, #00c6ff, #018eb6);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#00c6ff', EndColorStr='#018eb6');
	font-size:16px;
	color:#fff;
	text-transform:uppercase;
	text-align:center;
}
.btn-signup{
	width:100px;
	margin-top:-125px;
	margin-left: 750px;
	padding:20px;
	border-radius:5px;
	background: -moz-linear-gradient(center top, #00c6ff, #018eb6);
    background: -webkit-gradient(linear, left top, left bottom, from(#00c6ff), to(#018eb6));
	background:  -o-linear-gradient(top, #00c6ff, #018eb6);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#00c6ff', EndColorStr='#018eb6');
	font-size:12px;
	text-align: center;
	color:#fff;
	text-transform:uppercase;
}

.btn-sign a { color:#fff; text-shadow:0 1px 2px #161616; }
.btn-signup a { color:#fff; text-shadow:0 1px 2px #161616; }
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

.login-popup{
	display:none;
	background: #333;
	padding: 20px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close {
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:214px;
}

.button:hover { background:#ddd; }

</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
</script>
<link rel="canonical" href="http://www.alessioatzeni.com/wp-content/tutorials/jquery/login-box-modal-dialog-window/index.html" />

	</head>
	<body onload="startTime(),ini()">
		<div id="container">
			
			<div id="header" style="top:-10px;">
				<div id ="title" style="margin-left:200px;position:relative;top:25px;">
				<h1>ADMIN PORTAL</h1>
				</div>
				<div id="time" style="left:830;">
					<?php
					 
						  date_default_timezone_set('Asia/Manila');
						  $time = date('h:i A',time());
						  //echo $time;
					
					?>
				</div>
				<div id="day" style="left:950;">
				</div>
				<div id="date" style="left:950;">
				</div>
				<div class="btn-sign">
				<a href="#login-box" class="login-window" style="text-decoration:none;">Login</a>
				</div>
			</div>
			<div id="setting" style="height: 100px;background-color:black;">
				
				<div class="post">
        	
				</div>
        
				<div id="login-box" class="login-popup">
		
				<a href="adminlogin.php" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
				<form method="post" class="signin" style="text-align:center;"">
                <fieldset class="textbox">
            	<label class="username">
                <span style="text-align:center;">Username</span>
                <input id="username" onblur="setBlur(this)" name="txtUsername" required="required" value="" type="text" autocomplete="off" placeholder="Username" style="text-align:left;">
                </label>
                
                <label class="password">
                <span style="text-align:center;">Password</span>
                <input id="password"  onblur="setBlur(this)" name="txtPassword" required="required" value="" type="password" placeholder="*******" style="text-align:left;">
                </label>
                
                <input id="submit" type = "submit" value = "Login"></br>
                
                
                </fieldset>
				</form>
			</div>
				
			</div>
			
			<div id="homecontainer">
				<div id="lalagyan">
					<img src="simplelogo.png" style="left:500px;position:relative;"/>
					<img src="titoli.png" style="left:115px;top:150px;position:relative;"/>
				</div>
			</div>
			</div>
		</div>
	</body>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../../jquery/jquery.min.js"><\/script>');</script>
	<script src="jquery/jquery.ui/js/jquery-ui-1.10.3.custom.js"></script>
	<script>
	$(document).ready(function(){
		var $group = $('#group-of-three');

		$('#trigger-a').click(function(e) {
			e.preventDefault();
			$group.accordion();
			$('#trigger-a').hide();
		});
		
		$('#acc-skip2').click(function(e) {
			e.preventDefault();
			
			$group.accordion('option', 'active', 1);
		});
	});
	</script>
</html>