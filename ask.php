<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");

$page = "ask";
$this_parent='ask.php';
$item='Project';
$item1='Discussion';
$tab1 = 'discussion';
$tab2 = 'dis_img';
$tab3 = 'user';
$id=$uniqc;
$you ="active";
$yous ="current";
$rand= random_generator(10); 
if(isset($_POST['submitbut']) or ($_SESSION['tittle'] <> '')){
	
	if ($_SESSION['tittle'] <> ''){
		$dvar['design'] = $_SESSION['design'];
	$dvar['tittle'] = $_SESSION['tittle'];
	$dvar['about_img'] = $_SESSION['about_img'];
	$dvar['image_id'] = $_SESSION['image_id'];
	
	$dvar['user_id'] = $id;
		}
	else{
	$dvar['design'] = $_POST['design'];
	$dvar['tittle'] = $_POST['tittle'];
	$dvar['about_img'] = $_POST['about_img'];
	$dvar['image_id'] = $_POST['rand'];
	
	$dvar['user_id'] = $id; 
	}
	
	if($dvar['tittle'] == ''){
		$flag[92] = 'r';
		}
    else if($dvar['about_img'] == ''){
		$flag[31] = 'r';
		}
		else if($user_status <> 1){
			$_SESSION['tittle']= $dvar['tittle'];
			$_SESSION['design']= $dvar['design'];
			$_SESSION['about_img']= $dvar['about_img'];
			$_SESSION['image_id']= $dvar['image_id'];
		header("location:user_login.php?do=login");
	}
			$add_dvar = array('status' => '1', 'time' => time());
			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar );
			
			$sql_gal = "INSERT into $tab1(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tab1"; 
			$fg = 'ad'; 
		 if($user_status <> 0){
			$_SESSION['tittle']= "";
			$_SESSION['design']= "";
			$_SESSION['about_img']= "";
			$_SESSION['image_id']= "";
	
	}
			
		//echo $_FILES[$file_field][name];die;
		if(mysql_query($sql_gal)){
			$flag[$fg] = $item;
			
			
			
		}
		else{
			echo mysql_error();//$flag['q'] = 'r';
		}
	
	}
	
$group="SELECT user.*, user.image as userimg, discussion.*, discussion.id as uid from user left outer join discussion on discussion.user_id = user.uniq_id where user.status ='1' and discussion.status ='1' order by discussion.id DESC";


 //$group="SELECT * FROM $tab3, $tab1, $tab2 WHERE $tab2.uniq = $tab1.image_id AND $tab1.user_id = $tab3.uniq_id GROUP BY $tab2.uniq  ORDER BY $tab1.id DESC";

$sql=mysql_query($group);
 $categ="select * from discussion left outer join user on discussion.user_id = user.uniq_id where discussion.status='1' group by discussion.design" or die(mysql_error());
$cat2=mysql_query($categ);
$design= $_GET['design'];
$delete="delete from comment where user_id=''";
$del=mysql_query($delete);
if(isset($_POST['delete'])){
	$id=$_GET['id'];
	$del="select * from $tab1 where id='".$id."' and status='1'";
	$query_del=mysql_query($del);
	$fetch_del=mysql_fetch_assoc($query_del);
	$sel="select * from $tab2 where uniq='".$fetch_del['image_id']."' and status='1'";
	$query_sel=mysql_query($sel);
	while($fetch_sel=mysql_fetch_assoc($query_sel)){
	$image="uploads/{$fetch_sel['image']}";
	@unlink($image);
}

$sql_del="delete from $tab2 where uniq='".$fetch_del['image_id']."'";
$del_qur = mysql_query($sql_del);
$sql_del1="delete from $tab1 where id='".$id."'";
$del_qur1 = mysql_query($sql_del1);
$sql_del2="delete from likes where image_id='".$id."'";
$del_qur2 = mysql_query($sql_del2);
$sql_del3="delete from comment where image_id='".$id."'";
$del_qur3 = mysql_query($sql_del3);


if($query_del){header("location:ask.php");}
	else{$flag['z'] = $item1;}
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
<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="css/style.css">
<link rel ="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/uploadfile.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<script src="js/jsfunction.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="js/jquery.uploadfile.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
	.front-button:hover{
		color:#fff;
	}
	.usr-img{
		height:50px;
		width: 50px;
		margin-left:20px;
	}
	.top-comment .usr-img{
		height: 30px;
		width: 30px;
	}
	.question-title{
		font-size: 18px;
		color:#d6d3c4;
	}
	.question-content{
		padding:10px;
		margin-left: 40px;
		background:#f8ecde;
	}
	.likes{
		margin-left:50px;
		margin-bottom:10px;
		background:#e8866c;
		color:#fff;"
	}
	.comment{
		background:#f8ecde;
		min-height: 30px;
		margin-bottom: 10px;
	}
	.top-comment{
		margin-left: 20px;
	}
	.question{
		margin-bottom: 10px;
	}
	a.list-group-item{
		background:#f79b2e;
		color:#fff;
	}
	.list-group-item span{
		background:#fff;
		color:#428bca;
	}
	a.list-group-item:hover{
		background:#ed6639;
	}
	a.list-group-item.active,a.list-group-item.active:focus,a.list-group-item.active:hover{
		background:#ed6639;
	}
	.head{ margin-top:-10px !important;}

</style>
<script type="text/javascript">
	$(document).ready(function(){

		$(function(){
			$('#header').data('size','big');
		});
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
		$(window).scroll(function(e){
			var headerHeight = $('#header').height();

			if($(this).scrollTop() > headerHeight){
				if($('#header').data('size') == 'big'){
					$('#header').hide();
					$('#fake-header').slideDown('2000');
					$('#header').data('size','small');
				}
			}
			else{
				if($('#header').data('size') == 'small'){
					$('#fake-header').hide();
					$('#header').slideDown('2000');
					$('#header').data('size','big');
				}
			}
		});
	});
</script>
  <?php if($flag[$fg] <> '' or $flag['d'] <> '' or $flag['d'] <> ''){
?>
<meta http-equiv="refresh" content="1; URL=<?php echo $this_parent;?>">
<?php } ?>
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper" style="background:#ccddee;">
</div>

<!-- ---------------------Header ------------------------------- -->
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
	window.location.reload();
	$('#loginModal').modal('show');
  }
 }
  });
  return false;
 	
}
function submit_form(){
	//alert($('#feedbackform').serialize());
	//exit;
	$.ajax({
   type: "POST",
   data: $('#feedbackform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
 //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(2000);

  }
  if(response_array[0] == 'Success')
  {
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(4000);
   setInterval('hidefeddback()',3000);

  }
 }
  });
  return false;
}
function hidefeddback(){
	$('.feedback').animate({right:'-32.7%'},1000);
	$('.feedback').data('hidden','false');
	$('.blur').remove();
}

function submit_question(){
	//alert($('#questionform').serialize());
	//exit;
	$.ajax({
   type: "POST",
   data: $('#questionform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
 //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
    $("#errormsgs").show();
   $("#errormsgs").html(response_array[1]);
   $("#errormsgs").fadeOut(2000);
  }
  if(response_array[0] == 'Success')
  {
    $("#errormsgs").show();
   $("#errormsgs").html(response_array[1]);
   $("#errormsgs").fadeOut(4000);
    $(location).attr('href','ask.php');

  }
 }
  });
  return false;
}

function feedback_type(feedback_type){
			document.getElementById('feedback_type').value = feedback_type;

}
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

<div id="header" class="container row">
  <div class="col-sm-4"><a href="<?php echo ROOT_URL;?>"><img src="Final_Logo.png" data-src="Final_Logo.png"></a></div>
 <!-- <script type="text/javascript">
		$(document).ready(function(){
			$('#logo img').lazy();
		});
	</script>-->
  <div class="col-sm-8">
    <div id="contacts" class="row" style="width:100%;height:40px;margin:5px;display:block;">
      <div class="pull-right" style="padding:5px;text-align:center;background:#ccc;"> <strong>Contact Us @</strong> <span class="icon-pencil"> reachus@makeuber.com</span>&nbsp;&nbsp;
  
      <span class="icon-phone">+(91) 9900071655</span> </div>
    </div>
    <div id="menu-bar">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-menu"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="collapse navbar-collapse" id="navbar-collapse-menu">
            <ul class="nav navbar-nav">
              <li class="<?php if($page=='index'){ echo 'active';}?>"><a href="<?php echo ROOT_URL;?>">Home</a></li>
              <li class="<?php if($page=='howitworks'){ echo 'active';}?>"><a href="how_it_works">How It Works</a></li>
              <li class="<?php if($page=='experts'){ echo 'active';}?>"><a href="expert">Experts</a></li>
              <li class="<?php if($page=='ask'){ echo 'active';}?>"><a href="ask">Ask</a></li>
              <li class="<?php if($page=='blog'){ echo 'active';}?>"><a href="blog_front">Blog</a></li>
              <?php if($user_status <> 0){?>
              <li class="<?php if($page=='register'){ echo 'active';}?>"> <a href="<?php if($fetch_user['type']=='1'){ echo "designer_profile.php";}else{echo "user_profile.php";
							  }?>">Profile</a></li>
              <li><a style="float:left;" href="logout">Logout</a>
              <span style="font-size: 14px;margin-top: 16px;margin-left: 3px;float: left;">
              <span class="icon-user"></span>
              <?php if($fetch_user['type'] == '0'){?>
                <a href="user_profile.php"><?php echo $fetch_user['first_name'];?></a>
            <?php }else{?>
                <a href="designer_profile"><?php echo $fetch_user['first_name'];?></a>
            <?php }?>
            </span>
              </li>
              
              <?php }else{?>
              <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
              <li class="<?php if($page=='register'){ echo 'active';}?>"><a href="register">Register</a></li>
              <?php }?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>

<!-- --------------------- FAKE HEADER --------------------------- -->
<div id="fake-header" class="container head">
  <div class="row">
    <div class="col-sm-4"><img height="50px" src="Final-Logo.png" data-src="Final-Logo.png"></div>
   <!-- <script type="text/javascript">
			$(document).ready(function(){
				$('#logo img').lazy();
			});
		</script>-->
    <div class="col-sm-8">
      <div id="contacts" class="row" style="width:100%;height:40px;margin:5px;display:block;">
        <div class="pull-right" style="padding:5px;text-align:center;background:#ccc;"> <strong>Contact Us @</strong> <span class="icon-pencil"> reachus@makeuber.com</span>&nbsp;&nbsp; <span class="icon-phone">+(91) 9900071655</span> </div>
      </div>
    </div>
  </div>
  <?php //if($page == 'index'){?>

  <?php //}?>
</div>

<!-- ---------------------MODAL ------------------------------- -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> </button>
        <div class="modal-title">
          <h2>Login</h2>
        </div>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#" onclick="usertype(0)" role="tab" data-toggle="tab">Users</a></li>
          <li><a role="tab" onclick="usertype(1)" data-toggle="tab">Experts</a></li>
        </ul>
        <br>
        <div class="tab-content">
          <form id="loginform" name="login">
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
              <button type="button" onclick="login1()" class="btn btn-success">Sign In</button>
              &nbsp;&nbsp;&nbsp;
              Or connect with <br>
              <br>
             <div id="usersocial"> <a href="fb_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> <!--<a href="twitter_login.php?type=0&path=<?php echo $page;?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</button>
                </a>--> </div>
              <div id="expertsocial" style="display:none"> <a href="fb_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="ex_google_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> </div>
            </div>
          </form>
          <div class="tab-pane fade"></div>
        </div>
      </div>
      <div class="modal-footer">
				<span class="pull-left">Don't have an account? <a href="register">Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>


<!--------------------- MAIN ------------------------ ---->
<div id="main" class="row container" style="margin-top:10px;height:auto;">
	<div class="col-sm-2" style="padding:10px;background:#fff;">
		<h4>Filter By Topic</h4> <br>
		<div class="list-group">
         <?php while ($cat_row2 = mysql_fetch_assoc($cat2)) {
			 $sql_cat_count="select * from discussion where design='".$cat_row2['design']."'";
			 $exec_cat_count = mysql_query($sql_cat_count);
			 $num_cat_count = mysql_num_rows($exec_cat_count);
			  ?>
                   <!-- <li><a href="<?php //echo $_SERVER['PHP_SELF'];?>?design=<?php echo $cat_row2['design']?>"><?php echo $cat_row2['design'];?></a></li>-->
                    
			<a href="<?php echo $_SERVER['PHP_SELF'];?>?design=<?php echo $cat_row2['design']?>" class="list-group-item">
				<span class="badge"><?php echo $num_cat_count;?></span><?php echo $cat_row2['design'];?>
			</a>
             <?php }?>
			
		</div>
	</div>
	<div class="col-sm-9 col-sm-offset-1" style="padding:10px;padding-bottom:30px;background:#2eafb0;color:#fff;">
		<h2>Ask Learn &amp; Share</h2>
        <?php if($user_status==1){?>
		<a class="btn btn-default" data-toggle="modal" data-target="#ask-modal" style="margin:10px;"><i class="fa fa-meh-o"></i> Ask A Question!</a>
        <?php }else{?>
		<a class="btn btn-default" data-toggle="modal" data-target="#loginModal" style="margin:10px;"><i class="fa fa-meh-o"></i> Ask A Question!</a>
        <?php }?>
	</div>
</div>


<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>


<!-- ---------------------  ASK MODAL ----------------------- -->
<div class="modal fade" id="ask-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">	
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Ask A Question</h4>
                        <div align="center" id="errormsgs"></div>

			</div>
			<div class="modal-body">
				<form role="form" id="questionform" class="form-horizontal" style="margin-left:20px;">
					<div class="form-group">
						<label class="col-sm-2 control-label">Category</label>
						<div class="col-sm-10">
							<select class="form-control" name="design">
								<option>Design</option>
								<option>Material</option>
								<option>Others</option>
							</select>
						</div>
					</div>
                    <input type="hidden" name="user_id" value="<?php echo $fetch_user['uniq_id'];?>">
                    <input type="hidden" name="image_id" value="<?php echo $rand;?>">
                    <input type="hidden" name="do" value="question_submit">
                    
					<div class="form-group"><input type="text" style="clear:both;" name="title" class="form-control" placeholder="Example Title : Need help for my kitchen!"></div>
					<div class="form-group"><textarea name="about_img" class="form-control" placeholder="Tell us the details here. Be sure to attach photos, if you have them!" rows="3" cols="50"></textarea></div>
					<div class="form-group">
						Attach Images
					</div>
                     <div id="mulitplefileuploader">Upload</div>
 
                    <div id="status"></div>
                    <br/>
                    <script>
                    
                    $(document).ready(function()
                    {
                    var settings = {
                        url: "upload.php?id=<?php echo $rand;?>",
                        method: "POST",
                        allowedTypes:"jpg,png,gif,doc,pdf,zip,JPEG",
                        fileName: "myfile",
                        multiple: true,
                        onSuccess:function(files,data,xhr)
                        {
                            $("#status").html("<font color='green'>Upload is success</font>");
                            
                        },
                        onError: function(files,status,errMsg)
                        {		
                            $("#status").html("<font color='red'>Upload is Failed</font>");
                        }
                    }
                    $("#mulitplefileuploader").uploadFile(settings);
                    
                    });
                    </script>
                    		<button class="btn btn-success" onclick="submit_question()" type="button">&#63; Ask</button>

				</form>
			</div>
		</div>
	</div>
</div>

<!-- ------------------ POSTS----------------------- -->
<div class="row" style="margin-top:10px;">
	<div class="posts col-sm-9 col-sm-offset-3" style="background:#fff;">
		<h4 style="color:#ee4b3e">Some Popular Questions</h4>
        <div class="form-group">
            <?php if($fetch_user['type']=='1'){?>
            <a href="user_login.php?do=you">
<!--  <div id="mulitplefileuploader">Attach Images</div>
-->  </a>
               <?php }else{?>
<!--              <div id="mulitplefileuploader">Attach Images</div>
-->              <div id="status"></div>
  <?php }?>

</div>
        <?php if($design == ''){
			while($fetch=mysql_fetch_assoc($sql)) {
		  $uniq = $fetch['image_id'];
		  $sql1="select * from dis_img where uniq ='".$uniq."' limit 1";
		  $query=mysql_query($sql1);
		  $fetch1=mysql_fetch_assoc($query);
		
		 
		//i have liked this image or not
		$sql_like = "select * from likes where image_id='".$fetch['uid']."' and status='1' and uc='1'";
		$exec_like = mysql_query($sql_like);
		$num_likes = mysql_num_rows($exec_like);
		
		$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$fetch['uid']."' and comment.status='1' and comment.uc='1' order by comment.id DESC";
		$exec_comment = mysql_query($sql_comment);
		$num_comment = mysql_num_rows($exec_comment);

		  ?>
              <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$fetch['uid'];?>" method="post" enctype="multipart/form-data">

		<div class="question row">
			<div class="col-sm-1"> <a class="fixed_width" href="discussion.php?id=<?php echo $fetch['uid'];?>"><?php if(empty($fetch1['image'])){
	echo "<img class='usr-img' src='img/no_img.jpg' height='160' width='160'/>";
	}else{
	      echo "<img class='usr-img' src='uploads/".$fetch1['image']."' height='160' max-width='160'/>"; 
		 
		  }?></a></div><div class="col-sm-11" style="background:#828e8c;color:#fff;"><a class="ablink" href="discussion.php?id=<?php echo $fetch['uid'];?>"><span class="question-title"><?php echo $fetch['tittle'];?></span></a><br>--<span style="font-size:14px;"><?php echo date("d/m/Y",$fetch['time']);?> By <?php echo $fetch['username'];?> (<a href="discussion.php?id=<?php echo $fetch['uid'];?>"><span style="color:#fff;"><?php echo $fetch['design'];?></span></a>)  <?php if ($fetch['uniq_id']== $user_uniq) {?>
       <input type="submit" class="btn-danger" value="Delete" name="delete">
               <?php } ?></span></div>
			<div class="question-content col-sm-12"> <?php echo $fetch['about_img'];?></div>
			<div class="likes col-sm-12"><a href="discussion.php?id=<?php echo $fetch['uid'];?>"><span style="color:#fff"><i class="fa fa-thumbs-up"></i></span><span class="like" style="color:#fff;"> <?php echo $num_likes;?> </span></a><a href="discussion.php?id=<?php echo $fetch['uid'];?>"><i class="fa fa-comments" style="color:#fff"></i><span class="comments" style="color:#fff"> <?php echo $num_comment;?> </span></a></div>
              <?php
$j=0;
	while($num_comment = mysql_fetch_assoc($exec_comment)){
		if($j<1){
		  ?>
			<div class="top-comment row col-sm-12">
				<div class="col-sm-1"><img src="<?php if($num_comment['img'] <> ''){echo 'img/'.$num_comment['img'];}else{ echo 'img/no_img.jpg';}?>" class="usr-img"></div><div class="comment col-sm-10">
					<?php echo $num_comment['first_name']. " ".$num_comment['last_name'];?>: <?php echo $num_comment['comments'];?>
				</div>
			</div>
             <?php } $j++;}?>
		</div>
        </form>
		
        <?php } }else{
			
			 // $group="SELECT $tab3.*, $tab3.image as userimg, $tab1.*, $tab1.id as uid, $tab2.*, $tab2.id as im_id from $tab3 left outer join $tab1 on $tab1.user_id = $tab3.uniq_id left outer join $tab2 on $tab2.uniq = $tab1.image_id where $tab1.design ='".$design."' and $tab3.status ='1' and $tab2.status ='1' GROUP BY $tab2.uniq ORDER BY $tab1.id DESC";
 $group="SELECT user.*, user.image as userimg, discussion.*, discussion.id as uid from user left outer join discussion on discussion.user_id = user.uniq_id where discussion.design ='".$design."' and  user.status ='1' and discussion.status ='1' order by discussion.id DESC";

$sql=mysql_query($group);
   while($fetch=mysql_fetch_assoc($sql)) {?>
  <?php
    $uniq = $fetch['image_id'];
  $sql1="select * from dis_img where uniq ='".$uniq."' limit 1";
  $query=mysql_query($sql1);
  $fetch1=mysql_fetch_assoc($query);
		//i have liked this image or not
$sql_like = "select * from likes where image_id='".$fetch['uid']."' and status='1' and uc='1'";
$exec_like = mysql_query($sql_like);
$num_likes = mysql_num_rows($exec_like);

$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$fetch['uid']."' and comment.status='1' and comment.uc='1' order by comment.id DESC";
$exec_comment = mysql_query($sql_comment);
$num_comment = mysql_num_rows($exec_comment);
			?>
           <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$fetch['uid'];?>" method="post" enctype="multipart/form-data">
			<div class="question row">
			<div class="col-sm-1"> <a class="fixed_width" href="discussion.php?id=<?php echo $fetch['uid'];?>"><?php if(empty($fetch1['image'])){
	echo "<img class='usr-img' src='img/no_img.jpg' height='160' width='160'/>";
	}else{
	      echo "<img class='usr-img' src='uploads/".$fetch1['image']."' height='160' max-width='160'/>"; 
		 
		  }?></a></div><div class="col-sm-11" style="background:#828e8c;color:#fff;"><a class="ablink" href="discussion.php?id=<?php echo $fetch['uid'];?>"><span class="question-title"><?php echo $fetch['tittle'];?></span></a><br>--<span style="font-size:14px;"><?php echo date("d/m/Y",$fetch['time']);?> By <?php echo $fetch['username'];?> (<a href="discussion.php?id=<?php echo $fetch['uid'];?>"><span style="color:#fff;"><?php echo $fetch['design'];?></span></a>)  <?php if ($fetch['uniq_id']== $user_uniq) {?>
       <input type="submit" class="edit_btn delete_btn" value="Delete" name="delete">
               <?php } ?></span></div>
			<div class="question-content col-sm-12"> <?php echo $fetch['about_img'];?></div>
			<div class="likes col-sm-12"><a href="discussion.php?id=<?php echo $fetch['uid'];?>"><span style="color:#fff"><i class="fa fa-thumbs-up"></i></span><span class="like" style="color:#fff;"> <?php echo $num_likes;?> </span></a><a href="discussion.php?id=<?php echo $fetch['uid'];?>"><i class="fa fa-comments" style="color:#fff"></i><span class="comments" style="color:#fff"> <?php echo $num_comment;?> </span></a></div>
              <?php
$j=0;
	while($num_comment = mysql_fetch_assoc($exec_comment)){
		if($j<1){
		  ?>
			<div class="top-comment row col-sm-12">
				<div class="col-sm-1"><img src="<?php if($num_comment['img'] <> ''){echo 'img/'.$num_comment['img'];}else{ echo 'img/no_img.jpg';}?>" class="usr-img"></div><div class="comment col-sm-10">
					<?php echo $num_comment['firstAs_name']. " ".$num_comment['last_name'];?>: <?php echo $num_comment['comments'];?>
				</div>
			</div>
             <?php } $j++;}?>
		</div>  
        </form>     
         <?php }}?>
	</div>
</div> 

<?php include "include/footer.php";?>

</body>
</html>