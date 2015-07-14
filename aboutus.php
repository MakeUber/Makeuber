<?php
error_reporting(0);
include('init.php');
include('config_db.php');
include('config.php');
$is_stacked = isset($_REQUEST['stacked']);
$sql = "SELECT * from team  ";
$sql_result = mysql_query ($sql ) or die ('request "Could not execute SQL query" '.$sql);
$rows = array();
while ($row = mysql_fetch_assoc($sql_result)){
  $rows[] = $row;
}
?>

<!doctype HTML>
<html>
	<head>
		<title> About Us </title>  
		<meta name="title" content=" We Help You Make Your Dream Home | MakeUber">
		<meta name="description" content=" MakeUber helps you find and select the best interior designers, architects, custom furniture sellers and other experts for all your home interior and design needs. Browse photos, chat withus and get professional advice.">
		<meta name="Keywords" content="Niraj Bohra , Technology ,LikedIn , Lisa , Co Founder , Meet us ">
		<link rel ="stylesheet" href="css/bootstrap.min.css">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
			<link rel="stylesheet" href="/Muber\css/custom.css">

			<script type="text/javascript" src="js/jquery.js"></script>
			<script src = "js/jsfunction.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/Style.css">
	
	<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
<style> 
/*! HTML5 Boilerplate v4.3.0 | MIT License | http://h5bp.com/ */
/*
 * What follows is the result of much research on cross-browser styling.
 * Credit left inline and big thanks to Nicolas Gallagher, Jonathan Neal,
 * Kroc Camen, and the H5BP dev community and team.
 */
/* ==========================================================================
   Base styles: opinionated defaults
   ========================================================================== */
html,
button,
input,
select,
textarea {
  color: #222;
}
html {
  font-size: 1em;
  line-height: 1.4;
}
/*
 * Remove text-shadow in selection highlight: h5bp.com/i
 * These selection rule sets have to be separate.
 * Customize the background color to match your design.
 */
::-moz-selection {
  background: #b3d4fc;
  text-shadow: none;
}
::selection {
  background: #b3d4fc;
  text-shadow: none;
}
/*
 * A better looking default horizontal rule
 */
hr {
  display: block;
  height: 1px;
  border: 0;
  border-top: 1px solid #ccc;
  margin: 1em 0;
  padding: 0;
}
/*
 * Remove the gap between images, videos, audio and canvas and the bottom of
 * their containers: h5bp.com/i/440
 */
audio,
canvas,
img,
video {
  vertical-align: middle;
}
/*
 * Remove default fieldset styles.
 */
fieldset {
  border: 0;
  margin: 0;
  padding: 0;
}
/*
 * Allow only vertical resizing of textareas.
 */
textarea {
  resize: vertical;
}
/* ==========================================================================
   Browse Happy prompt
   ========================================================================== */
.browsehappy {
  margin: 0.2em 0;
  background: #ccc;
  color: #000;
  padding: 0.2em 0;
}
/* ==========================================================================
   Author's custom styles
   ========================================================================== */
/*! normalize.css v2.1.3 | MIT License | git.io/normalize */
article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
main,
nav,
section,
summary {
  display: block;
}
audio,
canvas,
video {
  display: inline-block;
}
audio:not([controls]) {
  display: none;
  height: 0;
}
[hidden],
template {
  display: none;
}
html {
  font-family: sans-serif;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}
body {
  margin: 0;
}
a {
  background: transparent;
}
a:focus {
  outline: thin dotted;
}
a:active,
a:hover {
  outline: 0;
}
h1 {
  font-size: 2em;
  margin: 0.67em 0;
}
abbr[title] {
  border-bottom: 1px dotted;
}
b,
strong {
  font-weight: bold;
}
dfn {
  font-style: italic;
}
hr {
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  height: 0;
}
mark {
  background: #ff0;
  color: #000;
}
code,
kbd,
pre,
samp {
  font-family: monospace, serif;
  font-size: 1em;
}
pre {
  white-space: pre-wrap;
}
q {
  quotes: "\201C" "\201D" "\2018" "\2019";
}
small {
  font-size: 80%;
}
sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}
sup {
  top: -0.5em;
}
sub {
  bottom: -0.25em;
}
img {
  border: 0;
}
svg:not(:root) {
  overflow: hidden;
}
figure {
  margin: 0;
}
fieldset {
  border: 1px solid #c0c0c0;
  margin: 0 2px;
  padding: 0.35em 0.625em 0.75em;
}
legend {
  border: 0;
  padding: 0;
}
button,
input,
select,
textarea {
  font-family: inherit;
  font-size: 100%;
  margin: 0;
}
button,
input {
  line-height: normal;
}
button,
select {
  text-transform: none;
}
button,
html input[type="button"],
input[type="reset"],
input[type="submit"] {
  -webkit-appearance: button;
  cursor: pointer;
}
button[disabled],
html input[disabled] {
  cursor: default;
}
input[type="checkbox"],
input[type="radio"] {
  box-sizing: border-box;
  padding: 0;
}
input[type="search"] {
  -webkit-appearance: textfield;
  -moz-box-sizing: content-box;
  -webkit-box-sizing: content-box;
  box-sizing: content-box;
}
input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-decoration {
  -webkit-appearance: none;
}
button::-moz-focus-inner,
input::-moz-focus-inner {
  border: 0;
  padding: 0;
}
textarea {
  overflow: auto;
  vertical-align: top;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

ul.member-list {
  padding-left: 0;
  list-style: none;
  
}
ul.member-list > li {
  display: inline-block;
  width: 230px;
  min-height:420px;
  background: white;
  padding: 15px;
  margin: 15px;
  border-radius: 6px;
  -webkit-box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.3);
  opacity: 1;
  filter: alpha(opacity=100);
  color: #AAACAF;
  font-size: 14px;
  font-weight: 400;
  -webkit-transition: -webkit-transform 600ms ease, opacity 600ms ease, left 600ms ease, top 600ms ease;
  -moz-transition: -moz-transform 600ms ease, opacity 600ms ease, left 600ms ease, top 600ms ease;
  -o-transition: -o-transform 600ms ease, opacity 600ms ease, left 600ms ease, top 600ms ease;
  -ms-transition: -ms-transform 600ms ease, opacity 600ms ease, left 600ms ease, top 600ms ease;
  transition: transform 600ms ease, opacity 600ms ease, left 600ms ease, top 600ms ease;
}
ul.member-list > li > img.photo {
  border: 4px solid #E5E5E5;
  margin: 0 auto;
  display: block;
  max-width: 100%;
  height: auto;
  margin-bottom: 15px;
  
}
ul.member-list > li .title {
  color: #F5682B;
  font-weight: 700;
  border-bottom: 1px solid #F0F0F0;
  padding-bottom: 10px;
  font-size: 16px;
}
ul.member-list > li p {
  margin: 10px 0;
}
ul.member-list > li a {
  text-decoration: none;
  color: #AAACAF;
  border-bottom: 1px dotted #AAACAF;
}
ul.member-list > li a:hover {
  border-bottom: none;
}
ul.member-list.stacked {
  width: 230px;
  height: 440px;
  background: white;
  margin: 0 auto 15px auto;
  border-radius: 5px;
  -webkit-box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.3);
  position: relative;
}
ul.member-list.stacked > li {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  margin: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
}
ul.member-list.stacked > li > img.photo {
  width: 200px;
  height: 200px;
}
ul.member-list.stacked:after {
  content: "";
  position: absolute;
  bottom: 4px;
  left: 4px;
  right: 4px;
  height: 10px;
  background: #fff;
  border-radius: 5px;
  z-index: 999;
  -webkit-box-shadow: 0px 3px 2px -1px rgba(0, 0, 0, 0.1);
  box-shadow: 0px 3px 2px -1px rgba(0, 0, 0, 0.1);
}
ul.social-link {
  padding-left: 0;
  list-style: none;
  min-height:30px;
}
ul.social-link > li {
  display: inline-block;
  padding-left: 5px;
  padding-right: 5px;
}
ul.social-link > li:first-child {
  padding-left: 0;
}
ul.social-link a {
  font-size: 24px;
  color: #999999;
  border: none !important;
}
ul.social-link a:hover {
  color: #555555;
}
.prev-next {
  text-align: center;
}
.prev-next a {
  display: inline-block;
  width: 40px;
  height: 40px;
  line-height: 36px;
  border: 2px solid #D3D3D3;
  border-radius: 20px;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#fefefe), to(#f3f3f3));
  background-image: -webkit-linear-gradient(top, #fefefe 0%, #f3f3f3 100%);
  background-image: -moz-linear-gradient(top, #fefefe 0%, #f3f3f3 100%);
  background-image: linear-gradient(to bottom, #fefefe 0%, #f3f3f3 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffefefe', endColorstr='#fff3f3f3', GradientType=0);
  color: #666666;
  -webkit-box-shadow: 0px 1px 7px 1px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 1px 7px 1px rgba(0, 0, 0, 0.2);
  padding-left: 3px;
  outline: none;
}
.prev-next a:first-child {
  padding-left: 0px;
  padding-right: 3px;
}
.prev-next a:hover {
  -webkit-box-shadow: 0px 1px 2px 1px rgba(0, 0, 0, 0.15) inset;
  box-shadow: 0px 1px 2px 1px rgba(0, 0, 0, 0.15) inset;
}
/* ==========================================================================
   Helper classes
   ========================================================================== */
.hide {
  display: none !important;
}
.show {
  display: block !important;
}
.one-line {
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}
.arrow-up {
  border-left-color: transparent;
  border-right-color: transparent;
  border-top-style: none;
}
.arrow-down {
  border-left-color: transparent;
  border-right-color: transparent;
  border-bottom-style: none;
}
.arrow-right {
  border-top-color: transparent;
  border-bottom-color: transparent;
  border-right-style: none;
}
.arrow-left {
  border-top-color: transparent;
  border-bottom-color: transparent;
  border-left-style: none;
}
.arrow {
  width: 0;
  height: 0;
  display: inline-block;
  vertical-align: middle;
  border-color: white;
  border-width: 5px;
  border-style: solid;
}
.arrow.up {
  border-left-color: transparent;
  border-right-color: transparent;
  border-top-style: none;
}
.arrow.down {
  border-left-color: transparent;
  border-right-color: transparent;
  border-bottom-style: none;
}
.arrow.right {
  border-top-color: transparent;
  border-bottom-color: transparent;
  border-right-style: none;
}
.arrow.left {
  border-top-color: transparent;
  border-bottom-color: transparent;
  border-left-style: none;
}
/*
 * Image replacement
 */
.ir {
  background-color: transparent;
  border: 0;
  overflow: hidden;
  /* IE 6/7 fallback */
  *text-indent: -9999px;
}
.ir:before {
  content: "";
  display: block;
  width: 0;
  height: 150%;
}
/*
 * Hide from both screenreaders and browsers: h5bp.com/u
 */
.hidden {
  display: none !important;
  visibility: hidden;
}
/*
 * Hide only visually, but have it available for screenreaders: h5bp.com/v
 */
.visuallyhidden {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}
/*
 * Extends the .visuallyhidden class to allow the element to be focusable
 * when navigated to via the keyboard: h5bp.com/p
 */
.visuallyhidden.focusable:active,
.visuallyhidden.focusable:focus {
  clip: auto;
  height: auto;
  margin: 0;
  overflow: visible;
  position: static;
  width: auto;
}
/*
 * Hide visually and from screenreaders, but maintain layout
 */
.invisible {
  visibility: hidden;
}
/*
 * Clearfix: contain floats
 *
 * For modern browsers
 * 1. The space content is one way to avoid an Opera bug when the
 *    `contenteditable` attribute is included anywhere else in the document.
 *    Otherwise it causes space to appear at the top and bottom of elements
 *    that receive the `clearfix` class.
 * 2. The use of `table` rather than `block` is only necessary if using
 *    `:before` to contain the top-margins of child elements.
 */
.clearfix:before,
.clearfix:after {
  content: " ";
  /* 1 */
  display: table;
  /* 2 */
}
.clearfix:after {
  clear: both;
}
/*
 * For IE 6/7 only
 * Include this rule to trigger hasLayout and contain floats.
 */
.clearfix {
  *zoom: 1;
}
/* ==========================================================================
   EXAMPLE Media Queries for Responsive Design.
   These examples override the primary ('mobile first') styles.
   Modify as content requires.
   ========================================================================== */
@media only screen and (min-width: 35em) {
  /* Style adjustments for viewports that meet the condition */
}
@media print, (-o-min-device-pixel-ratio: 5/4), (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi) {
  /* Style adjustments for high resolution devices */
}
/* ==========================================================================
   Print styles.
   Inlined to avoid required HTTP connection: h5bp.com/r
   ========================================================================== */
@media print {
  * {
    background: transparent !important;
    color: #000 !important;
    /* Black prints faster: h5bp.com/s */
    box-shadow: none !important;
    text-shadow: none !important;
  }
  a,
  a:visited {
    text-decoration: underline;
  }
  a[href]:after {
    content: " (" attr(href) ")";
  }
  abbr[title]:after {
    content: " (" attr(title) ")";
  }
  /*
     * Don't show links for images, or javascript/internal links
     */
  .ir a:after,
  a[href^="javascript:"]:after,
  a[href^="#"]:after {
    content: "";
  }
  pre,
  blockquote {
    border: 1px solid #999;
    page-break-inside: avoid;
  }
  thead {
    display: table-header-group;
    /* h5bp.com/t */
  }
  tr,
  img {
    page-break-inside: avoid;
  }
  img {
    max-width: 100% !important;
  }
  @page {
    margin: 0.5cm;
  }
  p,
  h2,
  h3 {
    orphans: 3;
    widows: 3;
  }
  h2,
  h3 {
    page-break-after: avoid;
  }
}
a:hover{color:white;
text-decoration:none;}

</style>
	</head>
				
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
			$(location).attr('href','user_profile.php'); 
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
<style> 
</style> 
	<body> 
		<?php include "include/header.php" ?>
		<!.........................HEADER ENDS ................................> 
		
				<!-- .container-fluid -->
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


				<img src="img/aboutus.jpg" style="width:100%;max-width:100%; height:auto;">
				<img src="img/team.jpg" style="max-width:100%; height:auto;"> 
					
			
					
<ul id="member-list" class="member-list<?php echo $is_stacked?' stacked':''; ?>">
            <?php foreach ($rows AS $v): ?>
            <li>
                <?php if (!empty($v['photo'])): ?>
                    <img class="photo" src="<?php echo $v['photo']; ?>">
                <?php endif; ?>
                <div class="title"><?php echo $v['name']; ?></div>
                <p><?php echo $v['position']; ?>, <?php echo $v['company']; ?></p>
                <p><?php echo $v['phone']; ?></p>
                <p><?php echo $v['website']; ?></p>
				<p>LinkedIn :&nbsp; <a href="<?php echo "https://www.linkedin.com/in/".$v['email']; ?>" target="_blank"><?php echo $v['email']; ?></a></p>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php if ($is_stacked): ?>
        <div class="prev-next">
            <a id="prev" href="#prev"><i class="fa fa-caret-left"></i></a>
            <a id="next" href="#next"><i class="fa fa-caret-right"></i></a>
        </div>
        <?php endif; ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/team.js"></script>
	
	

	
	<div id="" class="row" style="background-color:#000;">
	<div class="col-sm-3" style="font-size:11px;padding:20px;">
		<h6 style="color:white;"> Stalk us on Social Media </h6>
		<a href="https://twitter.com/makeuber">
		<img title="Twitter" src="images/twit.png" alt="Twitter" width="25" height="25" />
		</a>
		<a href="https://in.pinterest.com/makeuber/">
		<img title="Pinterest" src="images/pin.png" alt="Pinterest" width="25" height="25" />
		</a> 
		<a href="https://www.facebook.com/MakeUber">
		<img title="Facebook" src="images/facebook.png" alt="Facebook" width="25" height="25" />
		</a>
		<a href="https://plus.google.com/+MakeUber"><img title="google" src="images/google.png" alt="RSS" width="25" height="25" />
		</a>
				<a href="https://www.linkedin.com/company/makeuber"><img title="google" src="images/in.png" alt="RSS" width="25" height="25" />
		</a>
		<a href="https://www.youtube.com/channel/UCK-55LvkPy9dgVo4AicfAmw">
		<img title="Facebook" src="images/yt.png" alt="Facebook" width="25" height="25" />
		</a>
		<br>
		<div class="fb-like" data-href="https://www.facebook.com/MakeUber" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
		</div>
		
		
	
	<div class="col-sm-6" style="text-align:center;color:white;">

		<span style="font-size:13px;font-family: 'Yanone Kaffeesatz', sans-serif;"></span>
		<ul class="footer-menu" style="font-size:13px;position:relative;top:45px;text-align:center;text-decoration:none;">
			<li><a href="Index.php">Home</a></li>
			<li><a href="toolgrid.php">tool grid </a></li>
			<li><a href="aboutus.php">about us</a></li>
			<li><a href="blog_front.php">blog</a></li>
			<li><a href="contactus.php">contact us</a></li>
			<li><a href="Register.php"> register </a></li>
			<li><a href="job.php"> we are hiring </a> </li>
		</ul>
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

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/main.js"></script> <!-- Gem jQuery -->
	<script src="C:\wamp\www\Muber\js\jquery-2.1.4.min.js"> </script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body> 
</html>
