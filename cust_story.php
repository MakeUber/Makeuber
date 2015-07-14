<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");

/////////////////////////////////// Homepage Stories Section ////////////////////////

$sql_stories = "select * from home_stories where status='1' and id=".$_GET['id'];
$exec_stories = mysql_query($sql_stories);
$fetch = mysql_fetch_assoc($exec_stories);
//print_r($fetch);

///////////////////////////////////////Cust Images ///////////////////////////////

$sql_cust = "select * from cust_images where status='1' and cust_id=".$_GET['id'];
$exec_cust = mysql_query($sql_cust);
$exec_cust1 = mysql_query($sql_cust);
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
			<script src = "js/jsfunction.js" type="text/javascript"></script>
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
				$(location).attr('href',window.location.href); 
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
function hidefeddback(){
	$('.feedback').animate({right:'-32.7%'},1000);
	$('.feedback').data('hidden','false');
	$('.blur').remove();
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

<style type="text/css">
	#wrapper{
		background: url('Background/bckg_7.jpg');
		background-size: cover;
	}
	.slider{
		height: auto;
		margin-left:19%;
	}
	#pic-wrap{
		width: 800px;
		height: 350px;
		overflow: hidden;
	}
	#pic-wrap .slide{
		text-align: center;
		width: 800px;
		background: #EDE7E7;
		padding: 30px;
		height: 350px;
		float: left;
		list-style-type: none;
	}
	#pic-wrap .slides{
		display: block;
		width: 9000px;
		height: 350px;
		margin: 0;
		padding: 0;
		background: #222;
	}
	#pic-wrap ul li img{
		height: 100%;
	}
	#thumbnail{
		height: 120px;
		width: 800px;
		overflow: hidden;
	}
	#thumbnail .slides{
		display: block;
		width: 6000px;
		height: 120px;
		margin: 0;
		padding: 0;
		background: #999;
		box-shadow: #222 3px 3px 5px inset;
	}
	#thumbnail .slide{
		text-align: center;
		width: 120px;
		float: left;
		padding: 10px;
		height: 120px;
		list-style-type: none;
	}
	#thumbnail ul li img{
		height: 100%;
		cursor: pointer;
	}
	img.active{
		border:1.5px solid #fff;
		box-shadow: 0 0 2px 2px #666;
	}
	.content{
		
		border-left:1px solid #555;
		box-shadow: 0 0 2px 2px #888;
	}
	#slide-left,#slide-right{
		height: 120px;
		width:50px;
		background:rgba(0,0,0,0.3);
		position: absolute;
		z-index: 1000;
		padding-top:28px;
		padding-left:5px;
		cursor: pointer;
		display: none;
		color: #bbb;
	}
	#slide-left:hover,#slide-right:hover{
		color:#aaa;
	}
	#slide-right{
		right:301px;
		top:611px;
	}
	a { color : white ; } 
	 a:hover { color:white; text-decoration:none; } 
</style>

<script type="text/javascript">
	$(document).ready(function(){
		//function to center the images
		$('li img').each(function(){
			var $parent = $(this).parent();
			if($(this).width() > $parent.width())
				$(this).css('margin-left','-'+($(this).width()-$parent.width()));
		});

		//function for showing the image
		var firstSlide = 0;
		var lastSlide = 0;
		var $slider = $('#pic-wrap');
		var $slideContainer = $slider.find('.slides');
		var $slide = $slideContainer.find('.slide');
		var $thumbnail = $('#thumbnail');
		var slideLen = $thumbnail.find('.slide').length;
		for(var i=2;i<slideLen;i++){
			if(($thumbnail.find('.slide').eq(i).offset().left+30) > ($thumbnail.width()+$thumbnail.offset().left)){
				lastSlide = i;
				break;
			}
		}


		$thumbnail.find('.slide').on('click',function(){
			var margin = 800*($(this).index());
			var $this = $(this);
			$slideContainer.animate({'margin-left':'-'+margin},1000,function(){
				$thumbnail.find('img.active').removeClass('active');
				$this.find('img').addClass('active');
			});
		});

		showLeftSlider();
		showRightSlider();

		function showLeftSlider(){
			//if(firstSlide > 0)
				$('#slide-left').show();
			//else
				//$('#slide-left').hide();
		}

		function showRightSlider(){
			if(lastSlide < slideLen-1)
				$('#slide-right').show();
			else
				$('#slide-right').hide();
		}

		$('#slide-left').on('click',function(){
			firstSlide = firstSlide-1;
			lastSlide-=1;
			var width = $thumbnail.find('.slide').eq(firstSlide).width();
			$thumbnail.find('.slides').animate({'margin-left':'+='+width},500,function(){
				showLeftSlider();
				showRightSlider();
			});
		});

		$('#slide-right').on('click',function(){
			firstSlide += 1;
			lastSlide+=1;
			var width = $thumbnail.find('.slide').eq(lastSlide).width();
			$thumbnail.find('.slides').animate({'margin-left':'-='+width},500,function(){
				showRightSlider();
				showLeftSlider();
			});
		});

	});
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


 <?php include "./include/header.php" ?>

<!-- ---------------------MAIN ------------------------------- -->
<div id="main" class="row container" style="padding:10px;height:auto;opacity:1;overflow-x:hidden;background:#fff;margin-top:30px;">
	<h3 style="color:#A52C00;margin-bottom:15px;text-align:center; font-family:sans-serif;">Customer Stories</h3>
	<div class="slider">
		<div id="pic-wrap">
			<ul class="slides">
            <?php while($fetch_cust = mysql_fetch_assoc($exec_cust)){?>
				<li class="slide"><img src="./pics/<?php echo $fetch_cust['image'];?>"></li>
             <?php }?>
                     
			</ul>
            <!--<ul class="slides">
				<li class="slide"><img src="Images/Area_Category/bathroom.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/bed.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/coffee_table.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/corner_table.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/crockery.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/dining_table.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/dresser_mirror.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/false_ceiling.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/flooring.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/garden.jpg"></li>
			</ul>-->
		</div>
		<div class="clearfix"></div>
		<div id="thumbnail">
			<div id="slide-left">
				<i class="fa fa-chevron-left" style="font-size:60px;"></i>
			</div>
            <ul class="slides">
            <?php while($fetch_cust1 = mysql_fetch_assoc($exec_cust1)){?>
				<li class="slide"><img src="./pics/<?php echo $fetch_cust1['image'];?>"></li>
             <?php }?>
				<!--<li class="slide"><img src="Images/Area_Category/bathroom.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/bed.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/coffee_table.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/corner_table.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/crockery.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/dining_table.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/dresser_mirror.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/false_ceiling.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/flooring.jpg"></li>
				<li class="slide"><img src="Images/Area_Category/garden.jpg"></li>-->
			</ul>
			<!--<ul class="slides">
				  <?php while($fetch_cust1 = mysql_fetch_assoc($exec_cust1)){?>
				<li class="slide"><img src="pics/<?php echo $fetch_cust1['image'];?>"></li>
             <?php }?>
			</ul>-->
			<div id="slide-right" style="margin-top: -3%;">
				<i class="fa fa-chevron-right" style="font-size:60px;"></i>
			</div>
		</div>
	</div>

	<div class="row" style="padding:30px;">
		<div class="col-sm-2"></div>
		<div class="content col-sm-8" style="margin:20px;width: 62%;font-family:sans-serif;">
			<h3><?php echo $fetch['title'];?></h3><p style="margin-top:10px;margin-bottom:5px;font-family:sans-serif;">	Author Name: <?php echo $fetch['posted_by'];?> <br> Date : <?php echo date("d-m-Y",$fetch['time']);?></p><p><?php echo $fetch['description'];?></p>
		</div>
		<div class="col-sm-2"></div>
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


<!----------------------------FOOTER------------------- -->
<?php include "./include/footer.php";?>

</body>
</html>