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
			document.getElementById('invalidusername').innerHTML = "Already Taken.";
			document.getElementById('snum').style.cssText = "background:indianred; width: 40%; color:white; border:2px solid indianred;";
			document.getElementById('addbtn').disabled = true;
		}
		else
		{
			document.getElementById('invalidusername').innerHTML = "Available.";
			document.getElementById('snum').style.cssText = "background:white; width: 40%; color:black; border:2px solid green;";
			document.getElementById('addbtn').disabled = false;
		}
	}
}

function setBlur(object){
	value = object.value;
	if(value.length==0){
		document.getElementById('addbtn').disabled = true;
	}else{
		
	}
}










