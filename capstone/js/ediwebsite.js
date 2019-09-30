		$hider = 1500;
		$shower = 230;
		$showerz = '9999';
		$hiderz  ='1';
		$bgcolor = "#44bbff";
		$transparent = "";
		$( document ).ready(function() {
			$('#editwebsitecontainer').css({'z-index': $showerz});
			$("#editwebsitecontainer").animate({left:$shower,});
			$('#links7').css({'background-color': $bgcolor});
		});