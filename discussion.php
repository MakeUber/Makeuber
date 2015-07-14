<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tab1 = 'discussion';
$tab2 = 'dis_img';
$tab3 = 'user';
//echo $id;
$id= $_GET['id'];
 $group="SELECT $tab3.*, $tab3.image as userimg, $tab1.* from $tab3 left outer join $tab1 on $tab1.user_id = $tab3.uniq_id where $tab1.id = '".$id."' and $tab3.status ='1'  ORDER BY $tab1.id DESC";
$sql=mysql_query($group);
$sql1 = mysql_query($group);
$fetchr=mysql_fetch_assoc($sql);


$ip = $_SERVER['REMOTE_ADDR'];
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//check View is available or not if it is not available then it will add this Section
$prevtime= time()-3600*12;
 $sql_view="select * from views where ip='$ip' and url='$url' and time > '$prevtime' and time < '".time()."'";
$exec_view = mysql_query($sql_view);
$num_view = mysql_num_rows($exec_view);
if($num_view >0){
}
else{
 //check View is available or not
 $sql_view1 = "select * from views where ip='$ip' and url='$url'";
 $exec_view1 = mysql_query($sql_view1);
 if(mysql_num_rows($exec_view1) > 0){
  $sql_views = "select * from views where ip='$ip' and url='$url' and time < '$prevtime'";
  $exec_views = mysql_query($sql_views);
  $num_views = mysql_num_rows($exec_views);
  if($num_views >0){
   $fetch = mysql_fetch_assoc($exec_views);
   $sql= "update views set time='".time()."' where id='".$id."'";
   $exec = mysql_query($sql);
   if($exec){
   $sql_update = "update tutorial set counter = counter +1 where uniq='tutorail_id'"; 
   mysql_query($sql_update);
   }
  }
 }
 else{
  $sql_insert = "insert into views(sort,ip,url,status,time) select max(sort)+1, '$ip','$url',1,'".time()."' from views"; 
  
 }
}

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
<link rel ="stylesheet" href="./css/bootstrap.min.css">
<link rel ="stylesheet" href="./css/Style.css">
<script src = "./js/jquery.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src="./js/jsfunction.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
	  
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
	<style> 
	a { color:#337ab7; } 
	</style>
		
</head>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>
<?php include "include/header.php";?>
<!-- ---------------------Main ------------------------------- -->

<!-- -----------------------Blogs ----------------- -->

<div id="blog-contri" class="row content-page" style="padding-left:80px;">
	
	<p class="text-left" style="font-size:25px;font-family:sans-serif;color:#000; margin-left:4%">See Discussion</p>

        
         <div class="row">
		<div class="panel panel-primary col-sm-10" style="margin-left:5%; margin-right:10%; min-height:450px;border-color:#CDCDCD;">
			<div class="panel-body">
            <div class="col-sm-4">
            <h5 align="center"><?php echo $fetchr['first_name'];?>&nbsp;<?php echo $fetchr['last_name'];?> </h5>
            <?php
$select="select * from $tab2 where uniq='".$fetchr['image_id']."' ";
$sql2=mysql_query($select);
$num= mysql_num_rows($sql2);
$fetchs=mysql_fetch_assoc($sql2)
?>           
<div align="center">
 <img align="middle" class="image_sizes" src="<?php if(empty($fetchs['image'])){ echo 'img/no_img.jpg'; }else{ echo 'uploads/'.$fetchs['image'];}?>"  width="70%" height="200px"/>
 </div>
</div>

	     <?php
	
	 $row_gory = mysql_fetch_assoc($sql1);
		//i have liked this image or not
		//i have liked this image or not
$sql_like = "select * from likes where image_id='".$id."' and status='1'";
$exec_like = mysql_query($sql_like);
$num_likes = mysql_num_rows($exec_like);

$sql_likes = "select * from likes where image_id='".$row_gory['id']."' and status='1'  and uc='0' and user_id='".$fetch_user['uniq_id']."'";
$exec_likes = mysql_query($sql_likes);
$num_like = mysql_num_rows($exec_likes);

$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img, user.uniq_id as usid from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$id."' and comment.status='1' and comment.uc='1'  order by comment.id DESC";
$exec_comment = mysql_query($sql_comment);
$num_comment = mysql_num_rows($exec_comment);
		  ?>
		<div class="col-sm-7" style="margin-top:0%; margin-left:3%;font-family:sans-serif;">
                  <?php echo print_messages($flag, $error_message, $success_message);?>
			 <span class="lead">&nbsp;</span>
                         <h3><?php echo $fetchr['tittle'];?> </h3>

               <span class="text-left"><?php echo substr($fetchr['about_img'],0,200);?></span><br/><br>
               <span class="text-primary"><img src="./img/images.png" height="18" width="18">&nbsp;<span id="cmt<?php echo $id;?>"><?php echo $num_comment;?></span><span class="like_comm">&nbsp;&nbsp;&nbsp; &nbsp;<img src="img/like.png" height="18" width="18"> <span class="likes<?php echo $row_gory['id'];?>"><?php echo $num_likes;?></span> </span>&nbsp;&nbsp;<span class="like_comm">Views <?php echo $num_view;?> </span></span></span><br/>
          		   <span class="text-primary"><?php //if($user_status <> 0 and $fetch_user['type']=='0'){ ?>
				   <span class="desof_pro"><img src="./img/like.png" height="18" width="18"> <?php if($num_like > 0 and $user_status== '1'){?><span class="like<?php echo $id;?>"><a style="cursor:pointer" onClick="unlike(<?php echo $id;?>,<?php echo "'".$user_uniq."'"?>)">Unlike</a></span><?php }else{?> 
<span class="like<?php echo $id;?>"><?php if($user_status <> 0 ){?><a  style="cursor:pointer" onClick="like(<?php echo $id;?>,<?php echo  "'".$user_uniq."'"?>)">Like</a><?php }else{?><a  data-toggle="modal" data-target="#loginModal" onClick="like(<?php echo $id;?>,<?php echo  "'".$user_uniq."'"?>)">Like</a> <?php }?></span> <?php }?>&nbsp;<span class="like_comm"><img src="img/images.png" height="18" width="18"> Comment </span>
</span></span><br/><br/>
<?php if(mysql_num_rows($exec_comment)>0){?>
				<div class="view_comments">
               <span class="text-primary" style="color:#000;font-family:sans-serif;font-size:12px">
               <div id="comments<?php echo $id;?>">
<?php
$j=1;
	while($num_comment = mysql_fetch_assoc($exec_comment)){
		
		  ?>
          <div class="comments_shows">
<img style="float:left; margin-right:1%" src="<?php if($num_comment['img'] <> ''){echo 'img/'.$num_comment['img'];}else{ echo 'img/no_img.jpg';}?>" height="50px"><strong><?php echo $num_comment['first_name'];?> <?php echo $num_comment['last_name'];?>:</strong><br> <?php echo $num_comment['comments'];?>
<?php if($user_status <> 0 and $fetch_user['uniq_id']==$num_comment['usid']){?>
<div onClick="del2(<?php echo $num_comment['id'];?>,<?php echo $num_comment['image_id'];?>,'<?php echo $num_comment['usid'];?>')" class="cancel_co">x</div>

<div class="clear"></div>
<?php }?>

</div>
<div class="clearfix"></div>
<?php $j++;}?>
</div>
				</span></div>
           <?php }else{?>
           <div class="view_comments">
           <div id="comments<?php echo $id;?>"> <div class="comments_shows"></div></div>
           </div>
           <?php }?>

<br/>

               <span class="normal_txt">
               <span class="desof_pro">

<div id="errormsg<?php echo $id;?>" style="color:red"></div>
<div id="sucmsg<?php echo $id;?>" style="color:green"></div>
<form method="post" id="form<?php echo $id;?>" onSubmit="<?php if($user_status <> 0 ){ ?>return save_comment2(<?php echo $id;?>) <?php } else{?><?php echo $_SERVER['PHP_SELF']; }?>" >
<input type="hidden" name="image_id" value="<?php echo $id;?>">
<input type="hidden" name="userid" value="<?php echo $user_uniq;?>">
<input type="hidden" name="do" value="msgsave">
<input type="text"  name="comment" autocomplete="off" id="savecomment<?php echo $id;?>"  class="form-control" placeholder="Enter your comment here"> 
<br>
<?php if($user_status <> 0 ){?>
<input type="button" class="btn" style="background-color:#ff6961;color:white;"  name="submit" id="savecomment<?php echo $id;?>" value="submit" onClick="save_comment2(<?php echo $id;?>)">
<?php }else{?>

<input type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-success" name="submit" value="Login">
<?php } ?>
</form>

</span></span><br/>
                           
              <div class="clear"></div>
        
        </div>
		</div>
		</div>

	</div>


    
   
    
    
	
	<br><br><br><br>
</div>
<hr>

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
          <li><a role="tab" onclick="usertype(1)" data-toggle="tab" style="color:black">Experts</a></li>
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
              Or connect with <br>
              <br>
             <div id="usersocial">  <a href="fb_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a><!-- <a href="twitter_login.php?type=0&path=<?php echo $page;?>&id=<?php echo $_GET['id'];?>">
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
				<span class="pull-left">Don't have an account? <a href="Register.php" style="color:blue">Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>

          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>

		  
		  


<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<?php include "./include/footer.php";?>

</body>
</html>