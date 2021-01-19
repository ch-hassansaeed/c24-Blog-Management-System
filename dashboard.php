<?php include("header.php"); ?>
	<br/><br/>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card mx-auto">
				  <img class="card-img-top mx-auto" style="width:60%;" src="./images/user.png" alt="Card image cap">
				  <div class="card-body">
				    <h4 class="card-title">Profile Info</h4>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?></p>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i>User Role : administrator</p>
				    <p class="card-text">Last Login : <?php if(isset($_SESSION['last_login'])) echo $_SESSION['last_login']; ?></p>
				    <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
				  </div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron" style="width:100%;height:100%;">
					<h1>Welcome Admin,</h1>
					<div class="row">
						<div class="col-sm-5">
							<iframe src="clock.html" frameborder="0" width="160" height="160"></iframe>

						</div>
						<div class="col-sm-7">
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">Posts Management</h4>
						        <p class="card-text">Manage and add post section.</p>
						        <a href="#" data-toggle="modal" data-target="#form_post" class="btn btn-primary">New Post</a>
								<a href="manage_posts.php" class="btn btn-primary">Manage Posts</a>
								<hr>
						      </div>
						    </div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>


	 <?php
	//post add Form
	include_once("./templates/add_post.php");
	 ?>



</body>
</html>