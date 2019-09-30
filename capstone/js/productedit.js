$hider = 1500;
$shower = 230;
$showerz = '9999';
$hiderz  ='1';
$bgcolor = "#44bbff";
$transparent = "";
$( document ).ready(function() {
	$('#links5').css({'background-color': $bgcolor});
	$('#productconatainer').css({'z-index': $showerz});
	$("#productcontainer").css({left:$shower,});
	$('#addcontent').css({'z-index': '1'});
	$('#editcontent').css({'z-index': '4'});
	$('#featuredcontent').css({'z-index': '1'});
	$('#btnadd').css({'z-index': '2'});
	$('#btnedit').css({'z-index': '3'});
	$('#btnfeature').css({'z-index': '1'});
});
