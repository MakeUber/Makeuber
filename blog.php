<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$page ="blog";

$tabl='blog';
$item='Comment';
$tab2='blog_category';
$tab3='blog_comment';
$title= $_GET['title'];
/*************************************Start Main query to fetch blogs*********************************************/
$sql_gallary = "select * from  $tabl where status='1' and (title LIKE '%$title%' OR description LIKE '%$title%')";

if($_GET['category'] <> ''){
	$sql_gallary .=" and category = ".$_GET['category'];
}
if($_GET['id'] <> ''){
	$sql_gallary .=" and id = ".$_GET['id'];
}
$sql_gallary .=" order by id DESC";
$exec_gallery = mysql_query($sql_gallary);
$row_gallery = mysql_num_rows($exec_gallery);
/*************************************End Main query to fetch blogs*********************************************/
/*************************************Start Query for fetch recent blogs*********************************************/

$sql_recent = "select * from  $tabl where status='1' order by id DESC";
$exec_recent= mysql_query($sql_recent);
/*************************************End Query for fetch recent blogs*********************************************/
/*************************************Start Query for fetch categories *********************************************/
$sql_cat = "select * from  $tab2 where status='1'";
$exec_cat = mysql_query($sql_cat);
/*************************************End Query for fetch categories *********************************************/

/*************************************Start Login user Comment*********************************************/
if(isset($_POST['comments'])){
	$dvar['comment'] = $_POST['comment'];
	$dvar['name'] = $_POST['name'];
	$dvar['blog'] = $_GET['id'];
	if($dvar['comment'] == ''){$flag[70] = 'r';}
	else if($user_status<>'1'){$flag[67] = 'r';}	
	else{
			$uniq = random_generator(10);
			$add_dvar = array( 'status' => '1', 'time' => time());
		
			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
		
			 $sql = "INSERT into $tab3(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tab3"; 
			$fg = 'ad';
		}
		if(mysql_query($sql)){
			$flag[$fg] = $item;
			};
	}
/*************************************End Login user Comment*********************************************/
if($_GET['id'] <> ''){
	
	//view for user login part
$ip = $_SERVER['REMOTE_ADDR'];
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//check View is available or not if it is not available then it will add this Section
//$prevtime= time()-4600*12;
$sql_view="select * from blog_views where ip='$ip' and url='$url' and time > '$prevtime' and time < '".time()."'";
$exec_view = mysql_query($sql_view);
$num_view = mysql_num_rows($exec_view);
if($num_view >0){
}
else{
 //check View is available or not
 $sql_view1 = "select * from blog_views where ip='$ip' and url='$url'";
 $exec_view1 = mysql_query($sql_view1);
 if(mysql_num_rows($exec_view1) > 0){
  $sql_views = "select * from blog_views where ip='$ip' and url='$url' and time < '$prevtime'";
  $exec_views = mysql_query($sql_views);
  $num_views = mysql_num_rows($exec_views);
  if($num_views >0){
   $fetch = mysql_fetch_assoc($exec_views);
   $sql= "update blog_views set time='".time()."' where id='".$fetch['id']."'";
   $exec = mysql_query($sql);
   if($exec){
   $sql_update = "update blog set counter = counter +1 where id='".$_GET['id']."'"; 
   mysql_query($sql_update);
   }
  }
 }
 else{
  $sql_insert = "insert into blog_views(sort,ip,url,status,time) select max(sort)+1, '$ip','$url',1,'".time()."' from blog_views"; 
  if(mysql_query($sql_insert)){
   $sql_update = "update blog set counter = counter +1 where id='".$_GET['id']."'"; 
   mysql_query($sql_update);
  }
 }
}

	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<link rel ="stylesheet" href="./css/bootstrap.min.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="./css/font-awesome.min.css">
<script src = "./js/jquery.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<script language="javascript">
$(document).ready(function(){
	$('.feedback').data('hidden','false');
	$('#icon a').on('click',function(e){
		e.preventDefault();
		if($('.feedback').data('hidden')=='false'){
			$('.feedback').animate({right:'0%'},1000);
			$('.feedback').data('hidden','true');
			$('body').append($('<div class="blur"></div>'));
		}
		else{
			$('.feedback').animate({right:'-32.7%'},1000);
			$('.feedback').data('hidden','false');
			$('.blur').remove();
		}
	});
	$('#feed-close').on('click',function(e){
		e.preventDefault();
		if($('.feedback').data('hidden')=='true'){
			$('.feedback').animate({right:'-32.7%'},1000);
			$('.feedback').data('hidden','false');
			$('.blur').remove();
		}
	});
});
</script>
<style type="text/css">
	#wrapper{
		background: url('Background/bckg_7.jpg');
		background-size: cover;
		-webkit-filter:blur(3px);
		-moz-filter:blur(3px);
		-o-filter:blur(3px);
		-ms-filter:blur(3px);
		filter: url(blur.svg#blur);
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

</style>

	<script language="javascript">
function login1(){
	//alert("hi");
	
	//alert($('#loginform').serialize());
	$.ajax({
   type: "POST",
   data: $('#loginform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
   //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')	
  {
  //alert(response_array[2]);
    $("#errormsg").show();
   $("#errormsg").html(response_array[1]);
   $("#errormsg").fadeOut(2000);
  }
  if(response_array[0] == 'Success')
  {
   $("#errormsg").html(response_array[1]);
   //////////////////////////it is used to check the person has click on share requirements//////////////////////
   //alert($('#sharetxt').val());
   var data = $('#sharetxt').val();
  // alert(response_array[2]);
  // break;
  	 if(data=='share'){
		    $(location).attr('href','Index.php');
			
	   }
	   else{
		     if(response_array[2] == '1'){
	   		//alert($('#budget').val());
	   
			//if($('#budget').val() != '' && $('#budget').val() !== undefined){
			//alert("got");//
			//$("#projectform").submit();
			//}else{
			$(location).attr('href','designer_profile.php');
			//}
		}else{
			$(location).attr('href',window.location.href); 
			//salert($('#budget').val());
			//if($('#budget').val() != '' || $('#budget').val() !== undefined){
				//alert("hi");
				//$("#projectform").submit();
			//}else{
				//alert("bye");
				//alert(window.location.reload());
				$(location).attr('href','user_profile.php'); 
			//}
   }
	   }
	/////////////////////////////////////else portion//////////////////////////////////////
  }
 }
  });
  return false;
 	
}
</script> 
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>

</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>

<?php include "include/header.php";?>
<!-- ---------------------MAIN ------------------------------- -->

  <?php
if ($row_gallery > 0){
	$i=1;
 while($fetch_blog=mysql_fetch_assoc($exec_gallery)){ ?>
<div id="main" class="row container" style="padding:10px;height:auto; overflow:hidden">
 <?php if($i==1){?>
	<div class="col-sm-3 col-sm-push-9" id="blog-ref" style="background:#e8866c;color:#fff;height:auto;padding:10px;">
	  <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" enctype="multipart/form-data">
        <div class="input-group">
			<input type="text" class="form-control" name="title" placeholder = "Search">
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
			<input type="hidden" name="submit">
		</div>
       </form>
		<div>
			<h4>Browse by Category</h4>
			 <?php while($fetch_cat= mysql_fetch_assoc($exec_cat )){?>
			<a href="blog.php?category=<?php echo $fetch_cat['id']?>"><?php echo $fetch_cat['category_name'] ?></a> |

			<?php }?>
		</div>
		<div>
			<h4>Recent Posts</h4>
			  <?php 
$j=1;
while($recent_blog= mysql_fetch_assoc($exec_recent)){
	if($j<6){?>
<a href="blog.php?id=<?php echo $recent_blog['id']?>"><?php echo $recent_blog['title'] ?></a><br/>
<?php }$j++;} ?>
		</div>
	</div>
    <?php }else{?>
	<div class="col-sm-3 col-sm-push-9" id="blog-ref" style="color:#fff;height:auto;padding:10px;">
	</div>
    <?php }?>
	<div class="col-sm-8 col-sm-pull-2" style="background:#fff;height:auto; right:18%">
		<a href="blog.php?id=<?php echo $fetch_blog['id']?>"><h2 style="color:#de5842;"><?php echo $fetch_blog['title'];?></h2></a>
		<p style="color:#fcd059;"><b>&nbsp;&nbsp;-- Posted by : <?php echo $fetch_blog['name'];?>,
         <?php
/*************************************Start Query for fetch categories Name*********************************************/				
$sql_catss = "select * from $tab2 where id='".$fetch_blog['category']."' and status = '1'";
$exec_catss = mysql_query($sql_catss);
$fetch_catss=mysql_fetch_assoc($exec_catss);
/*************************************End Query for fetch categories Name*********************************************/
				  ?>
           Category :  <?php echo $fetch_catss['category_name'];?></b>
            <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style"> <a class="addthis_counter addthis_pill_style"></a> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> </div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script> 
                <!-- AddThis Button END -->  
           </p>

		<p><?php echo $fetch_blog['description'];?></p>

		
	</div>
    <div style="width:100%;height:auto;">
	<div class="user-comments row"></div>
	<?php
/***********************************Fetch Comments*******************************************/
 if ($_GET['view']<>''){
?>
<a href="" style="width:160px;height:44px;font-size:18px;text-decoration:none;margin:20px;margin-left:120px;"> </a>
	<div class="comment-box row">
		<div class="usr-img col-sm-1"><img src="" height="50px" width="50px"></div>
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $fetch_blog['id'];?>" method="post" enctype="multipart/form-data">

		<div class="comment-data col-sm-10"><textarea class="form-control" cols="50" rows="3" name="comment" placeholder="Write Your Comment Here" style="margin-bottom:10px;" ><?php echo $dvar['comment'];?></textarea></div>
        <input type="hidden" name="name" value="<?php echo $fetch_user['first_name'];?>  <?php echo $fetch_user['last_name'];?>">
		
		<input type="submit" style="width:120px;height:34px;font-size:12px; margin-top:20px; border:none;text-decoration:none;margin-left:128px;" class="front-button fa fa-comment-o"  value="Submit" name="comments">

        </form>
	</div>
    <?php }
	if($_GET['view'] ==''){?>
	<a href="blog.php?id=<?php echo $fetch_blog['id']?>&view=comment" class="front-button" style="width:160px;height:44px;font-size:18px;text-decoration:none;margin:20px;margin-left:120px;"><i class="fa fa-comment-o"></i> Post Comment</a>
    <?php 
	}
	$sql_comment="select * from $tab3 where blog='".$fetch_blog['id']."' and status='1'";
	$comment_fetch=mysql_query($sql_comment);
	$comment_row=mysql_num_rows($comment_fetch);
	while($fetch_comment=mysql_fetch_assoc($comment_fetch)){
	?>

	<div class="user-comments row">
		<div class="usr-img col-sm-1"><img src="" height="50px" width="50px"></div>
		<div class="comment-data col-sm-10"> <?php echo $fetch_comment['comment'];?><b> by </b><?php echo $fetch_comment['name'];?><b> on </b><?php $time=(date("d-m-Y",$fetch_comment['time']));
				echo $time;?></div>
	</div>
    <?php }?>
</div>
<div class="clearfix"></div>

</div>
</div>


<?php $i++;}}else{?>
	<div id="main" class="row container" style="padding:10px;height:auto; overflow:hidden">
	<div class="col-sm-3 col-sm-push-9" id="blog-ref" style="background:#e8866c;color:#fff;height:auto;padding:10px;">
	  <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" enctype="multipart/form-data">
        <div class="input-group">
			<input type="text" class="form-control" name="title" placeholder = "Search">
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
			<input type="hidden" name="submit">
		</div>
       </form>
		<div>
			<h4>Browse by Category</h4>
			 <?php while($fetch_cat= mysql_fetch_assoc($exec_cat )){?>
			<a href="blog.php?category=<?php echo $fetch_cat['id']?>"><?php echo $fetch_cat['category_name'] ?></a> |
			<?php }?>
		</div>
		<div>
			<h4>Recent Posts</h4>
			  <?php 
$j=1;
while($recent_blog= mysql_fetch_assoc($exec_recent)){
	if($j<6){?>
<a href="blog.php?id=<?php echo $recent_blog['id']?>"><?php echo $recent_blog['title'] ?></a><br/>
<?php }$j++;} ?>
		</div>
	</div>
	<div class="col-sm-7 col-sm-pull-2" style="background:#fff;height:auto; min-height:250px;">
    <h2 align="center">No Blog Found</h2>
    </div>
    </div>
<?php }?>




<!---------------------------MODAL ----------------- -->

				<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> </button>
        <div class="modal-title">
          <h2 style="color:black;">Login</h2>
        </div>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#" onclick="usertype(0)" role="tab" data-toggle="tab" style="color:black; font-size:15px;">Users</a></li>
          <li><a role="tab" onclick="usertype(1)" data-toggle="tab" style="color:black; font-size:15px;">Experts</a></li>
        </ul>
        <br>
        <div class="tab-content">
          <form id="loginform" name="login">
          <input type="hidden" id="sharetxt" name="share" value="" />
            <div class="tab-pane fade in active">
              <div align="center" id="errormsg"></div>
              <div class="input-group input-modal"> <span class="input-group-addon icon-user"></span>
                <input type="text" id="username" name="username" class="form-control" required placeholder="Username">
                <input type="hidden" id="usertype" name="type" value="0" />
                <input type="hidden" name="do" value="login" />
              </div>
              <br>
              <div class="input-group input-modal"> <span class="input-group-addon icon-lock"></span>
                <input type="password" name="password" class="form-control" required placeholder="Password">
              </div>
              <br>
              <button type="button" onclick="login1();" class="btn btn-success">Sign In</button>
              &nbsp;&nbsp;&nbsp;
<span style="font-size:15px;color:black;"> Or connect with </span><br>
              <br>
             <div id="usersocial"> <a href="fb_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a><!-- <a href="twitter_login.php?type=0&path=<?php echo $page;?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</button>
                </a>--> </div>
              <div id="expertsocial" style="display:none"> <a href="fb_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> </div>
            </div>
          </form>
          <div class="tab-pane fade"></div>
        </div>
      </div>
      <div class="modal-footer">
				<span class="pull-left" style="font-size:15px;color:black;">Don't have an account? <a href="Register.php" style="color:blue;" >Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>


<!----------------------------FOOTER------------------- -->
<?php include "include/footer.php";?>

</body>
</html>