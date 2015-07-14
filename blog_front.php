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
//$sql_gallary .=" order by counter DESC";
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
<link rel ="stylesheet" href="./cssp/style.css">
<link rel ="stylesheet" href="cssp/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
	#wrapper{
		background-image: url(Background/bckg_7.jpg);
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
	.more{
		background : #F1DA36;
		padding: 2px;
		border-radius: 4px;
	}
	.pic_wrap{
		height: 300px;
		width: 500px;
	}
	.pic_wrap:hover .hover_pic{
		display: block;
		transition:all 0.3s;
	}
	.pic_wrap img{
		height: 100%;
		width: 100%;
	}

	.blog{
		width: 550px;
		padding:10px;
		min-height: 500px;
	}
	.title{
		display: block;
		font-size: 24px;
		margin:8px;
		margin-left: 0px;
	}
	.intro{
		display: block;
	}
	.hover_pic{
		position: absolute;
		margin:0px;
		height: 300px;
		width: 500px;
		z-index: 20;
		background: rgba(0,0,0,0.6);
		cursor: pointer;
		display: none;
		text-align: center;
	}
	.plus{
		color:#fff;
		font-size: 30px;
		font-weight: 100;
		margin-top:27%;
	}
	.read-more{
		margin: 8px 0px 15px 0px;
		background: #fff;
		border : 2px solid #ccc;
		text-transform: uppercase;
		line-height: 2;
		color:black;
	}
	.read-more:hover{
		background: #222;
		color:#fff;
	}
	.user-info{
		font-size: 14px;
		margin:0 0 10px 10px;
		display: block;
	}

</style>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>

</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper"></div>

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
			$(location).attr('href', 'user_profile.php'); 
			//salert($('#budget').val());
			//if($('#budget').val() != '' || $('#budget').val() !== undefined){
				//alert("hi");
				//$("#projectform").submit();
			//}else{
				//alert("bye");
				//alert(window.location.reload());
			
			//}
   }
	   }
	/////////////////////////////////////else portion//////////////////////////////////////
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

  }
 }
  });
  return false;
}
function usertype(types){
		//alert(types);
		document.getElementById('usertype').value = types;
		if(types == 1){
			$('#expertsocial').show();
			$('#usersocial').hide();
		}else{
			$('#usersocial').show();	
			$('#expertsocial').hide();
		}
			
		//$('#usertype').val = types;
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
<?php include "include/header.php" ?> 
<!-- ---------------------MODAL ------------------------------- -->
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


          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>


<!-- ---------------------MAIN ------------------------------- -->
<div id="main" style="margin:0px;padding:10px;height:auto;background:#fff;opacity:1;">
	<div class="col-sm-3 col-sm-push-9" id="blog-ref" style="background:#e8866c;color:#fff;height:auto;padding:10px;">
		  <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" enctype="multipart/form-data">
        <div class="input-group col-sm-11">
			<input type="text" class="form-control" name="title"  placeholder = "Search">
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
            			<input type="hidden" name="submit">

		</div>
        </form>
		<div>
			<h4>Recent Posts</h4>
		  <?php 
$j=1;
while($recent_blog= mysql_fetch_assoc($exec_recent)){
	if($j<6){?>
<a href="blog.php?id=<?php echo $recent_blog['id']?>"><?php echo $recent_blog['title'] ?></a><br/>
<?php }$j++;} ?>		</div>
		<div>
			<h4>Browse by Category</h4>
             <?php while($fetch_cat= mysql_fetch_assoc($exec_cat )){?>
			<a style="cursor:pointer" href="blog.php?category=<?php echo $fetch_cat['id']?>"><?php echo $fetch_cat['category_name'] ?></a> |
			<?php }?>
<!--			<a href="#">Kitchens</a> | <a href="#">Wall Treatments</a> | <a href="#">Living Room</a> | <a href="#">Bedroom</a> | <a href="#">Terrace</a> | <a href="#">Bath</a> | <a class="more">...</a>
-->		</div>
	</div>
	<div class="col-sm-7 col-sm-pull-1" style="min-height:600px;line-hright:30px;">
    <?php if ($row_gallery > 0){
 while($fetch_blog=mysql_fetch_assoc($exec_gallery)){ 
 //print_r($fetch_blog);
	$sql_comment="select * from $tab3 where blog='".$fetch_blog['id']."' and status='1'";
	$comment_fetch=mysql_query($sql_comment);
	$comment_row=mysql_num_rows($comment_fetch);
	?>
		<div class="blog">
        <a href="blog.php?id=<?php echo $fetch_blog['id']?>">
			<div class="pic_wrap">
				<div class="hover_pic">
					<i class="fa fa-bolt plus"></i>
				</div>
				<img src="./img/<?php if($fetch_blog['image'] <> '') { echo  $fetch_blog['image'];}else{ echo 'no_img.jpg';}?>">
			</div>
            </a>
			<div class="desc">
				<span class="title"><?php echo $fetch_blog['title'];?></span>
				<span class="user-info"><?php echo date("F d,Y",$fetch_blog['time']);?> by <?php echo $fetch_blog['name']?> | <?php echo $comment_row;?> Comments </span>
				<span class="intro" style="text-align:justify !important"><?php echo substr($fetch_blog['description'],0,670);?> [...]</span>
			</div><div class="clearfix"></div>
			<a href="blog.php?id=<?php echo $fetch_blog['id']?>" class="read-more">Read More</a>&nbsp;&nbsp;&nbsp;<span><i class="fa fa-eye">&nbsp;</i> <?php echo $fetch_blog['counter']?></span>
		</div>
        
     <?php }
	}else{?>
    <h1 style="margin:10% 20%">No blog Found</h1>
    <?php }?>
		
	</div>
</div>

<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

</div>
<!---------------------------FOOTER ----------------- -->
<?php include "include/footer.php";?>

</body>
</html>