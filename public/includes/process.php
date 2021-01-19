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


//shoe all posts for public home page
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
			        <td><a href="<?= DOMAIN ?>/singlePost.php?pid=<?php echo $row["id"];?>"><?php echo $row["title"]; ?></a></td>
					<td><?php echo substr($row["content"],0,150)."...."; ?></td>
					<td><img src="<?php echo $row["photo"]; ?>" width="160px"></td>
					<td><?php echo $row["date"]; ?></td>
					<td><?php echo $row["author"]; ?></td>
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


//------------------single post---------------------


//show single post page data from db
if (isset($_REQUEST["singlePost"])) {
	$m = new Manage();
	
	$result = $m->getSingleRecord("posts","id",$_REQUEST["pid"]);
	$row = $result;
			?>
				<div id="post-box">
			        <h2><?php echo $row["title"]; ?></h2>
					<p><?php echo $row["content"]; ?></p>
					<div><img src="<?php echo $row["photo"]; ?>" width="160px"></div>
					<div>Publish on:<?php echo $row["date"]; ?></div>
					<div>author:<?php echo $row["author"]; ?></div>
			      </tr>
			<?php	
}
?>