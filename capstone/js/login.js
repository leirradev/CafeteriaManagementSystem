function setBlur(object){
	value = object.value;
	if(value.length==0){
		document.getElementById('username').innerHTML = "Required Field.";
		document.getElementById('password').innerHTML = "Required Field.";
		object.style.cssText = "background:indianred; color:white;text-align:left; border:2px solid indianred;";
		document.getElementById('submit').disabled = true;
	}else{
	document.getElementById('submit').disabled = false;
	object.style.cssText = "text-align:left;";
	}
}
