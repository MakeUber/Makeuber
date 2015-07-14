<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tabl = 'user';
$tab2 = 'project';
$id=$_GET['id'];

 $user="Select * from $tabl where uniq_id='$id'" or die(mysql_error());
$select=mysql_query($user);	
$fetch_expert = mysql_fetch_assoc($select);


//$group="select $tab2.*, category.category_name from $tab2 left outer join category on $tab2.category=category.id where $tab2.user_id='".$fetch_user['uniq_id']."' group by category and category.status='1'";	
$group="select * from $tab2 where user_id='".$id."' group by category order by sort ASC" or die(mysql_error());
$raw_group=mysql_query($group);

$cat_group = mysql_fetch_assoc($raw_group);

//print_r($fetch_expert);

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

<link rel ="stylesheet" href="./cssp/font-awesome.min.css">
	<link rel="stylesheet" href="./css/custom.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="./cssp/font-awesome.min.css">
<script src = "./js/jquery.js" type="text/javascript"></script>
<script src = "./js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/expert.js"></script>
<script src = "./js/jsfunction.js" type="text/javascript"></script>

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">

.up,.down{
		cursor: pointer;
	}
	.up:hover{
		font-size: 20px;
		transition:all 0.3s;
		color: green;
	}
	.down:hover{
		font-size: 20px;
		transition:all 0.3s;
		color: red;
	}
	.profile_pic{
		height: 160px;
		width: 160px;
		border: 4px solid #fff;
		border-radius: 2px;
		background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.3);
		box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.07);
	}
	
	.photo-slide{
		float: left;
		margin:20px;
		text-align: center;
		font-family: 'Dosis',sans-serif;
		padding:10px;
		border: 1px solid #aaa;
		box-shadow: 0 0 1px 1px #ccc;
		
	}
	.photo-slide img{
		cursor: pointer;
		border-radius: 4px;
		margin-bottom: 5px;
	}
	.a-active{
		text-decoration: none;
		color:#000 ;
	}


	span.stars, span.stars span{
		display: block;
		background: url('./img/stars.png') 0 -16px repeat-x;
		width: 79px;
		height: 15px;
	}
	span.stars span{
		background-position: 0 0;
		width:0px;
	}

	.footer-menu li a:hover{color:white; text-decoration:none;}	
</style>
<script> 
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
	$(document).ready(function(){
		/*$('.photo-slide').each(function(index){
			slidepic($(this),index,1);
		});*/

		$.fn.stars = function(rating) {
		    return $(this).each(function() {
		        // Get the value
		        var val = parseFloat(rating);
		        // Make sure that the value is in 0 - 5 range, multiply to get width
		        console.log(val);
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
				//alert(rating/16);
		        $(this).html($span);
		    });
		}

		$('span.stars').click(function(e){
			var rating = e.pageX - $(this).offset().left;
			//alert(rating);
			$('span.stars').stars(rating);
			var vals = Math.round(rating)/16;
			$('#review').val(vals);
			
		});

		$('.photo-slide img').on('click',function(){
			var id=$(this).attr("name");
			window.location.href="expert_design.php?id="+id;
		});

		function slidepic(ele,ind,img){
			if(img == 7)
				img = 1;
			var index = ind+1;
			var src = 'Images/Pictures/portfolio'+index+'/img'+img+'.jpg';
			$(ele).find('img').attr('src',src);
			setTimeout(function(){
				slidepic(ele,ind,img+1);
			},3000);
		}
		$('[data-toggle=tooltip]').tooltip();

		$('.photo-slide a').on('click',function(e){
			var desc = $(this).attr("description");
			//alert(description);
			e.preventDefault();
			$('.photo-slide a').each(function(){
				$(this).removeClass('a-active');
			});
			$(this).addClass('a-active');
			$('#portfolio-item').slideUp().slideDown().text(desc);
		});
		$('.up').each(function(){
			$(this).data('set','false');
		});
		$('.down').each(function(){
			$(this).data('set','false');
		});
		$('.up').click(function(){
			if($(this).data('set') == 'false'){
				var val = parseInt($(this).next().text());
				$(this).next().text(val+1);

			}
			if($(this).next().next().data('set') == 'true')
				$(this).next().next().data('set','false');
			else
				$(this).data('set','true');
		});
		$('.down').click(function(){
			if($(this).data('set') == 'false'){
				var val = parseInt($(this).prev().text());
				$(this).prev().text(val-1);
			}
			if($(this).prev().prev().data('set') == 'true')
				$(this).prev().prev().data('set','false');
			else
				$(this).data('set','true');
		});
	});
	

</script>
<script src="js/jsfunction.js" type="text/javascript"></script>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;overflow-x:hidden;">


<?php include "./include/header.php";?>



<!----------------- MAIN ------------------------ -->
<div id="main" style="height:auto;opacity:1;">
	<div class="col-sm-10 col-sm-offset-1" style="padding:20px;background:#ccc;">
		<div class="col-sm-12" style="margin-top:60px;background:#fff;">
			<img src="./img/<?php if(empty($fetch_expert['image'])){ echo 'no_img.jpg'; }else{ echo $fetch_expert['image'];}?>" class="profile_pic" style="float:left;display:block;margin-top:-50px;margin-left:-10px;">
			<div style="float:left;padding:10px;width:550px;">
				<span style="font-size:24px;"><?php echo $fetch_expert['first_name']." ".$fetch_expert['last_name'];?></span><br> <span>Works At <?php echo $fetch_expert['firm'];?></span> <br><span>Rating: <?php 
						$sql_rate = "select * from review where designer_id='".$_GET['id']."'";
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
						?></span> <span><br>Review: <?php echo $num_rate;?></span>
			</div>
			
			<button class="btn btn-warning pull-right" style="margin-top:50px;margin-right:30px;" data-toggle="modal" data-target="#review-modal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;Write Review</button>
		</div>
		<div class="col-sm-12" style="background:#fff;margin-top:20px;padding:20px 20px 20px 80px;">
         <?php 
	$i=1;
	$category="Select * from $tab2 where user_id='".$id."'" or die(mysql_error());
 	$selected=mysql_query($category);
	
	while ($row_gory = mysql_fetch_assoc($selected)){
		//print_r($row_gory);
		  ?>
			<div class="photo-slide"><img name="<?php echo $row_gory['id'];?>" src="./img/<?php if(empty($row_gory['project_image'])){ echo 'no_img.jpg'; }else{ echo $row_gory['project_image'];}?>" height="270px" width="250px"><br>
				<a id="item1" href="expert_design.php?id=<?php echo $row_gory['id']; ?>" style="color:#545454;" description="<?php echo $row_gory['project_name'];?>" data-toggle="tooltip" data-placement="bottom" title="Click to Learn More"><?php echo $row_gory['project_name'];?></a>
			</div>
            
            <?php }?>
			<!--<div class="photo-slide"><img src="" height="270px" width="250px">
				<br><a id="item2" href="#" data-toggle="tooltip" data-placement="bottom" title="Click to Learn More">Good Earth Palm Groove</a>
			</div>
			<div class="photo-slide"><img src="" height="270px" width="250px">
			<br><a id="item3" href="#" data-toggle="tooltip" data-placement="bottom" title="Click to Learn More">Prestige Acropolis</a>
			</div>-->
			<div style="clear:both;"></div>
			<div style="display:none;border-radius:5px;background:#eb8d41;margin:10px;padding:10px;" id="portfolio-item">
			</div>
			<h3>About <?php echo $fetch_expert['first_name'];?></h3>
			<div class="about" style="padding:10px;">
				<span><i class="fa fa-graduation-cap">&nbsp;&nbsp;</i>Experience of <?php echo $fetch_expert['experience'];?> years</span><br>
				<span><i class="fa fa-home">&nbsp;&nbsp;</i>Lives in : <?php echo $fetch_expert['area'];?>, <?php echo $fetch_expert['city'];?></span><br>
				<span><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Website : <?php echo $fetch_expert['website'];?></span>
			</div>
			<h3>Portfolio</h3>
			<div style="background:#eb8d41;border-radius:5px;margin:10px;padding:10px;">
			 <?php echo $fetch_expert['about_me'];?>
			</div>
			<span></span>
<h3>Top Reviews</h3>
            <?php
			while($fetch_review = mysql_fetch_assoc($exec_rate1)){
				//print_r($fetch_review);
				$sql_reviews = "select * from likes_reviews where review_id='".$fetch_review['user_id']."'";
				$exec_reviews = mysql_query($sql_reviews);
				//$fetch_reviews = mysql_fetch_assoc($exec_reviews);
				$num_review = mysql_num_rows($exec_reviews);
				
				///////////////////////User info /////////////////////////////////
				$sql_user="select * from user where uniq_id='".$fetch_review['user_id']."'";
				$exec_user = mysql_query($sql_user);
				$fetch_users = mysql_fetch_assoc($exec_user);
				//print_r($fetch_user);
			?>
			<div class="review" style="background:#F7F1FF;margin:10px;padding:10px;">
				<img style="float:left; margin-right:10px" src = "img/<?php if(empty($fetch_users['image'])){ echo 'no_img.jpg'; }else{ echo $fetch_users['image'];}?>" height="50px" width="50px"><strong><?php echo $fetch_users['first_name'] ." ".$fetch_users['last_name'];?>:</strong>&nbsp;&nbsp;<?php echo $fetch_review['feedback'];?><br /><br>
				<div style="float:left;">Was this review helpful ?</div>
				  <?php if($fetch_user['type'] == '0'){?>
				<div style="margin-left:20px;margin-top:-5px;font-size:18px;float:left;text-shadow: 0.3px 0.3px #ccc;">
					<i class="fa fa-thumbs-o-up up" ></i>
					&nbsp;<span class="like">1 </span>&nbsp;
					<i class="fa fa-thumbs-o-down down"></i>
				</div> 
				<?php } else { ?>    
					<div style="margin-left:20px;margin-top:-5px;font-size:18px;float:left;text-shadow: 0.3px 0.3px #ccc;">
					<i class="fa fa-thumbs-o-up up" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"></i>
					&nbsp;<span  >1 </span>&nbsp;
					<i class="fa fa-thumbs-o-down down" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"></i>
				</div> 	<?php } ?> 
				<div style="clear:both;"></div>
			</div>
            <?php }?>
			
			<!--<div class="review" style="background:#a6b4e9;margin:10px;padding:10px;">
				<img src = "" height="50px" width="50px">&nbsp;&nbsp;Review<br /><br>
				<div style="float:left;">Was this review helpful ?</div>
				<div style="margin-left:20px;margin-top:-5px;font-size:18px;float:left;text-shadow: 0.3px 0.3px #ccc;">
					<i class="fa fa-thumbs-o-up up"></i>
					&nbsp;<span class="like">3</span>&nbsp;
					<i class="fa fa-thumbs-o-down down"></i>
				</div>
				<div style="clear:both;"></div>
			</div>
			<a style="margin:10px;">Load More</a>-->
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
                <?php }?>
                </form>
			</div>
		</div>	
	</div>
</div>


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
				<span class="pull-left">Don't have an account? <a href="Register.php" style="color:blue">Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>


          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>

<!-- ---------------------Footer ------------------------------- -->
<?php include "./include/footer.php";?>

</body>
</html>