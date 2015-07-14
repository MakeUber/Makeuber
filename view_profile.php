<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tabl = 'user';
$tab2 = 'project';
$id=$_GET['id'];

 $user="Select * from $tabl where uniq_id='$id'" or die(mysql_error());
$select=mysql_query($user);	


//$group="select $tab2.*, category.category_name from $tab2 left outer join category on $tab2.category=category.id where $tab2.user_id='".$fetch_user['uniq_id']."' group by category and category.status='1'";	
$group="select * from $tab2 where user_id='".$id."' group by category order by sort ASC" or die(mysql_error());
$raw_group=mysql_query($group);

$cat_group = mysql_fetch_assoc($raw_group);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<?php include "include/head.php";?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
			<link rel="stylesheet" href="/Muber\css/custom.css">
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>
<?php include "include/header.php";?>
<!-- ---------------------Main ------------------------------- -->

<!-- -----------------------Blogs ----------------- -->

<div id="blog-contri" class="row content-page" style="padding-left:80px;">
	
	<p class="text-center" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;">View Profile</p>
	<p style="font-size:20px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;">Follow Our Insightful Blogs Written By Our Experts</p><br>
	<div class="row">
    <?php 
	$i=1;
	$category="Select * from $tab2 where user_id='".$id."'" or die(mysql_error());
 	$selected=mysql_query($category);
	
	while ($row_gory = mysql_fetch_assoc($selected)){
		  ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" enctype="multipart/form-data" >

		<div class="panel panel-primary col-sm-3" style="margin-right:8%">
			<div class="panel-body">
            <a class="text-center" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;" href="view_project.php?id=<?php echo $row_gory['id'];?>"><h1><?php echo $row_gory['project_name'];?> </h1>
            <img class="image_sizes" src="img/<?php echo $row_gory['project_image'];?>"  width="100%" height="220px"/>
</a>
				<blockquote>
	  				<p><?php echo substr($row_gory['description'],0,120);?><a href="view_pro_image.php?id=<?php echo $row_gory['id'];?>"> Learn More....</a></p>
	  				
				</blockquote>
				<p><?php echo substr($fetch_blog['description'],0,300);?>
				</p>
                <a class="btn btn-success btn-lg col-sm-offset-2 pull-right" href="view_project.php?id=<?php echo $row_gory['id'];?>">View Images</a>
			</div>
		</div>
		</form>
        <?php $i++; }?>
	</div>
	
	<br><br><br><br>
</div>
<hr>



<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<?php include "include/footer.php";?>

</body>
</html>