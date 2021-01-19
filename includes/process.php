<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

//For Registration Processsing
//if (isset($_REQUEST["username"]) AND isset($_REQUEST["email"])) {

if (isset($_REQUEST["username"]) AND isset($_REQUEST["email"])) {
	//die("i am here");
	$user = new User();
		
	//$result = $user->createUserAccount($_REQUEST["username"],$_REQUEST["email"],$_REQUEST["password1"],$_REQUEST["usertype"]);
	$result = $user->createUserAccount($_REQUEST["username"],$_REQUEST["email"],$_REQUEST["password1"],$_REQUEST["usertype"]);
	echo $result;
	exit();
}

//For Login Processing
if (isset($_REQUEST["log_email"]) AND isset($_REQUEST["log_password"])) {
	$user = new User();
	$result = $user->userLogin($_REQUEST["log_email"],$_REQUEST["log_password"]);
	echo $result;
	exit();
}


//------------------manage_posts---------------------


//Manage post / listing page of posts
if (isset($_REQUEST["managePost"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("posts",$_REQUEST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = (($_REQUEST["pageno"] - 1) * 5)+1;
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["title"]; ?></td>
					<td><?php echo $row["content"]; ?></td>
					<td><img src="<?php echo $row["photo"]; ?>" width="160px"></td>
					<td><?php echo $row["date"]; ?></td>
					<td><?php echo $row["author"]; ?></td>
			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td>
			        	<a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_post">Delete</a>
			        	<a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#form_post" class="btn btn-info btn-sm edit_post">Edit</a>
			        </td>
			      </tr>
			<?php
			$n++;
		}
		?>
			<tr><td colspan="5"><?php echo $pagination; ?></td></tr>
		<?php
		exit();
	}
}


//Add post
if (isset($_REQUEST["form_action"]) && $_REQUEST["form_action"]=="post_add") {
	$obj = new DBOperation();
	$result = $obj->addPost($_REQUEST["post_title"],
							$_REQUEST["post_content"],
							$_REQUEST["post_photo"],
							$_REQUEST["post_author"]);
	echo $result;
	/*
	//if post added successfully then upload image on server upload folder
	if($result=="POST_ADDED")
	{
		// Get image name
		$featured_image = $_FILES['featured_image']['name'];
		if (empty($featured_image)) { array_push($errors, "Featured image is required"); }
		// image file directory
		$target = "../upload_imgaes/" . basename($featured_image);
		if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		array_push($errors, "Failed to upload image. Please check file settings for your server");
		}
	}
	*/
	exit();
}

//Delete post
if (isset($_REQUEST["deletePost"])) {
	$m = new Manage();
	$result = $m->deleteRecord("posts","id",$_REQUEST["id"]);
	echo $result;
}


//Fetech Data for Update Post
if (isset($_REQUEST["getUpdatePostData"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("posts","id",$_REQUEST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_REQUEST["form_action"]) && $_REQUEST["form_action"]=="post_update") {
	$m = new Manage();
	$id = $_REQUEST["pid"];
	$post_title = $_REQUEST["post_title"];
	$post_photo = $_REQUEST["post_photo"];
	$post_content = $_REQUEST["post_content"];
	$post_author = $_REQUEST["post_author"];
	$result = $m->update_record("posts",["id"=>$id],["title"=>$post_title,"content"=>$post_content,"photo"=>$post_photo,"author"=>$post_author]);
	echo $result;
}


?>