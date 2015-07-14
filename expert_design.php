<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tabl = 'project';
$tab2 = 'project_images';
 $id=$_GET['id'];

 $user="Select * from $tabl where id='$id'" or die(mysql_error());
$select=mysql_query($user);	

$fetch_exp = mysql_fetch_assoc($select);
//print_r($fetch_exp);

 $user1="Select * from user where uniq_id='".$fetch_exp['user_id']."'" or die(mysql_error());
$select1=mysql_query($user1);	
$fetch_expert = mysql_fetch_assoc($select1);

	
$group="select * from $tab2 where images_id='".$id."' order by sort ASC" or die(mysql_error());
$raw_group=mysql_query($group);
$imgid_fetch['id']=$_POST['id'];

$del_com="delete from comment where user_id=''";
mysql_query($del_com);
//for entering the comment


//view for user login part
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
   $sql= "update views set time='".time()."' where id='".$fetch['id']."'";
   $exec = mysql_query($sql);
   if($exec){
   $sql_update = "update tutorial set counter = counter +1 where uniq='tutorail_id'"; 
   mysql_query($sql_update);
   }
  }
 }
 else{
  $sql_insert = "insert into views(sort,ip,url,status,time) select max(sort)+1, '$ip','$url',1,'".time()."' from views"; 
  if(mysql_query($sql_insert)){
   $sql_update = "update tutorial set counter = counter +1 where uniq='$tutorail_id'"; 
   mysql_query($sql_update);
  }
 }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
	MakeUber
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
	<link rel="stylesheet" href="./css/custom.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="./cssp/font-awesome.min.css">
<script src = "./js/jquery.js" type="text/javascript"></script>
<script src = "./js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
	.profile_pic{
		height: 160px;
		width: 160px;
		border: 4px solid #fff;
		border-radius: 2px;
		background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.3);
		box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.07);
	}
	
	.photo{
		box-shadow: 0px 0px 0px 4px rgba(0, 0, 0, 0.04), 0px 1px 5px rgba(0, 0, 0, 0.1);
		transition: all 0.15s ease-out 0.1s;
		height: 100%;
		width: 100%;
		display: block;
	}
	.photo-wrap{
		box-shadow: 0px 0px 1px 1px rgba(0,0,0,0.05);
		padding:5px;
		background:none repeat scroll 0% 0% rgba(255,255,255,1);
		width:250px;
		margin:20px;
		font-size: 14px;
		font-weight: 700;
		color: #777;
		text-align: center;
		float: left;
		cursor: pointer;
		transition: all 0.15s ease-out 0.1s;
	}
	.photo-wrap:hover{
		box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.2);
	}
	.wrap{
		background:rgba(0,0,0,0.1);
		padding:5px;
		border:0.5px solid rgba(0,0,0,0.2);
		height: 210px;
		width: 200px;
		margin:5px;
		margin-right: auto;
		margin-left: auto;
	}
	.photo-modal{
		z-index: 502;
		height: 87%;
		width: 75%;
		position: fixed;
		background: #aaa;
		top:7%;
		left:12%;
		border-radius: 4px;
		box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.2);
	}
	.photo-content{
		height: 100%;
		width: 40%;
		background: #fff;
		float: left;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		overflow: auto;
	}
	.comment-box{
		height: 50px;
		width: 90%;
		margin:10px;
	}
	.comment{
		float: left;
		margin-left: 1px;
		padding-left: 4px;
		background: #DDD;
		height: 80%;
		width: 81%;
	}

	span.stars, span.stars span{
		display: block;
		background: url('./img/stars.png') 0 -16px repeat-x;
		width: 82px;
		height: 16px;
	}
	span.stars span{
		background-position: 0 0;
		width:0px;
	}
	
	.photo-modal a { color : black ; }  
	.photo-modal a:hover { color : blue; } 
	
	.footer-menu li a { color :white; } 
		.footer-menu li a:hover { color:white;text-decoration:none; } 
	
	a {color:white;text-decoration:none; } 
	a:hover {color:white; text-decoration:none; } 

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
</script> 
<script type="text/javascript">
	var ind=0;
	$(document).ready(function(){
		$.fn.stars = function(rating) {
		    return $(this).each(function() {
		        // Get the value
		        var val = parseFloat(rating);
		        // Make sure that the value is in 0 - 5 range, multiply to get width
		        val = val/16;
		        val = Math.round(val*10)/10;
		        var dec = Math.round(val) - val;
		        if(dec > 0){
		        	if(dec > 0.7)
		        		val = Math.min(Math.round(val)*16,80);
		        	else
		        		val = Math.min((Math.round(val) - 0.5)*16,80);
		        }
		        else{
		        	if(dec > -0.3)
		        		val = Math.round(val)*16;
		        	else
		        		val = (Math.round(val)+0.5)*16;
		        }
		        console.log(val);
		        // Create stars holder
		        var $span = $('<span />').width(val);
		        // Replace the numerical value with stars
				$rat = Math.round(val)/16;
		        $(this).html($span);
				$('#review').val($rat);
	    	});
		}

		$('span.stars').click(function(e){
			var rating = e.pageX - $(this).offset().left;
			$('span.stars').stars(rating);
		});
		$('.photo-modal').data('show','false');


		$('.photo-wrap').click(function(e){
			e.preventDefault();
			ind = $(this).index();
			var src = $(this).find('img').attr('src');
			var name = $(this).data('expert');
			var date = $(this).data('date');
			var desc = $(this).data('desc');
			var like = $(this).find('.tot-like').text();
			var comment = $(this).find('.tot-comment').text();
			$('.img-big').attr('src',src);
			$('.exp-name').text(name);
			$('.img-date').text(date);
			$('.img-desc').text(desc);
			$('.img-like').text(like);
			$('.img-comment').text(comment);
			var islike = $(this).data('islike');
			var userstatus = $(this).data('userstatus');
			var userid = "'"+$(this).data('userid')+"'";
			if(islike > 0 && userstatus==1){
			   $('.like').html('<a  class="blacklink"style="color:black;" onclick="unlike1('+userid+')" >Unlike</a>');
			}
			else{
			   if(userstatus != 0){
			     $('.like').html('<a class="blacklink"style="color:black;"  onclick="like1('+userid+')">Like</a>');
			   }
			   else{
			     $('.like').html('<a class="blacklink"  data-toggle="modal" data-target="#loginModal" onclick="like1('+userid+')" style="color:black;">Like</a>'); 
			   }
			}
			$('body').append('<div class="blur"></div>');
			$('.photo-modal').fadeIn();
			$('.photo-modal').data('show','true');
			var id= $(this).data('id');
			fetchComment(id);
		});

		$('.prev-img').click(function(){
			if(ind==0)
				return false;
			ind--;
			var obj = $('.photo-wrap').eq(ind);
			var src = $(obj).find('img').attr('src');
			var name = $(obj).data('expert');
			var date = $(obj).data('date');
			var desc = $(obj).data('desc');
			var exp1 = $(obj).data('exp_img');
			var like = $(obj).find('.tot-like').text();
			var comment = $(obj).find('.tot-comment').text();
			$('.img-big').attr('src',src);
			$('.exp').attr('src',exp1);
			$('.exp-name').text(name);
			$('.img-date').text(date);
			$('.img-desc').text(desc);
			$('.img-like').text(like);
			$('.img-comment').text(comment);
			var islike = $(obj).data('islike');
			var userstatus = $(obj).data('userstatus');
			var userid = "'"+$(obj).data('userid')+"'";
			if(islike > 0 && userstatus==1){
			   $('.like').html('<a class="blacklink"onclick="unlike1('+userid+')" style="color:black;">Unlike</a>');
			}
			else{
			   if(userstatus != 0){
			     $('.like').html('<a onclick="like1('+userid+')" style="color:black;">Like</a>');
			   }
			   else{
			     $('.like').html('<a  data-toggle="modal" data-target="#loginModal" onclick="like1('+userid+')" style="color:black;">Like</a>'); 
			   }
			}
			var id=$(obj).data('id');
			fetchComment(id);
		});

		$('.next-img').click(function(){
			if(ind == $('.photo-wrap').length-1)
				return false;
			ind++;
			var obj = $('.photo-wrap').eq(ind);
			var src = $(obj).find('img').attr('src');
			var id = $(obj).data('id');
			var name = $(obj).data('expert');
			var date = $(obj).data('date');
			var desc = $(obj).data('desc');
			var exp1 = $(obj).data('exp_img');
			var like = $(obj).find('.tot-like').text();
			var comment = $(obj).find('.tot-comment').text();
			$('.img-big').attr('src',src);
			$('.exp').attr('src',exp1);
			$('.exp-name').text(name);
			$('.img-date').text(date);
			$('.img-desc').text(desc);
			$('.img-like').text(like);
			$('.img-comment').text(comment);
			var islike = $(obj).data('islike');
			var userstatus = $(obj).data('userstatus');
			var userid = "'"+$(obj).data('userid')+"'";
			if(islike > 0 && userstatus==1){
			   $('.like').html('<a onclick="unlike1('+userid+')" style="color:black;">Unlike</a>');
			}
			else{
			   if(userstatus != 0){
			     $('.like').html('<a onclick="like1('+userid+')" style="color:black;">Like</a>');
			   }
			   else{
			     $('.like').html('<a  data-toggle="modal" data-target="#loginModal" onclick="like1('+userid+')" style="color:black; 	">Like</a>'); 
			   }
			}
			var id=$(obj).data('id');
			fetchComment(id);
			//$('.bottom_section'+id).html('');
			//$('.bottom_section'+id).text(data);
			
		});

		$('body').on('click',function(e){
			if($('.photo-modal').data('show')=='true'){
				if($('div.blur').is(e.target)){
					$('.photo-modal').fadeOut();
					$('.blur').remove();
					$('.photo-modal').data('show','false');
				}
			}
		});
		$('.close').click(function(e){
			e.preventDefault();
			$('.photo-modal').fadeOut();
			$('.blur').remove();
			$('.photo-modal').data('show','false');
		});

	});

	function fetchComment(id){
		$.ajax({
			url:'background.php',
			type:'POST',
			data:{id:id}
		}).done(function(data){
			if(data == '')
				$('.comments').html(data);
			else{
				var response = $.parseJSON(data);
				var toappend = '';
				for(var i=0;i<response.length;i++){
					toappend+='<div class="comment-box"><div style="float:left;"><img src="img/';
					if(response[i]['img']!=''){
						toappend+=response[i]['img']+'"';
					}
					else{
						toappend+='no_img.jpg"';
					}
					toappend+=' height="40px" width="40px"></div><div class="comment">'+response[i]['first_name']+' '+response[i]['last_name']+' : '+response[i]['comments']+'</div><div class="close del-comment" data-id="'+response[i]['id']+'" data-imgId="'+response[i]['image_id']+'" data-userId = "'+response[i]['usid']+'">&times;</div></div><div class="clearfix"></div>';					
					                                        
				}
				$('.comments').html(toappend);
			}
		});
	}

	$(document).on('click','.del-comment',function(){
		var id=$(this).data('id');
		var imgId = $(this).data('imgid');
		var userId = $(this).data('userid');
		var $obj = $(this);
		//alert(userId);
		del_expert(id,imgId,userId,$obj);
	});
	
</script>
<style> 


</style>
<script src="./js/jsfunction.js" type="text/javascript"></script>
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

<!-- ---------------------Header ------------------------------- -->
<?php include "./include/header.php" ?>

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
				<span class="pull-left" style="font-size:15px;color:black;font-family:sans-serif;">Don't have an account? <a href="Register.php" style="color:blue;" >Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>

          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>

		  
		  
		  
	 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		  
		  
		  
		  

<!----------------- MAIN ------------------------ -->
<div id="main" style="height:auto;opacity:1;">
	<div style="width:92vw;background:#ccc;padding:20px;margin-left:3vw;height:220px;">
		<div class="col-sm-10 col-sm-offset-1" style="margin-top:60px;background:#fff;">
			<img src="./img/<?php if(empty($fetch_expert['image'])){ echo 'no_img.jpg'; }else{ echo $fetch_expert['image'];}?>" class="profile_pic" style="float:left;display:block;margin-top:-50px;margin-left:-10px;">
			<div style="float:left;padding:10px;width:540px;">
				<span style="font-size:24px;"><?php echo $fetch_expert['first_name']." ".$fetch_expert['last_name'];?> </span><br> <span>Works At <?php echo $fetch_expert['firm'];?></span> <br><span>Rating:<?php 
						$sql_rate = "select * from review where designer_id='".$fetch_expert['uniq_id']."'";
						$exec_rate = mysql_query($sql_rate);
						$exec_rate1 = mysql_query($sql_rate);
						$num_rate = mysql_num_rows($exec_rate);
						$rate=0;
						while($fetch_rate = mysql_fetch_assoc($exec_rate)){
							$rate = $rate + $fetch_rate['review'];
						}
						$rating = $rate/$num_rate;
												
						for($i=0;$i<$rating;$i++)
						echo '<i class="fa fa-star"></i>';
						$rating = 5 - $rating;
						for($i=0;$i<$rating;$i++)
						echo '<i class="fa fa-star-o"></i>';
						?><span><br>Review: <?php echo $num_rate;?></span>
			</div>
			
			<button class="btn btn-warning pull-right" style="margin-top:50px;margin-right:30px;" data-toggle="modal" data-target="#review-modal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;Write Review</button>
		</div>
	</div>
	<div style="width:92vw;margin-left:3vw;">
		<div class="col-sm-12" style="background:#eaeaea;padding:20px;padding-left:43px;">

<!-----------------------------PHP Block --------------------- -->

		<?php
	$number = mysql_num_rows($raw_group);
	if($number == 0){
		echo "<h4>No Image Added Yet</h4>";
	}
	$keys=1;
	while ($row_gory = mysql_fetch_assoc($raw_group)){
		//i have liked this image or not
		$sql_like = "select * from likes where image_id='".$row_gory['id']."' and status='1' and uc='0'";
		$exec_like = mysql_query($sql_like);
		$num_likes = mysql_num_rows($exec_like);
		
		///
		$sql_likes = "select * from likes where image_id='".$row_gory['id']."' and status='1'  and uc='0' and user_id='".$fetch_user['uniq_id']."'";
		$exec_likes = mysql_query($sql_likes);
		$num_like = mysql_num_rows($exec_likes);
		
		$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img, user.uniq_id as usid from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$row_gory['id']."' and comment.status='1' and comment.uc='0' order by comment.id DESC";
		$exec_comment = mysql_query($sql_comment);
		$num_comment = mysql_num_rows($exec_comment);
		$num_comment1 = mysql_num_rows($exec_comment);
		  if(empty($fetch_expert['image'])){ $exp_img='no_img.jpg'; }else{ $exp_img= $fetch_expert['image'];}
		  
				echo '<div class="photo-wrap" data-id = "'.$row_gory['id'].'" data-desc="'.$row_gory['description'].'" data-date="'.date("jS F Y",$row_gory['time']).'" data-expert="'.$fetch_expert['first_name']." ".$fetch_expert['last_name'].'" data-exp_img="img/'.$exp_img.'" data-islike="'.$num_like.'" data-userstatus="'.$user_status.'" data-userid="'.$user_uniq.'">';
			?>
			<span>
			<?php echo $row_gory['image_name']; ?>
			</span><div class="wrap">
			<?php 
				//echo '<img src="Pictures/'.$row[3].'/'.$row[4].'/'.$row[1].'.jpg" class="photo">';
			?>
            <img src="./img/<?php if(empty($row_gory['image'])){ echo 'no_img.jpg'; }else{ echo $row_gory['image'];}?>" class="photo">
			</div>
			<span><i class="fa fa-thumbs-o-up"></i>&nbsp;
			<span class="tot-like"><?php echo $num_likes; ?></span>
			&nbsp;&nbsp;&nbsp;<i class="fa fa-comment-o">&nbsp;</i>
			<span class="tot-comment"><?php echo $num_comment; ?></span>
			</span>
			</div>
		<?php
			}
		?>

		</div>
	</div>
</div>

<!---------------------- REVIEW MODAL ------------------------- -->
<div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-title"><h3>Share Your Review</h3></div>
             <div id="errormsgs" style="color:red"></div>
            <div id="successmsgs" style="color:green"></div>

			</div>
			<div class="modal-body">
            <form id="share_review">
            <input type="hidden" name="review" id="review">
            <input type="hidden" name="designer_id" value="<?php echo $fetch_expert['uniq_id'];?>">
            <input type="hidden" name="user_id" value="<?php echo $user_uniq;?>">
            <input type="hidden" name="do" value="share_reviews">
            <div style="float:left;margin-top:-5px;margin-bottom:10px;">
				<span style="display:block;">Rate this User&nbsp;&nbsp;&nbsp;&nbsp;</span> 
				<span style="float:left;" class="stars">
					<span></span>
				</span>
			</div>
				<textarea class="form-control" name="feedback" rows="4" placeholder="Write Your Review in the box"></textarea><br>
                  <?php if($fetch_user['type'] == '0'){?>
				<input type="button" class="btn btn-warning" onClick="submit_review()" value="Share">
                <?php  }else{?>
                <a href="#" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Share</a></li>
                <?php } ?>
                </form>
			</div>
		</div>	
	</div>
</div>


<!-------------------- PHOTO MODAL ----------------------------- -->
<div class="photo-modal" style="display:none;">
	<div style="float:left;height:100%;width:60%;padding:20px;">
		<div style="padding:5px;background:rgba(255,255,255,0.4);border:2px solid rgba(0,0,0,0.1);box-shadow:0px 0px 2px 2px rgba(0,0,0,0.2);height:100%;width:100%;">
			<img class="img-big" src="img/<?php if(empty($row_gory['image'])){ echo 'no_img.jpg'; }else{ echo $row_gory['image'];}?>" height="100%" width="100%">
		</div>
		<div style="position:fixed;font-size:40px;font-weight:100;top:43%;left:8%;color:rgba(255,255,255,0.7);" class="prev-img"><i class="fa fa-chevron-left"></i></div>
		<div style="position:fixed;font-size:40px;font-weight:100;top:43%;right:8%;color:rgba(255,255,255,0.7);" class="next-img"><i class="fa fa-chevron-right"></i></div>
	</div>
	<div class="photo-content" style="padding:20px;">
		<a href="#" class="close"><i class="fa fa-close"></i></a>
		<div><img class="exp" src="img/<?php if(empty($fetch_expert['image'])){ echo 'no_img.jpg'; }else{ echo $fetch_expert['image'];}?>" height="50px" width="50px" style="float:left;margin-right:20px;"><span style="margin-left:20px;display:block;" class="exp-name"><?php echo $fetch_expert['first_name']." ".$fetch_expert['last_name'];?></span><span style="font-size:10px;" class="img-date"><?php echo date("jS F Y",$row_gory['time']);?></span></div>
		<span style="margin-top:20px;display:block;" class="img-desc"><?php echo $row_gory['description'];?></span>
		<span style="margin-top:5px;display:block;"><span class="like"></span>&nbsp;&nbsp;&nbsp;<a href="#" class="blacklink" style="color:black;">Comment</a></span>
		<span style="display:block;margin-top:2px;">&nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></i>&nbsp;<span class="img-like likes"></span>&nbsp;&nbsp;&nbsp;<i class="fa fa-comment-o"></i>&nbsp;<span class="img-comment"></span></span>
        <div class="bottom_section">
		<div class="comments"></div>
		
		<div style="background:#ccc;padding:5px;position:absolute;left:60%;bottom:0px;width:40%">
			<div style="float:left;"><img src=""></div>
            <div id="errormsg" style="color:red"></div>
			<div id="sucmsg" style="color:green"></div>

            <div style="float:left;margin-left:10px;width:90%;">
 				<form method="post" id="form" onSubmit="<?php if($user_status <> 0 ){ ?>return save_comment() <?php } else{?><?php echo $_SERVER['PHP_SELF'];}?>">
 			<input type="hidden" name="image_id" value="">
            <input type="hidden" name="userid" value="<?php echo $user_uniq;?>">
            <input type="hidden" name="do" value="msgsave1">
			<?php if($user_status <> 0 ){?>
            <input type="text" class="form-control" name="comment" autocomplete="off" id="savecomment"  placeholder="Leave a Comment">
            <?php }?>
            	</form>            
            </div>
		</div>
        </div>
	</div>
</div>

<!-- ---------------------Footer ------------------------------- -->
<?php include "include/footer.php";?>

</body>
</html>