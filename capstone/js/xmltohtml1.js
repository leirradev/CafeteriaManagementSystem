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
	var xmlDoc = loadXMLDoc("catalog.xml");
	
	var catalog = xmlDoc.getElementsByTagName('catalog')[0];
	var product = catalog.getElementsByTagName('product');
	
	var tableCatalog = document.createElement('table');
	tableCatalog.setAttribute('id','catalogTable');
	document.getElementById('tablecontainer').appendChild(tableCatalog);
	
	var trheader = document.createElement('tr');
	trheader.style.cssText ="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;";
	tableCatalog.appendChild(trheader);
	
	var tdname = document.createElement('td');
	tdname.innerHTML = "NAME";
	trheader.appendChild(tdname);
	
	var tdcate = document.createElement('td');
	tdcate.innerHTML = "CATEGORY";
	trheader.appendChild(tdcate);
	
	var tdprice = document.createElement('td');
	tdprice.innerHTML = "PRICE";
	trheader.appendChild(tdprice);
	
	var tdprice1 = document.createElement('td');
	tdprice1.innerHTML = "STATUS";
	trheader.appendChild(tdprice1);
	
	for(var x = 0; x<product.length;x++)
	{
		var currentProduct = product[x];
		var trcreator = document.createElement('tr');
		trcreator.style.cssText ="text-align:center;font-family:Segoe UI;font-size:12px;";
		tableCatalog.appendChild(trcreator);
		
		var tdnamecreator = document.createElement('td');
		tdnamecreator.innerHTML = currentProduct.getElementsByTagName('name')[0].firstChild.data;
		trcreator.appendChild(tdnamecreator);
		
		var tdcategory = document.createElement('td');
		tdcategory.innerHTML = currentProduct.getElementsByTagName('category')[0].firstChild.data;
		trcreator.appendChild(tdcategory);
		
		var tdprice = document.createElement('td');
		tdprice.innerHTML = "Php "+currentProduct.getElementsByTagName('price')[0].firstChild.data+".00";
		trcreator.appendChild(tdprice);
		
		var tdprice1 = document.createElement('td');
		tdprice1.innerHTML = currentProduct.getElementsByTagName('status')[0].firstChild.data;
		trcreator.appendChild(tdprice1);
		
	}
}