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
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
	#wrapper{
		background: url('Background/bckg_7.jpg');
		background-size: cover;
	}
	.usr-img{
		padding-left: 50px;
		padding-top:5px;
	}
	.user-comments .comment-data{
		min-height: 80px;
		background:#fff;
		padding:10px;
		box-shadow: 0 0 1px 1px #8d9cde;
	}	
	.user-comments{
		margin-top: 10px;
	}
	#blog-ref a{
		color:#356e6f;
	}
	.title{
		color:#de5842;
		margin-bottom: 20px;
	}
	blockquote
	{
		font-style: italic;
		font-family: Georgia, Times, "Times New Roman", serif;
		padding: 2px 0;
		border-style: solid;
		border-color: #ccc;
		border-width: 0;
	}

	.cke_contents_ltr blockquote
	{
		padding-left: 20px;
		padding-right: 8px;
		border-left-width: 5px;
	}

	.cke_contents_rtl blockquote
	{
		padding-left: 8px;
		padding-right: 20px;
		border-right-width: 5px;
	}

	a
	{
		color: #0782C1;
	}

	ol,ul,dl
	{
		/* IE7: reset rtl list margin. (#7334) */
		*margin-right: 0px;
		/* preserved spaces for list items with text direction other than the list. (#6249,#8049)*/
		padding: 0 40px;
	}

	h1,h2,h3,h4,h5,h6
	{
		font-weight: normal;
		line-height: 1.2;
	}

	hr
	{
		border: 0px;
		border-top: 1px solid #ccc;
	}

	img.right
	{
		border: 1px solid #ccc;
		float: right;
		margin-left: 15px;
		padding: 5px;
	}

	img.left
	{
		border: 1px solid #ccc;
		float: left;
		margin-right: 15px;
		padding: 5px;
	}

	pre
	{
		white-space: pre-wrap; /* CSS 2.1 */
		word-wrap: break-word; /* IE7 */
		-moz-tab-size: 4;
		-o-tab-size: 4;
		-webkit-tab-size: 4;
		tab-size: 4;
	}

	.marker
	{
		background-color: Yellow;
	}

	span[lang]
	{
		font-style: italic;
	}

	figure
	{
		text-align: center;
		border: solid 1px #ccc;
		border-radius: 2px;
		background: rgba(0,0,0,0.05);
		padding: 10px;
		margin: 10px 20px;
		display: inline-block;
	}

	figure > figcaption
	{
		text-align: center;
		display: block; /* For IE8 */
	}

	a > img {
		padding: 1px;
		margin: 1px;
		border: none;
		outline: 1px solid #0782C1;
	}
</style>


<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<div id="header" class="container row">
	<div class="col-sm-4"><img src="Final_Logo.png" data-src="Final_Logo.png"></div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#logo img').lazy();
		});
	</script>
	<div class="col-sm-8">
	<div id="contacts" class="row" style="width:100%;height:40px;margin:5px;display:block;">
	<div class="pull-right" style="padding:5px;text-align:center;background:#ccc;">
		<strong>Contact Us @</strong>
		<span class="icon-pencil"> reachus@makeuber.com</span>&nbsp;&nbsp;
		<span class="icon-phone">+(91) 9900071655</span>
	</div>
	</div>
	<div id="menu-bar">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
		      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-menu">
		        	<span class="sr-only">Toggle navigation</span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		      		</button>
		    	</div>
				<div class="collapse navbar-collapse" id="navbar-collapse-menu">
					<ul class="nav navbar-nav">
						<li><a href="#">Home</a></li>
						<li><a href="#">How It Works</a></li>
						<li><a href="#">Experts</a></li>
						<li><a href="#">Ask</a></li>
						<li class="active"><a href="#">Blog</a></li>
						<li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
						<li><a href="register.html">Register</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div></div>
</div>

<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="css/style.css">
<link rel ="stylesheet" href="css/font-awesome.min.css">
<!-- ---------------------MAIN ------------------------------- -->
<div id="main" class="row container" style="padding:10px;height:auto;opacity:1;">
	<div class="col-sm-3 col-sm-push-9" id="blog-ref" style="background:#e8866c;color:#fff;height:auto;padding:10px;">
		<div class="input-group">
			<input type="text" class="form-control" name="search" placeholder = "Search">
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
		</div>
		<div>
			<h4>Browse by Category</h4>
			<a href="#">Kitchens</a> | <a href="#">Wall Treatments</a> | <a href="#">Living Room</a> | <a href="#">Bedroom</a> | <a href="#">Terrace</a> | <a href="#">Bath</a>
		</div>
		<div>
			<h4>Recent Posts</h4>
			<a href="#">Wall treatments - why,how and what?</a>
		</div>
	</div>
	<div class="col-sm-7 col-sm-pull-2" style="background:#fff;height:auto;padding:30px;width:850px;font-size:20px;font-weight:400;">
		<?php
			if(isset($_POST['content'])){
				$title = $_POST['title'];
				$category = $_POST['category'];
				$image = $_POST['image'];
				echo '<h1 class="title">'.$title.'</h2>';
				echo '<div class="content">'.$_POST['content'].'</div>';
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				var title = $('.title').text();
				var content = $('.content').text();
				var cat = '<?php echo $category;?>';
				var image = '<?php echo $image;?>';
				//alert(content);
				$.ajax({
					url:'blog_db.php',
					type:'POST',
					data:{title:title,setdata:content,category:cat,image:image}
				}).done(function(data){
					alert(data);
					//do when insertion is done
				});
			});
		</script>
		<?php
			}
		?>
	</div>
</div>

<!----------------------------FOOTER------------------- -->
<div id="footer" class="row" style="margin-top:30px;">
	<div class="col-sm-3" style="font-size:25pt;padding:20px;">
		<i class="fa fa-facebook-square">&nbsp;</i>
		<i class="fa fa-google-plus-square">&nbsp;</i>
		<i class="fa fa-twitter-square">&nbsp;</i>
		<i class="fa fa-linkedin-square">&nbsp;</i>
	</div>
	<div class="col-sm-6" style="text-align:center;">
		<span style="font-size:20px;font-family: 'Yanone Kaffeesatz', sans-serif;">Choose Your Expert II Take Inspirations II Ask for Advice II Talk to fellow Home Owners II Upload Your Creative Ideas II Start Your Project
		<br>Make Your Spaces the "Uber" Way</span>
	</div>
	<div class="col-sm-3" style="font-size:15px;">
		<p><strong>Contact Us @</strong><br>
		<span class="icon-pencil"> reachus@makeuber.com</span>&nbsp;&nbsp;<br>
		<span class="icon-phone">+(91) 9900071655</span></p>
	</div>
	<div class="col-sm-12">
		<hr style="border:1px solid #111;margin-bottom:10px;">
	</div>
	<div class="col-sm-10">
		<ul class="footer-menu">
			<li><a href="makeuber.html">Home</a></li>
			<li><a href="howitworks.html">How It Works</a></li>
			<li><a href="#">Experts</a></li>
			<li><a href="ask.html">Ask</a></li>
			<li class="active"><a href="blog.html">Blog</a></li>
			<li><a href="register.html">Register</a></li>
			<li><a href="#">About us</a></li>
		</ul>
	</div>
	<div class="col-sm-2">
		<strong>&copy; 2014 | <a href="#">Privacy Policy</a></strong>
	</div>
</div>	

<!-- ---------------------MODAL ------------------------------- -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-title"><h2>Login</h2></div>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#" role="tab" data-toggle="tab">Users</a></li>
					<li><a role="tab" data-toggle="tab">Experts</a></li>
				</ul>
				<br>
				<div class="tab-content">
					<div class="tab-pane fade in active">
						<div class="input-group input-modal">
							<span class="input-group-addon icon-user"></span>
							<input type="text" class="form-control" placeholder="Username"> 
						</div>
						<br>
						<div class="input-group input-modal">
							<span class="input-group-addon icon-lock"></span>
							<input type="password" class="form-control" placeholder="Password"> 
						</div><br>
					<button type="button" class="btn btn-success">Sign In</button>&nbsp;&nbsp;&nbsp;
					Or connect with <br><br>
		        	<button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
		        	<button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
		       	 	<button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</button>
					</div>
					<div class="tab-pane fade"></div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>