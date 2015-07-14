<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php"); 



/////////////////////////// It is used to check The Designer in our Website /////////////////////////////
$sql_expert="select user.*, main_cat.name as cat_name from user left outer join main_cat on main_cat.id = user.category where user.type='1' and user.status='1' order by first_name ASC";
$exec_expert = mysql_query($sql_expert);
$page = 'Index';

/////////////////////////////////////// It is used to fetch The blogs //////////////////////////////
$sql_blog = "select blog.*,category.category_name from  blog left outer join category on category.id = blog.category where blog.status='1'";
$sql_blog .=" order by id DESC limit 3";
$exec_blog = mysql_query($sql_blog);

///////////////////////////////////////Homepage bottom Text /////////////////////////////

$sql_home = "select * from content where id ='10' and status='1'";
$exec_home = mysql_query($sql_home);
$fetch_home = mysql_fetch_assoc($exec_home);

/////////////////////////////////// Homepage Stories Section ////////////////////////

$sql_stories = "select * from home_stories where status='1'";
$exec_stories = mysql_query($sql_stories);

//////////////////////////////// Select Expert category ///////////////////////////////

$main_cat="select * from main_cat where status ='1'";
$exec_cat=mysql_query($main_cat);

///////////////////////////////////Select Expert Name ///////////////////////////////////

$expert_name="select * from user where status ='1' and type='1'";
$exec_expert_name=mysql_query($expert_name);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> 
			 MakeUber | Hire Interior Designers, Architects for Design, Decorating &amp; Remodeling Ideas 
		</title> 
		<!..Bootstrap Intialization.. >
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="./css/custom.css">

			<!-- Optional theme -->
			
			
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	
			<link rel="stylesheet" type="text/css" href="./css/menu.css">
			<link rel="stylesheet" type="text/css" href="./css/Style.css">
			
			
			<link rel="stylesheet" type="text/css" href="./css/demo.css" />
			<link rel="stylesheet" type="text/css" href="./css/style1.css" />
			<link rel="stylesheet" type="text/css" href="./css/jquery.jscrollpane.css" media="all" />
	
			<script type="text/javascript" src="./js/jquery.js"></script>
			<script src = "./js/jsfunction.js" type="text/javascript"></script>
			
			
			<!..Change.. >


		<script src ="./js/bootstrap.min.js" type="text/javascript"></script>

	
	<style>
	html, body 
	{
		max-width: 100%;
		overflow-x:hidden;
		background-color:black;
	}
	#searchBelowLinks
	{
		background-color: #000;
		filter: alpha(opacity=80)\9;
		width: 100%;
		height: 100px;
		position:relative;
		bottom: 20px;
		
	}

	
	.searchBelowLinksList 
	{
		top no-repeat;
		text-decoration:none;
		color:#fff;
		display:block;
		float:left;
		height:80px;
		padding-left:32px;
		color:#fff;
		
		
	}
	.searchBelowLinksList 
	{
		top no-repeat;
		text-decoration:none;
		color:#fff;
		display:block;
		float:left;
		height:80px;
		padding-left:32px;
		margin-left:10px ;
		color:#fff;
	
	
		
	}
	
	.searchBelowLinksList span
	{
		font-size:16px;
		color:#d9d9d9;
		display:block;
	}

	.searchBelowLinksList .searchBelow2
	{
		width:332px;
		position:absolute;
		left:80px;
		
	}
	.searchBelowLinksList .searchBelow3
	{
		width:332px;
		position:absolute;
		left:950px;
		
	}

	#homeSearchContainer .searchBelowLinksList .searchBelow4
	{
		width:185px;
	}
	#homeSearchContainer .searchBelowLinksList .searchBelow1
	{
		padding-left:15px;
	}
	#homeSearchContainer .searchBelowLinksList a.searchBelow4 .bgSep
	{
		background-image:none;
		
	}
	p.bgSep img
	{ 
	position : relative; 
	bottom :-5px; 
	left: 80px; 
	}
	p.bgSep span 
	{
		position : relative ; 
		bottom :-18px; 
		left: 0px; 
	}



	
	</style>
	<?php
	$sql_stories = "select * from home_stories where status='1'";
	$exec_stories = mysql_query($sql_stories);
?>
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

	</head>
	<body >
	<!..body section  I.. >  
	<!.........................HEADER PART  ....................... >

				<div class="container-fluid" style="background-color:black;font-size:12pt;">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<img src="img/logo.jpg">
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="toolgrid.php"> tool grid <span class="sr-only"></span></a></li>
							<li><a href="blog_front.php">blog<span class="sr-only"></span></a></li>
							<li><a href="aboutus.php">about us<span class="sr-only"></span></a></li>
							<li><a href="contactus.php">contact us<span class="sr-only"></span></a></li>
							<?php if($user_status <> 0){?>
				<span style="font-size: 14px;margin-top: 16px;margin-left: 3px;float: left;">
              <span class="icon-user" style="color:white;"></span>
              <?php if($fetch_user['type'] == '0'){?>
                <a href="user_profile.php"><?php echo $fetch_user['first_name'];?></a>
            <?php }else{?>
                <a href="designer_profile.php"><?php echo $fetch_user['first_name'];?></a>
            <?php }?>
            </span></a></li>
              <li><a style="float:left;" href="logout.php">Logout</a>
              
              </li>
              
              <?php }else{?>
              <li><a href="#" data-toggle="modal" data-target="#loginModal">login</a></li>
              <?php }?>						
			 
				</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container-fluid -->
		
		<!.........................HEADER ENDS ................................> 
		
		 <!-- Use a container to wrap the slider, the purpose is to enable slider to always fit width of the wrapper while window resize -->
    
        <!-- Jssor Slider Begin -->
        <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
        <!-- ================================================== -->
        <div id="slider1_container" style="display: none; position: relative;width: 1090px; height: 442px;">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;

                background-color: #000; top: 0px; left: 0px;width: 100%; height:100%;">
                </div>
                <div style="position: absolute; display: block; background: url(./img/loading.gif) no-repeat center center;

                top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
            </div>

            <!-- Slides Container -->
            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1140px; height: 442px;
            overflow: hidden;">
                <div>
                    <img u="image" src2="./img/1-c.jpg" />
                </div>
                <div>
                    <img u="image" src2="./img/2-c.jpg" />
                </div>
                <div>
                    <img u="image" src2="./img/3-c.jpg" />
                </div>
                <div>
                    <img u="image" src2="./img/4-c.jpg" />
                </div>
            </div>
            
            <!--#region Bullet Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
            <style>
                /* jssor slider bullet navigator skin 05 css */
                /*
                .jssorb05 div           (normal)
                .jssorb05 div:hover     (normal mouseover)
                .jssorb05 .av           (active)
                .jssorb05 .av:hover     (active mouseover)
                .jssorb05 .dn           (mousedown)
                
                .jssorb05 {
                    position: absolute;
                }
                .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                    position: absolute;
                    /* size of bullet elment */
                    width: 16px;
                    height: 16px;
                    background: url(../img/b05.png) no-repeat;
                    overflow: hidden;
                    cursor: pointer;
                }*/
                .jssorb05 div { background-position: -7px -7px; }
                .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
                .jssorb05 .av { background-position: -67px -7px; }
                .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }
            </style>
            <!-- bullet navigator container -->
            <div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
                <!-- bullet navigator item prototype -->
                <div u="prototype"></div>
            </div>
            <!--#endregion Bullet Navigator Skin End -->
            
            <!--#region Arrow Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
            <style>
                /* jssor slider arrow navigator skin 11 css */
                /*
                .jssora11l                  (normal)
                .jssora11r                  (normal)
                .jssora11l:hover            (normal mouseover)
                .jssora11r:hover            (normal mouseover)
                .jssora11l.jssora11ldn      (mousedown)
                .jssora11r.jssora11rdn      (mousedown)
                
                .jssora11l, .jssora11r {
                    display: block;
                    position: absolute;
                    /* size of arrow element */
                    width: 37px;
                    height: 37px;
                    cursor: pointer;
                    background: url(../img/a11.png) no-repeat;
                    overflow: hidden;
                }*/
                .jssora11l { background-position: -11px -41px; }
                .jssora11r { background-position: -71px -41px; }
                .jssora11l:hover { background-position: -131px -41px; }
                .jssora11r:hover { background-position: -191px -41px; }
                .jssora11l.jssora11ldn { background-position: -251px -41px; }
                .jssora11r.jssora11rdn { background-position: -311px -41px; }
            </style>
            <!-- Arrow Left -->
            <span u="arrowleft" class="jssora11l" style="top: 123px; left: 8px;">
            </span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssora11r" style="top: 123px; right: 8px;">
            </span>
            <!--#endregion Arrow Navigator Skin End -->
            <a style="display: none" href="http://www.jssor.com">Bootstrap Slider</a>
        </div>
        <!-- Jssor Slider End -->
    

    <!-- jssor slider scripts-->
    <!-- use jssor.js + jssor.slider.js instead for development -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="./js/jssor.slider.mini.js"></script>
    <script>

        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 2000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 12,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 4,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                }
            };

            //Make the element 'slider1_container' visible before initialize jssor slider.
            $("#slider1_container").css("display", "block");
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    jssor_slider1.$ScaleWidth(parentWidth - 30);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>
	
		<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
		<!...........................Banner footer ....................................................> 
		
			<div id="searchBelowLinks">
				<div class="searchBelowLinksList">
					<a  href="startproj.php" class="searchBelow2">
						<p class="bgSep">
							<span>  <b> feed your requirement in the bid engine </b> </span>
							<span>   <img src="./img/dot.jpg">  </span>
						</p>
					</a>
				</div> 
				<a href="#bottom" style="position:absolute;left:600px;" > <img src="./img/arrow.png">  </a>
				<div class="searchBelowLinksList" >
					<a target="_blank" href="expert.php" class="searchBelow3">
						<p class="bgSep">
							<span> <b>  find an interior designer near you </b></span>
							 <span>  <img src="./img/dot.jpg">  </span>
						</p>
					</a>	
					<div class="clearAll"> </div>
				</div>
			</div>
		 
		
			<!....END OF BANNER  FOOTER...> 
		<script> 
		$('a[href^="#"]').on('click', function(event) {

    var target = $( $(this).attr('href') );

    if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    }

});
</script>

	<!................................ SECTION II : DEEP FISHING IMAGE .,................... > 	
	<div class="place"  id="bottom"> 
		<img src="./img/deepfishing.jpg" style="width:100%;max-width:100%; height:auto;"> 
			
	</div>	
	<!................................END OF SECTION II ....................................> 
	
	
	<!.................................. Section III : WHAT WE DO ...........................> 
	<div class="blackpage"> 
		<img src="./img/wwd.jpg" style="width:100%;max-width:100%; height:auto;" >
	</div>
	<!................................END OF SECTION III.......................................>
	
	<!.. ............................SECTION IV : CUSTOMER STORIES.................................. ....  >

	<div class="container">
			<h1>Love letters to us </h1>
			<div id="ca-container" class="ca-container">
				<div class="ca-wrapper" style="overflow-x:hidden;">
				  <?php while($fetch_stories = mysql_fetch_assoc($exec_stories)){?>
					<div class="ca-item ca-item-1">
					<a href="cust_story.php?id=<?php echo $fetch_stories['id'];?>">
					<img src="./img/<?php echo $fetch_stories['image'];?>"> 
						<div class="ca-item-main">
							<div class="ca-icon"></div>
								<h5> <?php echo $fetch_stories['title'];?> </h5>
								<h4>Posted By : <cite title="Source Title"><?php echo $fetch_stories['title'];?></cite><br>On Date : <?php echo date("d-M-Y",$fetch_stories['time']);?> </h4>
						</div>
						</a> 
					</div>
		
					  <?php }?>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="./js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="./js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>
	
	
	
	<!.................................END OF SECTION :CUSTOMER STORIES .............................. >
	
	<!.. ..............................SECTION V : IN THE MEDIA .................................. ..> 
	<hr style="border-top: 1px solid #CDCCCD;">
		<div id="media" class="container-fluid content-page"> 
			<br><br> 
				<p class="text-center" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;">Media</p>
					<div class="row"> 
						<div class="panel panel-primary col-sm-2" style="margin-left:9%;padding:0;width: 270px;height: 170px;border: gray 1px solid !important;">
							<div class="panel-body" style="">
								<a target="_blank" href="http://techstory.in/makeuber/"><img style="border-radius:5px;" src="./img/media1.png" width="240px" height="140px"></a>
							</div>  
						</div>
						<div class="panel panel-primary col-sm-2" style="margin-left:9%;padding:0;width: 270px;height: 170px;border: gray 1px solid !important;">
							<div class="panel-body" style="">
								<a target="_blank" href="http://anthahprerana.org"><img style="border-radius:5px;" src="./img/media2.png" width="240px" height="140px"></a>
							</div> 
						</div>
						<div class="panel panel-primary col-sm-2" style="margin-left:9%;padding:0;width: 270px;height: 170px;border: gray 1px solid !important;">
							<div class="panel-body" style="">
								<a target="_blank" href="http://weekendventures.org/startuplounge/tlabs-bangalore-dec-2014/"><img style="border-radius:5px;" src="./img/media3.jpg" width="240px" height="140px"></a>
							</div>  
						</div>
					</div>
			</div>
					
					
	<!..........................................END OF IN THE MEDIA SECTION .............................................> 
	
	
	<!.. .......................................SECTION VI : FOOTER................................................. ..  > 
	<div id="" class="row" style="background-color:#000;">
	<div class="col-sm-3" style="font-size:25pt;padding:20px;">
		<h6 style="color:white;"> Stalk us on Social Media </h6>
		<a href="https://twitter.com/makeuber">
		<img title="Twitter" src="./images/twit.png" alt="Twitter" width="25" height="25" />
		</a>
		<a href="[full link to your Pinterest]">
		<img title="Pinterest" src="./images/pin.png" alt="Pinterest" width="25" height="25" />
		</a> 
		<a href="https://www.facebook.com/MakeUber">
		<img title="Facebook" src="./images/facebook.png" alt="Facebook" width="25" height="25" />
		</a>
		<a href="https://plus.google.com/+MakeUber"><img title="google" src="./images/google.png" alt="RSS" width="25" height="25" />
		</a>
				<a href="https://www.linkedin.com/company/makeuber"><img title="google" src="./images/in.png" alt="RSS" width="25" height="25" />
		</a><br>
		<div class="fb-like" data-href="https://www.facebook.com/MakeUber" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
		</div>
		
			<div class="col-sm-5" style="position:relative;top:45px;text-align:center;">
		<ul class="footer-menu" style="font-size:11px;">
			<li class="active"><a href="Index.php">Home</a></li>
			<li><a href="toolgrid.php">tool grid </a></li>
			<li><a href="aboutus.php">about us</a></li>
			<li><a href="blog_front.php">blog</a></li>
			<li><a href="contactus.php">contact us</a></li>
			<li><a href="register.php"> register </a></li>
		</ul>
	</div>
	<div class="col-sm-6" style="text-align:center;color:white;">
		<span style="font-size:13px;font-family: 'Yanone Kaffeesatz', sans-serif;"></span>
	</div>
	<div class="col-sm-3" style="font-size:13px;color:white;position:relative;top:30px;">
		
		<span class="glyphicon glyphicon-envelope"> reachus@makeuber.com</span>&nbsp;&nbsp;<br>
		<span class="glyphicon glyphicon-earphone"> 91-08039591930</span></p>
	</div>
	<div class="col-sm-12">
		<hr style="border:1px solid #111;margin-bottom:10px;">
	</div>
	<div class="col-sm-12">
		<strong style="color:white;font-size:11px;"> Modadome Online Pvt Ltd &copy; </strong> 
	
		<strong style="color:white;font-size:11px;"> MakeUber 2015 | <a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms &amp; Conditions</a></strong></div>
	</div>
</div>
<!.....................................END OF FOOOTER..................................>
<!....Modal ..  .>

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
				<span class="pull-left">Don't have an account? <a href="register.php" style="color:blue">Sign up</a> now!</span>
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

	<!-- Latest compiled and minified JavaScript -->

	
	<script src="./js/jquery-2.1.4.min.js"> </script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	
	</body> 
</html> 
