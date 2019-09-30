var check;

function buildAjaxNow(category){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else{
		xmlHttp = new XMLHttpRequest();
	}
	xmlHttp.open("GET", "checkcategory.php?category="+category, true);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange = replyServer;
}

function replyServer(){
	if((xmlHttp.readyState==4) && (xmlHttp.status==200)){
		check = xmlHttp.responseText;
		if(check==0)
		{
			document.getElementById('categoryerror').innerHTML = "Not Available.";
			document.getElementById('categoryname').style.cssText = "background:indianred; color:white; border:2px solid indianred;";
			document.getElementById('addcatebtn').disabled = true;
		}
		else
		{
			document.getElementById('categoryerror').innerHTML = "Available.";
			document.getElementById('categoryname').style.cssText = "background:white; color:black; border:2px solid green;";
			document.getElementById('addcatebtn').disabled = false;
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












