$hider = 1500;
$shower = 230;
$showerz = '9999';
$hiderz  ='1';
$bgcolor = "#44bbff";
$transparent = "";
$( document ).ready(function() {
	$('#membercontainer').css({'z-index': $showerz});
	$("#membercontainer").animate({left:$shower,});
	$('#links6').css({'background-color': $bgcolor});
});
