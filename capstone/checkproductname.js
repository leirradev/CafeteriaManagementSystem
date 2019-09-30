window.onload = makeRequest();
var xhr = false;
var usernameArray = new Array();

function makeRequest(){
	if(window.XMLHttpRequest){
		xhr=new XMLHttpRequest();
	}
	else{
		if(window.ActiveXObject){
			try{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){}
		}
	}
	if(xhr){
		xhr.onreadystatechange = setusernameArray;
		xhr.open("GET","catalog.xml",true);
		xhr.send(null);
	}
	else{
		alert("Couldnt create an XMLHttpRequest");
	}
}
function setusernameArray(){

	if(xhr.readyState==4){
		if(xhr.status==200){
			if(xhr.responseXML){
			
				var allNames = xhr.responseXML.getElementsByTagName("product");
				for(var i=0; i < allNames.length; i++){
					usernameArray[i] = allNames[i].getElementsByTagName("name")[0].firstChild.data;
				}
			setItemSearch();
			}
		}
		else{
			alert("Problem with the request " + xhr.status);
		}
	}
}

function setItemSearch(){
	var search = document.getElementById("search-bar").value;
	document.getElementById("popups").innerHTML = "";
	found = 0;
		if(search != ""){
			for(var i=0;i<usernameArray.length;i++){
				var item = usernameArray[i];
				if(item.toLowerCase().indexOf(search.toLowerCase()) == 0){
					var div = document.createElement("div");
					div.innerHTML = item;
					div.className = "popups";
					div.onclick = setText;
				document.getElementById("popups").appendChild(div);
				}
			}
			var found = document.getElementById("popups").childNodes.length;
			if(found == 0){
			var input = document.getElementById("search-bar");
			document.getElementById('search-bar').style.cssText = "background:white; width: 40%; color:black; border:2px solid green;";
			var input2 = document.getElementById("status");
			input2.innerHTML = "Available";
			document.getElementById('addbtn').disabled = false;
			}else if(found == 1){
			var pop = document.getElementById("popups");
			document.getElementById("search-bar").value = pop.getElementsByTagName("div")[0].firstChild.data;
			document.getElementById("popups").innerHTML = "";
			var input4 = document.getElementById("status");
			input4.innerHTML = "Already Taken";
			document.getElementById('search-bar').style.cssText = "background:indianred; width: 40%; color:white; border:2px solid indianred;";
			document.getElementById('addbtn').disabled = true;
			}
		}else{
		document.getElementById("popups").innerHTML = "";
		var input = document.getElementById("search-bar");
		input.setAttribute("style","background-color:white;color:black;");
		input.value ="";
		var inp = document.getElementById("status");
		inp.innerHTML = "";
		document.getElementById('addbtn').disabled = false;
		}
}

function setText(evt){
var click = evt.target;
document.getElementById("search-bar").value = click.innerHTML;
document.getElementById("popups").innerHTML = "";
var input3 = document.getElementById("status");
input3.innerHTML = "Already Taken";
document.getElementById('search-bar').style.cssText = "background:indianred; width: 40%; color:white; border:2px solid indianred;";
document.getElementById('addbtn').disabled = true;
}