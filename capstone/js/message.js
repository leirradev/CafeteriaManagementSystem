$hider = 1500;
$shower = 230;
$showerz = '9999';
$hiderz  ='1';
$bgcolor = "#44bbff";
$transparent = "";
$( document ).ready(function() {
	$('#messagecontainer').css({'z-index': $showerz});
	$("#messagecontainer").animate({left:$shower,});
	$('#links2').css({'background-color': $bgcolor});
});
