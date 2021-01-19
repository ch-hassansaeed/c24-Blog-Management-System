<?php include("header.php"); ?>
	<br/><br/>
	<div class="container">
		<table class="table table-hover table-bordered">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>title</th>
		        <th>content</th>
		        <th>photo</th>
		        <th>datetime</th>
		        <th>author</th>
				<th>Status</th>
				<th>actions</th>
		      </tr>
		    </thead>
		    <tbody id="get_posts">
		      <!--<tr>
		       load with Ajax & JS
		      </tr>-->
		    </tbody>
		  </table>
	</div>


	<?php
		include_once("./templates/update_post.php");
	?>
	
	
</body>
</html>