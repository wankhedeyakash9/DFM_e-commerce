$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "./search.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
            $("#search-box").css("background","#FFF url('../pics/LoaderIcon.gif') no-repeat -100px");
			$("#search-box").css("background-position-x","96%");
            
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
function selectProduct(val) {
	$("#search-box").val(val);	
	$("#suggesstion-box").hide();
}