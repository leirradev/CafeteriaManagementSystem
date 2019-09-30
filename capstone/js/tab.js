$("#btnadd").click(function() {
	$('#addcontent').css({'z-index': '4'});
	$('#editcontent').css({'z-index': '1'});
	$('#featuredcontent').css({'z-index': '1'});
	$('#btnadd').css({'z-index': '3'});
	$('#btnedit').css({'z-index': '2'});
	$('#btnfeature').css({'z-index': '1'});
});
	
$("#btnedit").click(function() {
	$('#addcontent').css({'z-index': '1'});
	$('#editcontent').css({'z-index': '4'});
	$('#featuredcontent').css({'z-index': '1'});
	$('#btnadd').css({'z-index': '2'});
	$('#btnedit').css({'z-index': '3'});
	$('#btnfeature').css({'z-index': '1'});
});
		
$("#btnfeature").click(function() {
	$('#addcontent').css({'z-index': '1'});
	$('#editcontent').css({'z-index': '1'});
	$('#featuredcontent').css({'z-index': '4'});
	$('#btnadd').css({'z-index': '1'});
	$('#btnedit').css({'z-index': '2'});
	$('#btnfeature').css({'z-index': '3'});
});