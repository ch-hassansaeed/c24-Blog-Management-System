$(document).ready(function(){
	//base path of project
var DOMAIN = _sitebaseurl;
//alert(DOMAIN);

$("#commentTextarea").Editor(); 

	//----------get all posts-------------
	managePost(1);
	function managePost(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {managePost:1,pageno:pn},
			success : function(data){
				$("#get_posts").html(data);		
			}
		})
	}

	//Pagination button action 
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		 if( $('#get_posts').length ) //page-link exist in all pages so we run only if its post page
		 {
			managePost(pn);
		 }
	})


	//----------single_post page-------------
	singlePost();
	function singlePost(){
		var pidVal=$('#post_id').val();
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {singlePost:1,pid:pidVal},
			success : function(data){
				$("#single_post").html(data);		
			}
		})
	}
	




	
})