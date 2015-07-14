<?php
include('init.php');
include('config_db.php');
include('config.php');

$dvar['category']= $_GET['category'];

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<meta name="title" content=" We Help You Make Your Dream Home | MakeUber">
<meta name="description" content=" MakeUber helps you find and select the best interior designers, architects, custom furniture sellers and other experts for all your home interior and design needs. Browse photos, chat withus and get professional advice.">

<link rel="stylesheet" href="./css/custom.css">
<link rel ="stylesheet" href="./css/Style.css">

<link rel="stylesheet" type="text/css" href="./css/project.css" />
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script src = "./js/jquery.js" type="text/javascript"></script>
<script src = "./js/jquery-ui.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/expert.js"></script>
<script type="text/javascript" src="./js/jsfunction.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style> 
.footer-menu a:hover { color:white;text-decoration:none ; } 
</style> 
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
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

<style type="text/css">
* imports */
@import url(http://fonts.googleapis.com/css?family=Lobster);

/* resets */
*,
*:before,
*:after {
 box-sizing: border-box;
}
.clearfix:after {
    content: "";
  display: table;
  clear: both;
}

/* global */
body {
	background-image: url('./img/projectgrid.jpg');
	background-repeat:no-repeat;
	background-color:#2D3E50;
  color: rgb(100,100,100);
  font-family: sans-serif;
  font-size: 14px;
  line-height: 1.3;
}
.wrapper {
  margin: 0 auto;
  margin-right:100px;
  margin-top:20px;
  padding: 0px;
  max-width:62%;
  max-height:100%;
  background-color:#2d3e50;
  font-family:Helvetica;
  text-align:center;
   white-space: nowrap;
   
 
}
@import "compass/css3";

.flex-container {
  padding: 0;
  margin: 0;
  margin-top:0px;
  list-style: none; 	
 
  
	
  
  display: -webkit-box;
  display: -moz-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  
 

}

.flex-item1 {
  background-color:#A0522D;
  padding: 0px;
  width: 155px;
  height: 158px;
  margin-top:20px; 	
  margin-right:0px;
  color: white;
  font-weight: bold;
  font-size: 10pt;
  text-align: center;
}


.flex-item2 {
  background-color:#008000; 
  padding: 0px;
  width: 150px;
  height: 150px;
  margin-top:0px; 
  margin-right:0px;
  color: white;
  font-weight: bold;
  font-size: 10pt;
  text-align: center;
  box-shadow:5px 5px 5px #fff;
}
.flex-item3 {
  background-color:#E1163A;
  padding: 0px;
  width: 150px;
  height: 150px;
  margin-top:2px; 
  margin-right:0px;
  color: white;
  font-weight: bold;
  font-size: 10pt;
  text-align: center;
}
.flex-item4 {
  background-color:#593E93;
  padding: 0px;
  width: 150px;
  height: 150px;
  margin-top:2px; 
  margin-right:0px;
  color: white;
  font-weight: bold;
  font-size: 10pt;
  text-align: center;
}
.flex-item5 {
  background-color:#000;
  padding: 0px;
  width: 150px;
  height: 150px;
  margin-top:2px; 
  margin-right:0px;
  color: white;
  font-weight: bold;
  font-size: 10pt;
  text-align: center;
}
.flex-item6 {
  background-color:#800000;
  padding: 0px;
  width: 150px;
  height: 150px;
  margin-top:2px; 
  margin-right:0px;
  color: white;
  font-weight: bold;
  font-size: 10pt;
  text-align: center;
}
.slab1 {
  background:#2d3e50;
  padding: 5px;
  width: 120px;
  height: 50px;
  color: white;
  font-weight: bold;
  font-size: 5pt;
  text-align: left;
  
 
}

</style>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('.photo-modal').data('show','false');
		$('.photo-wrap').click(function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			//alert(id);
			$('body').append('<div class="blur"></div>');
			$('#photo-modal'+id).fadeIn();
			$('#photo-modal'+id).data('show','true');
		});
	
		$('.close').click(function(e){
			e.preventDefault();
			$('.photo-modal').fadeOut();
			$('.blur').remove();
			$('#photo-modal'+id).data('show','false');
		});
		
		
		
	});
	function sel_city1(){
	 var city = $('.city').val();
	//alert(city); 
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=sel_city&city="+city,
      success: function(rep)
    {
  //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
   //alert(response_array[0]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }

  if(response_array[0] == 'Success')
  {
   //alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.area').html('');
	$('.area').append(response_array[1]);
	setTimeout($("#frm").submit(),5000);
	//$("#frm").submit();
  }
 }
  });
  return false;
 }
 
 $(document).on('click','.readmore',function(){
		var id=$(this).data('id');
		$('#expert').val(id);
	});

</script>
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">
<?php include "./include/header.php"?>
	
		<!.........................HEADER ENDS ................................> 

		<h4 style="position:absolute;top:120px;left:200px;color:white;"> Above 15 Lakhs </h4>	
		<h4 style="position:absolute;top:280px;left:200px;color:white;"> 8 - 14.9 Lakhs </h4>	
		<h4 style="position:absolute;top:450px;left:200px;color:white;"> 5 - 7.9 Lakhs </h4>	
		<h4 style="position:absolute;top:620px;left:200px;color:white;"> 2 - 4.9  Lakhs </h4>	
		<h4 style="position:absolute;top:800px;left:200px;color:white;">  0 - 1.9  Lakhs </h4>	
<div class="wrapper">
		<ul> 
					<?php 
					$query = "select  project.project_id , project.apartment , project.price ,project.city , project.area , budget.id  from project INNER JOIN budget ON project.price = budget.budget where budget.id='6'" ; 
					$fetch = mysql_query ( $query ) ;
					while ( $row = mysql_fetch_assoc ( $fetch )  ) 		
					{
						
						$_POST[ 'project_id' ] ; 
					?> 
					<div class="nd-wrap nd-style-1">
					<ul class="flex-container">
				
					<div class="flip-container"  >
						<div class="front1" >
							<li class="flex-item1"><br><br><?php echo $row ['city'] ; ?> <br><?php echo $row ['area'] ;?> <br><?php echo $row ['apartment'] ;?> 
						</div>
					</div>
				<?php 
					// Checking for expert or user 
					if ( $fetch_user [ 'type' ] == '1' ) {
				?> 
				
					<div class="nd-content">
						<div class="nd-content_inner">
							<div class="nd-content_inner1">
								<h6 class="nd-title"><span>Upload | Download </span></h6>
									
									<span class="nd-icon">
											<?php    
											// Checking for inactive or active where 1 is active and 0 is inactive 
											if ( $fetch_user ['status'] == '1' ) 
											{ 
											?>
											<br> <a href="uploadquote.php?query&project_id=<?php echo $row['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-upload"> </a>  <?php }  
											else { ?> <br>
												<a href="#" >
													 <span class="glyphicon glyphicon-upload">  </span>
												</a> 
											<?php }  ?> 
									</span>
									
									<span class="nd-icon">
											<?php    
											// Checking for inactive or active where 1 is active and 0 is inactive 
											if ( $fetch_user ['status'] == '1' ) 
											{ 
											?>
											<br> <a href="trydownload.php?query&project_id=<?php echo $row['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-download"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-download"> </a>  <?php }  ?>  </span>
									</span>
							</div>					
						</div>	
					</div>
				<?php } 
				// If type user it displays only box 
				else {  } 
				?> 
				
					</ul> 
					</div>
					<?php }?>
			</ul>
			

		
					<!-- Second Slab of budget --> 
			<ul> 
			
				<?php 
				$query1 = "select project.project_id , project.apartment , project.price ,project.city , project.area , budget.id  from project INNER JOIN budget ON project.price = budget.budget where budget.id='5'" ; 
				$fetch1 = mysql_query ( $query1 ) ;
				while ( $row1 = mysql_fetch_assoc ( $fetch1 )  ) 
				{
				?> 
				<div class="nd-wrap nd-style-1">
				<ul class="flex-container">
				<div class="flip-container"  >
					<div class="front1" >
						<li class="flex-item2"><br> <?php echo $row1 ['city']; ?> <br><?php echo $row1 ['area'] ;?><br> <?php echo $row1 ['apartment'] ;?>
					</div>
				</div>
				<?php   if (  $fetch_user ['type']=='1' )  {  ?> 
				<div class="nd-content">
					<div class="nd-content_inner">
						<div class="nd-content_inner1">
							<h3 class="nd-title">
								<h6 class="nd-title"><span>Upload | Download </span></h6>
								<span class="nd-icon">
											<?php    
											// Checking for inactive or active where 1 is active and 0 is inactive 
											if ( $fetch_user ['status'] == '1' ) 
											{ 
											?>
											<br> <a href="uploadquote.php?query&project_id=<?php echo $row1['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-upload"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-upload"> </a>  <?php }  ?>  </span>
									
									</span>
								<span class="nd-icon">
									<?php  if ( $fetch_user ['status'] == '1' ) { ?> <br> <a href="trydownload.php?query&project_id=<?php echo $row1['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-download"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-download"> </a>  <?php }   ?>  </span>
								</span>
						</div>					
					</div>				
				</div>
			<?php	}  else {  } ?>  
				</ul> 
				</div>
			<?php }?>
		</ul>


					
		<!--Third Slab-->
		
		<ul> 
					<?php 
					$query2 = "select project.project_id , project.apartment , project.price ,project.city ,  project.area , budget.id  from project INNER JOIN budget ON project.price = budget.budget where budget.id='4'" ; 
					$fetch2 = mysql_query ( $query2 ) ;
					while ( $row2 = mysql_fetch_assoc ( $fetch2 )  ) 		
					{
					?> 
					<div class="nd-wrap nd-style-1">
					<ul class="flex-container">
					<div class="flip-container"  >
						<div class="front1" >
							<li class="flex-item3"><br><?php echo $row2 ['city']; ?> <br> <?php echo $row2 ['area'] ;?> <br><?php echo $row2 ['apartment'] ;?>
						</div>
					</div>
					<?php 
					 if (  $fetch_user ['type']=='1' )  { 
					 ?> 
					<div class="nd-content">
						<div class="nd-content_inner">
							<div class="nd-content_inner1">
								<h3 class="nd-title"><h6 class="nd-title"><span>Upload | Download </span></h6>
									<span class="nd-icon">
											<?php    
											// Checking for inactive or active where 1 is active and 0 is inactive 
											if ( $fetch_user ['status'] == '1' ) 
											{ 
											?>
											<br> <a href="uploadquote.php?query&project_id=<?php echo $row2['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-upload"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-upload"> </a>  <?php }  ?>  </span>
									</span>
									<span class="nd-icon">
										<?php   if ( $fetch_user ['status'] == '1' ) { ?> <br> <a href="trydownload.php?query&project_id=<?php echo $row2['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-download"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-download"> </a>  <?php }   ?>  </span>
									</span>
								</div>					
							</div>				
						</div>
					<?php }  else {  } ?>   
						</ul> 
					</div>
					<?php }?>
			</ul>

		

						<!--Fourth Slab--> 
		<ul>
					<?php 
					$query3 = "select project.project_id , project.apartment , project.price , project.city , project.area , budget.id  from project INNER JOIN budget ON project.price = budget.budget where budget.id='3'" ; 
					$fetch3 = mysql_query ( $query3 ) ;
					while ( $row3 = mysql_fetch_assoc ( $fetch3 )  ) 
					{
					?> 
				<div class="nd-wrap nd-style-1">
				<ul class="flex-container">
				<div class="flip-container"  >
					<div class="front1" >
						<li class="flex-item4"><br><?php echo $row3['city'];?> <br> <?php echo $row3 ['area'] ;?> <br><?php echo $row3 ['apartment'] ;?>
					</div>
				</div>
				<?php if (  $fetch_user ['type']=='1' )  { ?> 
				<div class="nd-content">
					<div class="nd-content_inner">
						<div class="nd-content_inner1">
							<h3 class="nd-title"><h6 class="nd-title"><span>Upload | Download </span></h6>
								<span class="nd-icon">
											<?php    
											// Checking for inactive or active where 1 is active and 0 is inactive 
											if ( $fetch_user ['status'] == '1' ) 
											{ 
											?>
											<br> <a href="uploadquote.php?query&project_id=<?php echo $row3['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-upload"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-upload"> </a>  <?php }  ?>  </span>
									</span>
								<span class="nd-icon">
									<?php    if ( $fetch_user ['status'] == '1' ) { ?> <br> <a href="trydownload.php?query&project_id=<?php echo $row3['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-download"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-download"> </a>  <?php }  ?>  </span>
								</span>
						</div>					
					</div>				
				</div>
				<?php }  else {    } ?>
				</ul> 
				</div>
			<?php } ?> 
		</ul>
			<!-- Fifth slab --> 
			<ul>
					<?php 
					$query4 = "select project.project_id , project.apartment , project.price ,project.city,  project.area , budget.id  from project INNER JOIN budget ON project.price = budget.budget where budget.id='2'" ; 
					$fetch4 = mysql_query ( $query4 ) ;
					while ( $row4 = mysql_fetch_assoc ( $fetch4 )  ) 
					{
					?> 
				<div class="nd-wrap nd-style-1">
				<ul class="flex-container">
				<div class="flip-container"  >
					<div class="front1" >
						<li class="flex-item5"><br><?php echo $row4 ['city' ] ; ?> <br> <?php echo $row4 ['area'] ;?><br><?php echo $row4 ['apartment'] ;?>
					</div>
				</div>
				<?php if (  $fetch_user ['type']=='1' )  { ?> 
				<div class="nd-content">
					<div class="nd-content_inner">
						<div class="nd-content_inner1">
							<h3 class="nd-title"><h6 class="nd-title"><span>Upload | Download </span></h6>
								<span class="nd-icon">
											<?php    
											// Checking for inactive or active where 1 is active and 0 is inactive 
											if ( $fetch_user ['status'] == '1' ) 
											{ 
											?>
											<br> <a href="uploadquote.php?query&project_id=<?php echo $row4['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-upload"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-upload"> </a>  <?php }  ?>  </span>
									</span>
								<span class="nd-icon">
									<?php     if ( $fetch_user ['status'] == '1' ) { ?> <br> <a href="trydownload.php?query&project_id=<?php echo $row4['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-download"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-download"> </a>  <?php }   ?>  </span>
								</span>
						</div>					
					</div>				
				</div>
				 <?php }  else {  } ?>
			</ul> 
			</div>
			<?php }?>
			</ul>
			
			<!-- Sixth Slab --> 
					<ul>
					<?php 
					$query5 = "select project.project_id , project.apartment , project.price ,project.city,  project.area , budget.id  from project INNER JOIN budget ON project.price = budget.budget where budget.id='1'" ; 
					$fetch5 = mysql_query ( $query5 ) ;
					while ( $row5 = mysql_fetch_assoc ( $fetch5 )  ) 
					{
					?> 
				<div class="nd-wrap nd-style-1">
				<ul class="flex-container">
				<div class="flip-container"  >
					<div class="front1" >
						<li class="flex-item6"><br><?php echo $row5 ['city' ] ; ?> <br> <?php echo $row5 ['area'] ;?><br><?php echo $row5 ['apartment'] ;?>
					</div>
				</div>
				<?php if (  $fetch_user ['type']=='1' )  { ?> 
				<div class="nd-content">
					<div class="nd-content_inner">
						<div class="nd-content_inner1">
							<h3 class="nd-title"><h6 class="nd-title"><span>Upload | Download </span></h6>
								<span class="nd-icon">
											<?php    
											// Checking for inactive or active where 1 is active and 0 is inactive 
											if ( $fetch_user ['status'] == '1' ) 
											{ 
											?>
											<br> <a href="uploadquote.php?query&project_id=<?php echo $row5['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-upload"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-upload"> </a>  <?php }  ?>  </span>
									</span>
								<span class="nd-icon">
									<?php     if ( $fetch_user ['status'] == '1' ) { ?> <br> <a href="trydownload.php?query&project_id=<?php echo $row5['project_id'].$q_string_pg;?>">  <span class="glyphicon glyphicon-download"> </a>  <?php }   else { ?> <br> <a href="#" > <span class="glyphicon glyphicon-download"> </a>  <?php }   ?>  </span>
								</span>
						</div>					
					</div>				
				</div>
				 <?php }  else {  } ?>
				</ul> 
			</div>
			<?php }?>
			</ul>
		
</div>

<!-- End  of flex --> 


























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
<span style="font-size:15px;color:black;font-family:sans-serif;"> Or connect with </span><br>
              <br>
             <div id="usersocial"> <a href="fb_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary" style="font-family:sans-serif;"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google" style="font-family:sans-serif;"></i> Google</button>
                </a><!-- <a href="twitter_login.php?type=0&path=<?php echo $page;?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</button>
                </a>--> </div>
              <div id="expertsocial" style="display:none"> <a href="fb_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary" style="font-family:sans-serif;"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>" >
                <button type="button" class="btn btn-primary"><i class="fa fa-google" style="font-family:sans-serif;"></i> Google</button>
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

		  

          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>


<div id="" class="row" style="background-color:#000;margin-top:450px">
	<div class="col-sm-3" style="font-size:25pt;padding:20px;">
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
		<div class="fb-like" data-href="https://www.facebook.com/MakeUber" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
		</div>
		
			<div class="col-sm-5" style="position:relative;top:45px;text-align:center;">
		<ul class="footer-menu" style="font-size:13px;">
			<li><a href="Index.php">Home</a></li>
			<li><a href="toolgrid.php">tool grid </a></li>
			<li><a href="aboutus.php">about us</a></li>
			<li><a href="blog_front.php">blog</a></li>
			<li><a href="contactus.php">contact us</a></li>
			<li><a href="Register.php"> register </a></li>
			<li><a href="job.php"> we are hiring!</a></li>
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
	<div class="col-sm-12 privacy">
		<strong style="color:white;font-size:11px;"> Modadome Online Pvt Ltd &copy; </strong> 
	
		<strong style="color:white;font-size:11px;"> MakeUber 2015 | <a href="privacy.php" >Privacy Policy</a> | <a href="terms.php">Terms &amp; Conditions</a></strong></div>
	</div>

		  
	 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		  
		  
		  
</body>
</html>