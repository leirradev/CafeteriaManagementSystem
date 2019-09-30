<?php    
	//database connection
	require_once("include/connection.php");
	//database connection end
	$root = new DomDocument("1.0");						//create rootxml
	
	$catalog = $root->createElement('user');			//create new element story
	$root -> appendChild($catalog);						//append story to root
	
	
	
	$query = "SELECT * FROM user where deleted = 0 order by _username";	//sql query
	$entries = mysql_query($query);						//execute query
	
	while($entry = mysql_fetch_array($entries))			//looping for the fetch
	{
		$dbUser = $entry['_username'];						//fetch column date
		$dbPass = $entry['_password'];	
$dbFname = $entry['fname'];
$dbLname = $entry['lname']; 		//fetch column title
		$dbContact = $entry['_contact_no'];				//fetch column article
		$dbGuardian = $entry['_contact_no_of_guardian'];				//fetch column article
		$dbLoad = $entry['_load'];				//fetch column article
		$dbStatus = $entry['_status'];
		$dbStatus1 = $entry['deleted'];
		$dbId = $entry['_id'];
		
		$product = $root->createElement('user_id');			//create new element blog
		$product -> setAttribute('id',$dbId);
		$catalog -> appendChild($product);					//insert blog inside story element
		
		
		
		$user = $root->createElement('username');			//create new element title
		$strUser = $root->createTextNode($dbUser);	//create a inner html coming from database
		$user->appendChild($strUser);					//insert the inner html to title element
		$product->appendChild($user);						//insert title to blog
		
		$pass = $root->createElement('password');			//create new element date
		$strPass = $root->createTextNode($dbPass);		//create a inner html coming from database
		$pass->appendChild($strPass);					//insert the inner html to date element
		$product->appendChild($pass);			

$pass1 = $root->createElement('fname');			//create new element date
		$strPass1 = $root->createTextNode($dbFname);		//create a inner html coming from database
		$pass1->appendChild($strPass1);					//insert the inner html to date element
		$product->appendChild($pass1);
		
		$pass2 = $root->createElement('lname');			//create new element date
		$strPass2 = $root->createTextNode($dbLname);		//create a inner html coming from database
		$pass2->appendChild($strPass2);					//insert the inner html to date element
		$product->appendChild($pass2);		//insert date element to blog element
		
		$contact1 = $root->createElement('contact_number');			//create new element title
		$strContact1 = $root->createTextNode($dbContact);	//create a inner html coming from database
		$contact1->appendChild($strContact1);					//insert the inner html to title element
		$product->appendChild($contact1);						//insert title to blog
		
		$contact2 = $root->createElement('contact_guardian');		//create a new element article
		$strContact2 = $root->createTextNode($dbGuardian);//create a inner html coming from database
		$contact2->appendChild($strContact2);				//insert inner html to article element
		$product->appendChild($contact2);					//insert article element to blog element
		
		$load = $root->createElement('load');			//create new element title
		$strLoad = $root->createTextNode($dbLoad);	//create a inner html coming from database
		$load->appendChild($strLoad);					//insert the inner html to title element
		$product->appendChild($load);						//insert title to blog
		
		$status = $root->createElement('status');			//create new element title
		$strStatus = $root->createTextNode($dbStatus);	//create a inner html coming from database
		$status->appendChild($strStatus);					//insert the inner html to title element
		$product->appendChild($status);	
		
		$status1 = $root->createElement('deleted');			//create new element title
		$strStatus1 = $root->createTextNode($dbStatus1);	//create a inner html coming from database
		$status1->appendChild($strStatus1);					//insert the inner html to title element
		$product->appendChild($status1);	
		
	}
		$root->formatOutput = true;						//fixed the indention and new line of element root
		//echo "<xmp>" . $root->saveXML() . "</xml>";		//save XML file
		//echo "<xmp>" . $root->saveXML() . "</xml>";	//save XML file
		
		$root->save("users.xml") or die ("save error!");  //export an xml file\
		header("Location:edituser.php?status=deleted");
?>