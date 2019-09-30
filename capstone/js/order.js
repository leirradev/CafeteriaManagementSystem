$hider = 1500;
$shower = 230;
$showerz = '9999';
$hiderz  ='1';
$bgcolor = "#44bbff";
$transparent = "";
$( document ).ready(function() {
	$('#ordercontainer').css({'z-index': $showerz});
	$("#ordercontainer").animate({left:$shower,});
	$('#links3').css({'background-color': $bgcolor});
	
});
