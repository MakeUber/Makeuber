<!DOCTYPE html>
<html lang="en">
<head>
<title>
	MakeUber
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="css/style.css">
<link rel ="stylesheet" href="css/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src = "js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.uploadfile.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/uploadfile.css">
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
</head>

<style type="text/css">
	.proj-img{
		border:1px solid #aaa;
		text-align: center;
		width: 320px;
		padding:20px;
		float: left;
		margin:30px;
	}
	.img{
		height: 170px;
		width: 280px;
		padding: 8px;
		border: 1px solid #aaa;
		box-shadow: 0 0 1px 1px #ccc;
		margin-bottom: 10px;
	}
	.form-control{
		margin: 10px 0px 10px 0px;
		font-size: 12px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle=tooltip]').tooltip();
	});
</script>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">
<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "./include/header.php" ?>
<!-- ---------------------Main ------------------------------- -->
<div id="main" style="background:#fff;margin:20px;height:auto;width:95vw;opacity:1;padding:20px;text-align:center;">
	<h2 style="color:#C16700;">Edit All Images</h2>
	<div style="margin-left:10px;">
		<div style="text-align:left;margin:20px;padding-left:30px;">
			<div class="proj-img">	
				<div class="img"><img src="Images/blog_prev1.jpg" height="100%" width="100%"></div>
				<button class="btn btn-warning">Upload Image</button>
				<input type="text" class="form-control" placeholder="Image Title">
				<textarea class="form-control" placeholder="Previous Description"></textarea>
			</div>
			<div class="proj-img">	
				<div class="img"><img src="Images/blog_prev1.jpg" height="100%" width="100%"></div>
				<button class="btn btn-warning">Upload Image</button>
				<input type="text" class="form-control" placeholder="Image Title">
				<textarea class="form-control" placeholder="Previous Description"></textarea>
			</div>
			<div class="proj-img">	
				<div class="img"><img src="Images/blog_prev1.jpg" height="100%" width="100%"></div>
				<button class="btn btn-warning">Upload Image</button>
				<input type="text" class="form-control" placeholder="Image Title">
				<textarea class="form-control" placeholder="Previous Description"></textarea>
			</div>
			<div class="proj-img">	
				<div class="img"><img src="Images/blog_prev1.jpg" height="100%" width="100%"></div>
				<button class="btn btn-warning">Upload Image</button>
				<input type="text" class="form-control" placeholder="Image Title">
				<textarea class="form-control" placeholder="Previous Description"></textarea>
			</div>
			<div class="proj-img">	
				<div class="img"><img src="Images/blog_prev1.jpg" height="100%" width="100%"></div>
				<button class="btn btn-warning">Upload Image</button>
				<input type="text" class="form-control" placeholder="Image Title">
				<textarea class="form-control" placeholder="Previous Description"></textarea>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<button type="button" class="btn btn-lg btn-success">Save Changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn btn-lg btn-danger">Go Back</button>
</div>

<!-- ---------------------Footer ------------------------------- -->
<?php include "./include/footer.php" ?> 
</body>
</html>