<?php include("header.php"); ?>
	<br/><br/>
	<input type="hidden" id="post_id" name="post_id" value="<?php echo $_REQUEST["pid"];?>"/>
	<div class="container">

		<div id="single_post">
		<!--
		load daya with Ajax & JS
		-->
		</div>
<br>
<h4>Leave comments</h4>
		<form>
		<div class="form-group">
		<label for="exampleFormControlInput1">Name</label>
		<input class="form-control" type="text" placeholder="Name">
		</div>

		<div class="form-group">
		<label for="exampleFormControlInput1">Mail </label>
		<input class="form-control" type="text" placeholder="Email">
		</div>

		<div class="form-group">
		<label for="exampleFormControlInput1">Url </label>
		<input class="form-control" type="text" placeholder="Url">
		</div>
  
		<div class="form-group">
		<label for="exampleFormControlTextarea1">Comments</label>
		<textarea class="form-control" id="commentTextarea" rows="3"></textarea>
		</div>
		<button type="submit" class="btn btn-primary mb-2">Submit</button>
		</form>
	</div>


	
</body>
</html>