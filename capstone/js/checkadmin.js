var check;

function buildAjaxNow(adminusername){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else{
		xmlHttp = new XMLHttpRequest();
	}
	xmlHttp.open("GET", "checkadmin.php?adminusername="+adminusername, true);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange = replyServer;
}

function replyServer(){
	if((xmlHttp.readyState==4) && (xmlHttp.status==200)){
		check = xmlHttp.responseText;
		if(check==0)
		{
			document.getElementById('invalidusername').innerHTML = "Not Available.";
			document.getElementById('username').style.cssText = "background:indianred; width: 100%; color:white; border:2px solid indianred;";
			document.getElementById('addbtn').disabled = true;
		}
		else
		{
			document.getElementById('invalidusername').innerHTML = "Available.";
			document.getElementById('username').style.cssText = "background:white; width: 100%; color:black; border:2px solid green;";
			document.getElementById('addbtn').disabled = false;
		}
	}
}

function setBlur(object){
	value = object.value;
	if(value.length==0){
		document.getElementById('categoryerror').innerHTML = "Required Field.";
		object.style.cssText = "background:indianred; color:white; border:2px solid indianred;";
		document.getElementById('addcatebtn').disabled = true;
	}
}












