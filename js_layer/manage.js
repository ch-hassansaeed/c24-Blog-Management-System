$(document).ready(function(){
	//var DOMAIN = "http://localhost:86/check24_blog";
var DOMAIN = _sitebaseurl;
//alert(DOMAIN);



	//----------mange posts page-------------
	//get all posts data
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

	//pagination link buttons
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		 if( $('#get_posts').length ) //page-link exist in all pages so we run only if its post page
		 {
			managePost(pn);
		 }
	})

	//delete post
	$("body").delegate(".del_post","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete..!")) {
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : {deletePost:1,id:did},
				success : function(data){
					if (data == "DELETED") {
						alert("Post is deleted");
						managePost(1);
					}else{
						alert(data);
					}
						
				}
			})
		}
	})

	//get data for Update post form
	$("body").delegate(".edit_post","click",function(){
		var eid = $(this).attr("eid");

		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {getUpdatePostData:1,id:eid},
			success : function(data){
				$("#pid").val(data["id"]);
				$("#post_title").val(data["title"]);
				$("#post_content").val(data["content"]);
				$("#post_photo").val(data["photo"]);
				$("#post_author").val(data["author"]);
			}
		})
	})

	//update post form data into database via API endpoint
	$("#update_post_form").on("submit",function(){
		if ($("#post_title").val() == "") {
			$("#post_title").addClass("border-danger");
			$("#post_error").html("<span class='text-danger'>Please Enter Post Title</span>");
		}else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data  : $("#update_post_form").serialize(),
				success : function(data){
					//alert(data);
					window.location.href = "";
				}
			})
		}
	})




	
})