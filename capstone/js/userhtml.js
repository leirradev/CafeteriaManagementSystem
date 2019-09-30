function loadXMLDoc(filename){
	if (window.XMLHttpRequest){
		xhttp=new XMLHttpRequest();
	}
	else{
		xhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.open("GET",filename,false);
	xhttp.send();
	return xhttp.responseXML;
}

function ini(){
	var xmlDoc = loadXMLDoc("users.xml");
	
	var catalog = xmlDoc.getElementsByTagName('user')[0];
	var product = catalog.getElementsByTagName('user_id');
	
	var tableCatalog = document.createElement('table');
	tableCatalog.setAttribute('id','catalogTable');
	document.getElementById('tablecontainer').appendChild(tableCatalog);
	
	var trheader = document.createElement('tr');
	trheader.style.cssText ="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;";
	tableCatalog.appendChild(trheader);
	
	var tdname = document.createElement('td');
	tdname.innerHTML = "USERNAME";
	trheader.appendChild(tdname);
	
	var tdname1 = document.createElement('td');
	tdname1.innerHTML = "LAST NAME";
	trheader.appendChild(tdname1);
	
	var tdname2 = document.createElement('td');
	tdname2.innerHTML = "FIRST NAME";
	trheader.appendChild(tdname2);
	
	var tdcate = document.createElement('td');
	tdcate.innerHTML = "CONTACT NUMBER";
	trheader.appendChild(tdcate);
	
	var tdprice = document.createElement('td');
	tdprice.innerHTML = "PARENTS CONTACT NUMBER";
	trheader.appendChild(tdprice);
	
	var tdprice1 = document.createElement('td');
	tdprice1.innerHTML = "LOAD";
	trheader.appendChild(tdprice1);
	
	var tdprice2 = document.createElement('td');
	tdprice2.innerHTML = "STATUS";
	trheader.appendChild(tdprice2);
	
	var tdmanage = document.createElement('td');
	tdmanage.innerHTML = "MANAGE"
	trheader.appendChild(tdmanage);
	
	for(var x = 0; x<product.length;x++)
	{
		var currentProduct = product[x];
		var trcreator = document.createElement('tr');
		tableCatalog.appendChild(trcreator);
		
		var tdnamecreator = document.createElement('td');
		tdnamecreator.innerHTML = currentProduct.getElementsByTagName('username')[0].firstChild.data;
		trcreator.appendChild(tdnamecreator);
		
		var tdnamecreator1 = document.createElement('td');
		tdnamecreator1.innerHTML = currentProduct.getElementsByTagName('lname')[0].firstChild.data;
		trcreator.appendChild(tdnamecreator1);
		
		var tdnamecreator2 = document.createElement('td');
		tdnamecreator2.innerHTML = currentProduct.getElementsByTagName('fname')[0].firstChild.data;
		trcreator.appendChild(tdnamecreator2);
		
		var tdcategory = document.createElement('td');
		tdcategory.innerHTML = currentProduct.getElementsByTagName('contact_number')[0].firstChild.data;
		trcreator.appendChild(tdcategory);
		
		var tdprice = document.createElement('td');
		tdprice.innerHTML = currentProduct.getElementsByTagName('contact_guardian')[0].firstChild.data;
		trcreator.appendChild(tdprice);
		
		var tdprice1 = document.createElement('td');
		tdprice1.innerHTML = currentProduct.getElementsByTagName('load')[0].firstChild.data;
		trcreator.appendChild(tdprice1);
		
		var tdprice2 = document.createElement('td');
		tdprice2.innerHTML = currentProduct.getElementsByTagName('status')[0].firstChild.data;
		trcreator.appendChild(tdprice2);
		
		var tdmanagecreate = document.createElement('td');
		trcreator.appendChild(tdmanagecreate);
		
		var editlink1 = document.createElement('a');
		editlink1.setAttribute('href','manageuserstatus.php?user_id='+currentProduct.getAttribute('id')+
		'&status='+currentProduct.getElementsByTagName('status')[0].firstChild.data
		+'&deleted='+currentProduct.getElementsByTagName('deleted')[0].firstChild.data);
		editlink1.setAttribute('class','links');
		tdmanagecreate.appendChild(editlink1);
		
		var editimage1 = document.createElement('img');
		editimage1.setAttribute('src','editstatus.png');
		editimage1.setAttribute('title','CHANGE STATUS');
		editimage1.style.cssText = "width:20px";
		editlink1.appendChild(editimage1);
		
		var editlink = document.createElement('a');
		editlink.setAttribute('href','edituser.php?user_id='+currentProduct.getAttribute('id'));
		editlink.setAttribute('class','links');
		tdmanagecreate.appendChild(editlink);
		
		var editimage = document.createElement('img');
		editimage.setAttribute('src','images/editedit.png');
		editimage.setAttribute('title','EDIT MEMBER');
		editimage.style.cssText = "width:20px";
		editlink.appendChild(editimage);
		
		var deletelink = document.createElement('a');
		deletelink.setAttribute('href','edituser.php?use_id='+currentProduct.getAttribute('id'));
		deletelink.setAttribute('class','links');
		tdmanagecreate.appendChild(deletelink);
		
		var editimage = document.createElement('img');
		editimage.setAttribute('src','images/deletedelete.png');
		editimage.setAttribute('title','DELETE MEMBER');
		editimage.style.cssText = "width:20px";
		deletelink.appendChild(editimage);
	}
}