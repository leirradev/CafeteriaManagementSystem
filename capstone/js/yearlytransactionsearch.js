function doSearchNow(user,cate){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else{
		xmlHttp = new XMLHttpRequest();
	}
	
	xmlHttp.open("GET", "yearlyrequestSearch3.php?name="+user+"&category="+cate, true);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange = replyServer;
	//alert(cate);
}	

function replyServer(){
	if((xmlHttp.readyState==4) && (xmlHttp.status==200)){
		document.getElementById('tablecontainer').innerHTML = xmlHttp.responseText;
	}
}






