<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");

 $sql_gallary = "select * from  content where id='4'";
$exec_gallery = mysql_query($sql_gallary);
$your_project ="active";

/*$tabl = 'user';
$item = 'User';
if($user_status <> 1){
		header("location:index.php");
	}
 $category="Select * from $tabl where uniq_id='$uniqc'" or die(mysql_error());
$select=mysql_query($category);	
$row_cat = mysql_fetch_assoc($select);*/
$tabl = 'user';
$tab2 = 'project';
$tab3 = 'pro_img';
$item = 'User';
$item2 = 'Project';
$namep = $_SERVER['PHP_SELF'];

 $user="Select * from $tabl where uniq_id='$uniqc'" or die(mysql_error());
$select=mysql_query($user);	
$row_cat = mysql_fetch_assoc($select);

//$group="select $tab2.*, category.category_name from $tab2 left outer join category on $tab2.category=category.id where $tab2.user_id='".$fetch_user['uniq_id']."' group by category and category.status='1'";	
 $group="select * from $tab2 where user_id='".$fetch_user['uniq_id']."' group by category";
$raw_group=mysql_query($group);


if($_GET['do']=='delete'){
	$id=$_GET['id'];
	
	$sql2="select * from project where id='$id'";
	$exe2=mysql_query($sql2);
	$fetch_exe2=mysql_fetch_assoc($exe2);
	$sql="select * from pro_img where uniq='".$fetch_exe2['project_id']."'";
	$exe=mysql_query($sql);
	while($fetch_img=mysql_fetch_assoc($exe)){
		unlink('./img/'.$fetch_img['image']);
				}
				
	
		unlink('./img/'.$fetch_exe2['project_image']);
		unlink('./img/'.$fetch_exe2['floor_plan']);
		
							
		//delete from database
		 $sql_img_del="delete from project_images where images_id='".$id."'";
		 $sql_pro_del="delete from project where id='".$id."'";
		
		if(mysql_query($sql_pro_del) & mysql_query($sql_img_del)){
		$flag['d'] = $item2;
	}
	else{
		$flag['q'] = 'r';
	}
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $site_name; ?></title>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="./cssp/font-awesome.min.css">
 <?php    if($flag['d'] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $_SERVER['PHP_SELF'];?>">
<?php } ?>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<style>
.footer-menu li a:hover{color:white; text-decoration:none;}
</style>
</head>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">
<?php include "./include/header.php" ?> 
		<!.........................HEADER ENDS ................................> 

<!-- ---------------------Main ------------------------------- -->

<!-- -----------------------Blogs ----------------- -->

<div id="blog-contri" class="row content-page" style="padding-left:80px;">
	
	<p class="text-left" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300; margin-left:4%">My Profile</p>
     <?php
	 while ($cat_group = mysql_fetch_assoc($raw_group)){ 
	 
	 $sql_cat = "select * from category where id='".$cat_group['category']."'";
	 $exec_cat = mysql_query($sql_cat);
	 $fetch_cat = mysql_fetch_assoc($exec_cat);
	 echo "<h3>".$fetch_cat['category_name']."</h3>"; 
		  ?>
     
    <?php
	$category="Select * from $tab2 where category='".$cat_group['category']."' and user_id='".$fetch_user['uniq_id']."'";
 	$selected=mysql_query($category);
	$count=mysql_num_rows($category);
	
	while ($row_gory = mysql_fetch_assoc($selected)){
		  ?>
	<div class="row">
    
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" >

		<div class="panel panel-primary col-sm-10" style="margin-left:5%; margin-right:10%">
			<div class="panel-body">
            <div class="col-sm-6">
            <a class="text-center" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;" href="view_project.php?id=<?php echo $row_gory['id'];?>"><h1><?php echo $row_gory['project_name'];?> </h1></a>
            <?php   $pro_img = "select * from $tab3 where uniq ='".$row_gory['project_id']."'";
$pro_query = mysql_query($pro_img);
while($pro_fetch=mysql_fetch_assoc($pro_query))
{
	
?>
 <img class="image_sizes" src="./img/<?php if(empty($pro_fetch['image'])){ echo 'no_img.jpg'; }else{ echo $pro_fetch['image'];}?>"  width="40%" height="220px"/>
</a>
<?php }?>
<h3>Floor Plan</h3><div class="clearfix"></div>
<div  class="desof_pro"><img class="floor_plan" src="./img/<?php if(empty($row_gory['floor_plan'])){
	echo "no_img.jpg";
	}else{ echo $row_gory['floor_plan'];}?>"  width="40%" height="220px"/>
   <div class="clear"></div>
     </div >
</div>

		<div class="col-sm-5" style="margin-top:10%; margin-left:1%; line-height:30px;">
<?php $sql_comment = "SELECT category.*,sub_categories.*,material.* from user_selection left outer join category on category.id = user_selection.category left outer join sub_categories on sub_categories.id = user_selection.design left outer join material on material.id = user_selection.material where user_selection.project_id='".$row_gory['project_id']."'";
			$exec_comment = mysql_query($sql_comment); 
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){ ?>
			 <span class="lead">&nbsp;</span>
               <span class="text-info"><?php echo $fetch_comment['category_name'];?>&nbsp;>>&nbsp;<?php echo $fetch_comment['name'];?>&nbsp;>>&nbsp;<?php echo $fetch_comment['material'];?></span><br/>
               <span class="text-justify"> <?php echo substr($row_gory['description'],0,500);?> Learn More....</span><br/>
               <span class="text-justify"><strong>City:</strong> <?php echo $row_gory['city'];?></span><br/>
               <span class="text-justify"><strong>Area:</strong> <?php echo $row_gory['area'];?></span><br/>
               <span class="text-justify"><strong>Price:</strong> <?php echo $row_gory['price'];?></span><br/>
               <span class="text-justify"><strong>Type : </strong> <?php echo $row_gory ['apartment'];?> </span><br/>
               <span class="text-justify"><strong>Email :</strong> <?php echo $row_gory ['email'];?> </span><br/>    
			    <span class="text-justify"><strong>Phone </strong> <?php echo $row_gory ['phone'];?> </span><br/>
              <div class="clear"></div>
              <?php }?>
        
        </div>
				
                <a class="btn btn-success btn-lg col-sm-offset-2 pull-right" href="<?php echo $namep.'?do=delete&id='.$row_gory['id'].''; ?>" value="Delete" name="delete" onclick="return archive_fun();">Delete</a>
			</div>
		</div>
		</form>
	</div>
    <?php }}?>
	
	<br><br><br><br>
</div>
<hr>



<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<?php include "./include/footer.php";?>

</body>
</html>