$hider = 1500;
$shower = 230;
$showerz = '9999';
$hiderz  ='1';
$bgcolor = "#44bbff";
$transparent = "";
$( document ).ready(function() {
	$('#productconatainer').css({'z-index': $showerz});
	$("#productcontainer").animate({left:$shower,});
	$('#links5').css({'background-color': $bgcolor});
});
