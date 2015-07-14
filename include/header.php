<?php 
require_once("init.php");
require_once("config_db.php");
require_once("config.php"); 
$expert_name="select * from user where status ='1' and type='1'";
$exec_expert_name=mysql_query($expert_name);
$user_name="select * from user where status ='1' and type='0'"; 
$exec_user_name=mysql_query($user_name);

?>
<!doctype html>
<head>
<style>
.navbar-right li a:hover{color:black;}
</style>
<script type="text/javascript">
 (function(i,s,o,g,r,a,m){i['MeanAdsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].g=g,i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//app.meanads.com/static/lib/meanads-sdk.js','ma');
</script>
</head>
<body>


  
	<div class="container-fluid" style="background-color:black;font-size:12pt;margin-left:-1%;margin-right:-10px;margin-top:-10px;font-family:sans serif;">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only" style="color:white;">Toggle navigation</span>
							<span class="icon-bar" ></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<img src="img/logo.jpg">
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="Index.php"> home <span class="sr-only"></span></a></li>
							<li><a href="toolgrid.php"> tool grid <span class="sr-only"></span></a></li>
							<li><a href="blog_front.php">blog<span class="sr-only"></span></a></li>
							<li><a href="aboutus.php">about us<span class="sr-only"></span></a></li>
							<li><a href="contactus.php">contact us<span class="sr-only"></span></a></li>
							<?php if($user_status <> 0){?>
				<span style="font-size: 14px;margin-top: 16px;margin-left: 3px;float: left;">
				 <?php if($fetch_user['type'] == '0'){?>
				 
                <a href="user_profile.php"> <span class="icon-user" style="color:white;"></span><?php echo $fetch_user['first_name'];?></a>
            <?php }else{?>
				 
                <a href="designer_profile.php"><span class="icon-user" style="color:white;"></span><?php echo $fetch_user['first_name'];?></a>
            <?php }?>
            </span></a></li>
              <li><a style="float:left;" href="logout.php">Logout</a>
              
              </li>
              
              <?php }else{?>
              <li><a href="#" data-toggle="modal" data-target="#loginModal">login</a></li>
              <?php }?>						
			 
				</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container-fluid -->
				
				
			</body>
			</html>