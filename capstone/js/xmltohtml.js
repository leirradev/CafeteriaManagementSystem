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
	//tableCatalog.setAttribute('style','position:relative;');
	document.getElementById('tablecontainer').appendChild(tableCatalog);
	
	var trheader = document.createElement('tr');
	trheader.style.cssText ="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;";
	tableCatalog.appendChild(trheader);
	
	var tdname1 = document.createElement('td');
	tdname1.innerHTML = "IMAGE";
	trheader.appendChild(tdname1);
	
	var tdname = document.createElement('td');
	tdname.innerHTML = "NAME";
	trheader.appendChild(tdname);
	
	var tddesc = document.createElement('td');
	tddesc.innerHTML = "DESCRIPTION";
	trheader.appendChild(tddesc);
	
	var tdcate = document.createElement('td');
	tdcate.innerHTML = "CATEGORY";
	trheader.appendChild(tdcate);
	
	var tdprice = document.createElement('td');
	tdprice.innerHTML = "PRICE";
	trheader.appendChild(tdprice);
	
	var tdprice1 = document.createElement('td');
	tdprice1.innerHTML = "STATUS";
	trheader.appendChild(tdprice1);
	
	var tdmanage = document.createElement('td');
	tdmanage.innerHTML = "MANAGE"
	trheader.appendChild(tdmanage);
	
	for(var x = 0; x<product.length;x++)
	{
		var currentProduct = product[x];
		var trcreator = document.createElement('tr');
		trcreator.style.cssText ="text-align:center;font-family:Segoe UI;font-size:12px;";
		tableCatalog.appendChild(trcreator);
		
		var tdimagecreator = document.createElement('td');
		trcreator.appendChild(tdimagecreator);
		
		var editimage = document.createElement('img');
		editimage.setAttribute('src','images/products/'+currentProduct.getElementsByTagName('image')[0].firstChild.data);
		editimage.style.cssText = "width:100px;height:100px;";
		tdimagecreator.appendChild(editimage);
		
		var tdnamecreator = document.createElement('td');
		tdnamecreator.innerHTML = currentProduct.getElementsByTagName('name')[0].firstChild.data;
		trcreator.appendChild(tdnamecreator);
		
		var tddesccreator = document.createElement('td');
		tddesccreator.innerHTML = currentProduct.getElementsByTagName('description')[0].firstChild.data;
		trcreator.appendChild(tddesccreator);
		
		var tdcategory = document.createElement('td');
		tdcategory.innerHTML = currentProduct.getElementsByTagName('category')[0].firstChild.data;
		trcreator.appendChild(tdcategory);
		
		var tdprice = document.createElement('td');
		tdprice.innerHTML = "Php "+currentProduct.getElementsByTagName('price')[0].firstChild.data+".00";
		trcreator.appendChild(tdprice);
		
		var tdprice1 = document.createElement('td');
		tdprice1.innerHTML = currentProduct.getElementsByTagName('status')[0].firstChild.data;
		trcreator.appendChild(tdprice1);
		
		var tdmanagecreate = document.createElement('td');
		trcreator.appendChild(tdmanagecreate);
		
		var deletelink = document.createElement('a');
		deletelink.setAttribute('href','manageproductstatus.php?product_id='+currentProduct.getAttribute('id')+
		'&status='+currentProduct.getElementsByTagName('status')[0].firstChild.data
		+'&deleted='+currentProduct.getElementsByTagName('deleted')[0].firstChild.data);
		deletelink.setAttribute('class','links');
		tdmanagecreate.appendChild(deletelink);
		
		var editimage = document.createElement('img');
		editimage.setAttribute('src','editstatus.png');
		editimage.setAttribute('title','CHANGE STATUS');
		editimage.style.cssText = "width:20px";
		deletelink.appendChild(editimage);
		
		var deletelink1 = document.createElement('a');
		deletelink1.setAttribute('href','productedit.php?product_id='+currentProduct.getAttribute('id'));
		deletelink1.setAttribute('class','links');
		tdmanagecreate.appendChild(deletelink1);
		
		var editimage1 = document.createElement('img');
		editimage1.setAttribute('src','images/editedit.png');
		editimage1.setAttribute('title','EDIT PRODUCT');
		editimage1.style.cssText = "width:20px";
		deletelink1.appendChild(editimage1);
		
		var deletelink2 = document.createElement('a');
		deletelink2.setAttribute('href','productedit.php?prod_id='+currentProduct.getAttribute('id'));
		deletelink2.setAttribute('class','links');
		tdmanagecreate.appendChild(deletelink2);
		
		var editimage2 = document.createElement('img');
		editimage2.setAttribute('src','images/deletedelete.png');
		editimage2.setAttribute('title','DELETE PRODUCT');
		editimage2.style.cssText = "width:20px";
		deletelink2.appendChild(editimage2);
	}
}