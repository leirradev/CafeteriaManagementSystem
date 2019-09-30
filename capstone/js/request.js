$hider = 1500;
$shower = 230;
$showerz = '9999';
$hiderz  ='1';
$bgcolor = "#44bbff";
$transparent = "";
$( document ).ready(function() {
	$('#requestcontainer').css({'z-index': $showerz});
	$("#requestcontainer").animate({left:$shower,});
	$('#links4').css({'background-color': $bgcolor});
});
