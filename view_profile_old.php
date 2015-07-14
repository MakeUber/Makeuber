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
    <title><?php echo $site_name; ?></title>
    <meta charset="utf-8">   
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("include/head.php"); ?>
    <script type="text/javascript">
    function archive_fun()
{
 if(confirm("Are you sure you want to delete this Project"))
 {
  return true;
 }
 else
 {
  return false; 
 }  
}
    </script>
</head>

<body>
<!--==============================header=================================-->

<?php include "include/header.php"; ?>
<div id="content">
  
  
  <div class="container withcolor_bg">
    <div class="row block-3">
     
     <div class="clear"></div>
     <?php echo print_messages($flag, $error_message, $success_message); ?> 
     
    
    <?php
	$category="Select * from $tab2 where user_id='".$id."'" or die(mysql_error());
 	$selected=mysql_query($category);
	
	while ($row_gory = mysql_fetch_assoc($selected)){
		  ?>
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" enctype="multipart/form-data" >
    
     <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 morewidth gray_col" style="height:520px;" >
      <div id="vlightbox1">
<a class="vlightbox1" href="view_project.php?id=<?php echo $row_gory['id'];?>"><span class="image_title"><?php echo $row_gory['project_name'];?> </span><img class="image_sizes" src="img/<?php echo $row_gory['project_image'];?>"/>
<!--<span class="image_title">Comments: </span>--></a>
<div class="clear"></div>
</div>

<div class="clear"></div>
<div class="image_title image_descri" style="float:right">
<div class="clear"></div>
<span class="desof_pro"> <?php echo substr($row_gory['description'],0,120);?><a href="view_pro_image.php?id=<?php echo $row_gory['id'];?>"> Learn More....</a></span>
<div class="clear"></div>
<span class="lead"><a class="edit_btn add_project" style="color:#3CF;float: right;" href="view_project.php?id=<?php echo $row_gory['id'];?>">View Images</a></span>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
</form>
<?php } ?>
<div class="clear"></div>

</div>
    </div>
  </div>     
</div>  
<?php include "include/footer.php"; ?>
</body>
</html>