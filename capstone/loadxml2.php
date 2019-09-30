<?php
	//database connection
	require_once("include/connection.php");
	//database connection end
	
	$root = new DomDocument("1.0");						//create rootxml
	
	$catalog = $root->createElement('catalog');			//create new element story
	$root -> appendChild($catalog);						//append story to root
	
	
	
	$query = "SELECT * FROM product where deleted = 0 order by name";	//sql query
	$entries = mysql_query($query);						//execute query
	
	while($entry = mysql_fetch_array($entries))			//looping for the fetch
	{
		$dbImage = $entry['images'];						//fetch column date
		$dbName = $entry['name'];						//fetch column title
		$dbCategory = $entry['category'];				//fetch column article
		$dbDescription = $entry['description'];				//fetch column article
		$dbPrice = $entry['price'];				//fetch column article
		$dbProduct_id = $entry['id'];
		$dbUploaded_by = $entry['status'];
		$dbUploaded_by1 = $entry['deleted'];
		
		$product = $root->createElement('product');			//create new element blog
		$product -> setAttribute('id',$dbProduct_id);
		$catalog -> appendChild($product);					//insert blog inside story element
		
		
		
		$image = $root->createElement('image');			//create new element title
		$strImage = $root->createTextNode($dbImage);	//create a inner html coming from database
		$image->appendChild($strImage);					//insert the inner html to title element
		$product->appendChild($image);						//insert title to blog
		
		$name = $root->createElement('name');			//create new element date
		$strName = $root->createTextNode($dbName);		//create a inner html coming from database
		$name->appendChild($strName);					//insert the inner html to date element
		$product->appendChild($name);						//insert date element to blog element
		
		$description = $root->createElement('description');			//create new element title
		$strDescription = $root->createTextNode($dbDescription);	//create a inner html coming from database
		$description->appendChild($strDescription);					//insert the inner html to title element
		$product->appendChild($description);						//insert title to blog
		
		$category = $root->createElement('category');		//create a new element article
		$strCategory = $root->createTextNode($dbCategory);//create a inner html coming from database
		$category->appendChild($strCategory);				//insert inner html to article element
		$product->appendChild($category);					//insert article element to blog element
		
		$price = $root->createElement('price');			//create new element title
		$strPrice = $root->createTextNode($dbPrice);	//create a inner html coming from database
		$price->appendChild($strPrice);					//insert the inner html to title element
		$product->appendChild($price);						//insert title to blog
		
		$uploadedby = $root->createElement('status');			//create new element title
		$strUpload = $root->createTextNode($dbUploaded_by);	//create a inner html coming from database
		$uploadedby->appendChild($strUpload);					//insert the inner html to title element
		$product->appendChild($uploadedby);	
		
		$uploadedby1 = $root->createElement('deleted');			//create new element title
		$strUpload1 = $root->createTextNode($dbUploaded_by1);	//create a inner html coming from database
		$uploadedby1->appendChild($strUpload1);					//insert the inner html to title element
		$product->appendChild($uploadedby1);	
		
	}
		$root->formatOutput = true;						//fixed the indention and new line of element root
		//echo "<xmp>" . $root->saveXML() . "</xml>";		//save XML file
		//echo "<xmp>" . $root->saveXML() . "</xml>";	//save XML file
		
		$root->save("catalog.xml") or die ("save error!");  //export an xml file\
		
		header("Location: productedit.php?status=success");					//go to blog.xml
?>
