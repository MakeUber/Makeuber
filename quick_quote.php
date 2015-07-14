<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php"); ?>
<!DOCTYPE HTML>
<html> 
	<head>	
		<title> MakeUber || Quick Quote </title> 
		<style>
			label {  font-size:15pt; 
			}
		</style> 
		<!..Bootstrap Intialization.. >
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="/Muber\css/custom.css">

			<!-- Optional theme -->
			
			
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	
			<link rel="stylesheet" type="text/css" href="css/menu.css">
			<link rel="stylesheet" type="text/css" href="css/Style.css">
			
			
			<link rel="stylesheet" type="text/css" href="css/demo.css" />
			<link rel="stylesheet" type="text/css" href="css/style1.css" />
			<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
	
			<script type="text/javascript" src="js/jquery.js"></script>
			<script src = "js/jsfunction.js" type="text/javascript"></script>
			
			
			<!..Change.. >


<script src ="js/bootstrap.min.js" type="text/javascript"></script>

	</head>
	<body> 
	<div class="container-fluid" style="background-color:black;font-size:12pt;">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><img src="\Muber\img/FinalLogo.png"> </a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="toolgrid.php"> tool grid <span class="sr-only"></span></a></li>
							<li><a href="quickquote.php">quick quote</a></li>
							<li><a href="blog_front.php">blog<span class="sr-only"></span></a></li>
							<li><a href="aboutus.php">about us<span class="sr-only"></span></a></li>
							<li><a href="contactus.php">contact us<span class="sr-only"></span></a></li>
							<?php if($user_status <> 0){?>
				<span style="font-size: 14px;margin-top: 16px;margin-left: 3px;float: left;">
              <span class="icon-user" style="color:white;"></span>
              <?php if($fetch_user['type'] == '0'){?>
                <a href="user_profile.php"><?php echo $fetch_user['first_name'];?></a>
            <?php }else{?>
                <a href="designer_profile"><?php echo $fetch_user['first_name'];?></a>
            <?php }?>
            </span></a></li>
              <li><a style="float:left;" href="logout.php">Logout</a>
              
              </li>
              
              <?php }?>
         	
			 
				</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container-fluid -->
		
	
	<img src="img/qquote.jpg" width="100%" >
	 <form role="form" style="width:50%;position:absolute;right:420px; top:100px;">
	 <center> 
		<h2> You can get in touch with our customer care <a href="tel:+919900071" style="color:blue;"> +91-9900071655 </a> </h2>  
			<h2> Or </h2> 
		<h2>  Fill up the requirement </h2> 
	</center>
		
	<div class="form-horizontal"> 
    <div class="form-group" >
      <label for="wardrobe">wardrobe </label><br>
	  <select class="form-control" style="width:8%">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
	      <label for="Loft"> loft </label>
	  <select class="form-control" style="width:8%">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
		      <label for="Cot">cot</label>
	  <select class="form-control" style="width:8%">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
		      <label for="TVunit">tv unit</label>
	  <select class="form-control" style="width:8%">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
		      <label for="studytable">study table</label>
	  <select class="form-control" style="width:8%">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
		      <label for="sshoeorupsracks">shoe/ups racks</label>
	  <select class="form-control" style="width:8%">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
	  <br> <br>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  
</div>
</div>

	</body>
</html>