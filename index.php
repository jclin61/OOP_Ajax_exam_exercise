<?php
	include_once("connection.php");
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Red Belt Exam</title>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="redbelt.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		//this product_form is for ajax to show lists of products
		$("#product_form").submit(function(){
				var form = $(this)
				$.post(
					form.attr('action'), 
					form.serialize(), 
					function(data){
					$("#list").html(data);
					}, "json");

				return false;
			});

		$(document).on('click',".id_delete",function()
				{
			//.attr to change category back to original to prevent duplicate submission
			$("#category").attr('value', '---select---');
			$(".delete").submit(function(){
					var form = $(this)
					$.post(
						form.attr('action'), 
						form.serialize(), 
						function(data){
						$("#list").html(data);
						}, "json");

					return false;
				});

					$("#product_form").submit();
				});
		
		$("#product_form").submit();

	});

	</script>

</head>
<body>
	<div id="product">
		<h4><u>Add New Product:</u></h4>
		<form id="product_form" action="process.php" method="post">
			
			<input type="hidden" name="action" value="add" />

			<label>Product Name:
				<input type="text" name="name" placeholder="Name" />
			</label><br>

			<label>Category:
				<select name="category" id="category">
					<option>--select--</option>
					<option>cars</option>
					<option>gadgets</option>
					<option>home & living</option>
				</select>
			</label><br>

			<label>Description:
				<textarea type="text" name="description" placeholder="describe your product" /></textarea>
			</label><br>

			<input id="add" type="submit" value="Add" />
			<ul>
		</form>

	</div>
	<div id="list">
	<!-- div for list of products -->
	</div>
	<p>Jerry C. Lin's Red Belt Exam</p>
</body>
</html>