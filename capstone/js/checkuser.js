var check;

function buildAjaxNow(memberusername){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else{
		xmlHttp = new XMLHttpRequest();
	}
	xmlHttp.open("GET", "checkuser.php?memberusername="+memberusername, true);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange = replyServer;
}

function replyServer(){
	if((xmlHttp.readyState==4) && (xmlHttp.status==200)){
		check = xmlHttp.responseText;
		if(check==0)
		{
			document.getElementById('invalidusername').innerHTML = "Not Available.";
			document.getElementById('username').style.cssText = "background:indianred; width: 90%; color:white; border:2px solid indianred;";
			document.getElementById('addbtn').disabled = true;
		}
		else
		{
			document.getElementById('invalidusername').innerHTML = "Available.";
			document.getElementById('username').style.cssText = "background:white; width: 90%; color:black; border:2px solid green;";
			document.getElementById('addbtn').disabled = false;
		}
	}
}

function setBlur(object){
	value = object.value;
	if(value.length==0){
		document.getElementById('invalidusername').innerHTML = "Required Field.";
		document.getElementById('invalidpassword1').innerHTML = "Required Field.";
		document.getElementById('invalidpassword2').innerHTML = "Required Field.";
		document.getElementById('contactnum').innerHTML = "Required Field.";
		document.getElementById('pcontactnum').innerHTML = "Required Field.";
		document.getElementById('loadnum').innerHTML = "Required Field.";
		object.style.cssText = "background:indianred; color:white; border:2px solid indianred;";
		document.getElementById('addbtn').disabled = true;
	}else{
		document.getElementById('invalidpassword1').innerHTML = "";
		document.getElementById('invalidpassword2').innerHTML = "";
		document.getElementById('contactnum').innerHTML = "";
		document.getElementById('pcontactnum').innerHTML = "";
		document.getElementById('loadnum').innerHTML = "";
	}
}










