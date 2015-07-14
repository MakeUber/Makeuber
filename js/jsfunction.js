// JavaScript Document
 function like_review(image_id,userid){
 //alert(userid);
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_likes_reviews&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
  alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);
  }
 }
  });
  return false;
 }
 
 function like_dis(image_id,userid){
	$.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_likes&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
 // alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);
  }
 }
  });
  return false;
 }

function like(image_id,userid){
 //alert(image_id);
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_likes&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
 // alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);
  }
 }
  });
  return false;
 }
 
 function like1(userid){
  var obj = $('.photo-wrap').eq(ind);
  var image_id=$(obj).data('id');
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_likes1&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
 // alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   $("span#review_error").html(response_array[1]);
    $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
  $('.like').html(response_array[1]);
  $('.likes').html(response_array[3]);
  $(obj).find('.tot-like').html(response_array[3]);
  $(obj).data('islike',1);
  }
 }
  });
  return false;
 }


 function send_email(){
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=check",
      success: function(rep)
    {
  alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);
  }
 }
  });
  return false;
 }
 
 
  function login(image_id,userid){
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_likes&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
 // alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);
  }
 }
  });
  return false;
 }
 
  function like(image_id,userid){
  //alert("hi");
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_likes&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
 // alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);
  }
 }
  });
  return false;
 }


  function unlike(image_id,userid){
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=unlikes&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
  //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
  // alert(response_array[2]);
  //alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);

  }
 }
  });
  return false;
 }


 function unlike1(userid){
  var obj = $('.photo-wrap').eq(ind);
  var image_id=$(obj).data('id');
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=unlikes1&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
  //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
  $('.like').html(response_array[1]);
  $('.likes').html(response_array[3]);
  $(obj).find('.tot-like').html(response_array[3]);
  $(obj).data('islike',0);
  }
 }
  });
  return false;
 }
 
    function save_comment(){
      var obj = $('.photo-wrap').eq(ind);
	  var txt = $(obj).find('.tot-comment').text();
	  var total = parseInt(txt)+1;
   // var msg = $('.comments').val();
    //alert(form);
    var form = "form";
    $('input[name="image_id"]').val($(obj).data('id'));
    //alert($('#'+form).serialize());
    $.ajax({
   type: "POST",
   data: $('#'+form).serialize(),
   url: "ajax.php",
   success: function(rep)
   {
 //alert(rep);
  var response_array = rep.split('|::|');
 // alert(response_array[1]);
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
   $("#errormsg").html(response_array[1]);
   $("#errormsg").fadeOut(7000);
  }
  if(response_array[0] == 'Success')
  {
  $('.comments').html('');
  //$('#cmt').html(response_array[2]);

  $('.comments').prepend(response_array[1]);
  $('.img-comment').text(total);
  $('#savecomment').val("");
  $(obj).find('.tot-comment').text(total);
  }
 }  
  });
  return false;
 }
 
//For select categories section on add description page

 function category(){
	 var category = $('.category').val();
	// alert(category); 
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=cat&category="+category,
      success: function(rep)
    {
  //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
   //alert(response_array[2]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }

  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.category_type').html('');
	$('.category_type').append(response_array[1]);
  }
  
  if(response_array[2] == 'Error')
  {
   //alert(response_array[2]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[2] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.material_type').html('');
	$('.material_type').append(response_array[3]);
	
  }
 }
  });
  return false;
 }
//for fixed sq price result
 function like2(image_id,userid){
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_likes2&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
 // alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
   //alert('.like'+response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);
  }
 }
  });
  return false;
 }
 
 function unlike2(image_id,userid){
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=unlikes2&image_id="+image_id+"&userid="+userid,
      success: function(rep)
    {
  //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  // alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }
  if(response_array[0] == 'Success')
  {
  // alert(response_array[2]);
  //alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.like'+response_array[2]).html('');
	$('.like'+response_array[2]).html(response_array[1]);
	$('.likes'+response_array[2]).html(response_array[3]);

  }
 }
  });
  return false;
 }
 
  function save_comment2(form){
	  //alert("hi");
	  var msg = $('.comments').val();
	 
	  var form = "form"+form;
	  //alert($('#'+form).serialize());
	  $.ajax({
   type: "POST",
   data: $('#'+form).serialize(),
   url: "ajax.php",
      success: function(rep)
    {
 	//alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
 // alert(response_array[0]);
//  alert(response_array[1]);
  //alert(response_array[2]);
   $("#errormsg"+response_array[2]).html(response_array[1]);
   $("#errormsg"+response_array[2]).fadeOut(7000);
  }
  if(response_array[0] == 'Success')
  {
 //alert(response_array[0]);
 //alert(response_array[3]);
// alert(response_array[2]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
   //$("#sucmsg").html(response_array[1]);
//   $("#sucmsg").fadeOut(7000);

	$('#comments'+response_array[3]).html('');
	$('#cmt'+response_array[3]).html(response_array[2]);
	$('#comments'+response_array[3]).html(response_array[1]); 
	$('#savecomment'+response_array[3]).val("");
	  }
 }
  });
  return false;
 }
 
 function submit_review()
{
	//alert("hello");
	var info = $('#share_review').serialize();
	//alert(info);
	 $.ajax({
   type: "POST",
   data: info,
   url: "ajax.php",
      success: function(rep)
	{
	//alert(rep);
	var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {

   $("#errormsgs").html('');
   $("#errormsgs").show();
   $("#errormsgs").html(response_array[1]);
   $("#errormsgs").fadeOut(4000);
  }
  if(response_array[0] == 'Success')
  {
	  setTimeout(function () {
        location.reload()
    }, 2000);
	$('#successmsgs').html('');
    $("#successmsgs").html(response_array[1]);
    $("#successmsgs").fadeOut(4000);
	  }
	
	}
  });
  return false;
}

//Deleate comment of Ask project
function del(id,image_id,uniq_id){
	 // alert(id);
	 // alert(image_id);
	// alert(uniq_id);
	  
	  //alert($('#'+form).serialize());
	  $.ajax({
  type: "GET",
   data: "",
   url: "ajax.php?do=delete&id="+id+"&image_id="+image_id+"&uniq_id="+uniq_id,
      success: function(rep)
    {
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
   $("#errormsg"+response_array[2]).html(response_array[1]);
   $("#errormsg"+response_array[2]).fadeOut(7000);
  }
  if(response_array[0] == 'Success')
  {
	 // alert(response_array[0]);
// alert(response_array[1]);
// alert(response_array[2]);
//alert(response_array[3]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
   //$("#sucmsg").html(response_array[1]);
//   $("#sucmsg").fadeOut(7000);
	$('#comments'+response_array[3]).html('');
	$('#cmt'+response_array[3]).html(response_array[2]);
	$('#comments'+response_array[3]).html(response_array[1]); 
	$('#savecomment'+response_array[3]).val("");
	  }
 }
  });
  return false;
 }

//Deleate comment of know your project
function del2(id,image_id,uniq_id,obj){
   //alert(id);
   //alert(uniq_id);
    
    //alert($('#'+form).serialize());
    $.ajax({
  type: "GET",
   data: "",
   url: "ajax.php?do=del2&id="+id+"&image_id="+image_id+"&uniq_id="+uniq_id,
      success: function(rep)
    {
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
   $("#errormsg"+response_array[2]).html(response_array[1]);
   $("#errormsg"+response_array[2]).fadeOut(7000);
  }
  if(response_array[0] == 'Success')
  {
	$('#comments'+response_array[3]).html('');
	$('#cmt'+response_array[3]).html(response_array[2]);
	$('#comments'+response_array[3]).html(response_array[1]); 
	$('#savecomment'+response_array[3]).val("");
    }
 }
  });
  return false;
 }
 
 function del_expert(id,image_id,uniq_id,obj){
	  var txt = $('.img-comment').text();
	  var total = parseInt(txt)-1;
	 
	  $.ajax({
  type: "GET",
   data: "",
   url: "ajax.php?do=del_expert&id="+id+"&image_id="+image_id+"&uniq_id="+uniq_id,
      success: function(rep)
    {
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
   $("#errormsg").html(response_array[1]);
   $("#errormsg").fadeOut(7000);
  }
  if(response_array[0] == 'Success')
  {
	 $('.comments').html('');
  //$('#cmt').html(response_array[2]);

  $('.comments').prepend(response_array[1]);
  $('.img-comment').text(total);
  $('#savecomment').val("");
  //$(obj).find('.tot-comment').text(total);
   }
 }
  });
  return false;
 }

function del3(id,image_id,uniq_id){
	 // alert(id);
	 // alert(image_id);
	  
	  //alert($('#'+form).serialize());
	  $.ajax({
  type: "GET",
   data: "",
   url: "ajax.php?do=del3&id="+id+"&image_id="+image_id+"&uniq_id="+uniq_id,
      success: function(rep)
    {
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
   $("#errormsg"+response_array[2]).html(response_array[1]);
   $("#errormsg"+response_array[2]).fadeOut(7000);
  }
  if(response_array[0] == 'Success')
  {
	 // alert(response_array[0]);
 //alert(response_array[1]);
 //alert(response_array[2]);
 //alert(response_array[3]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
   //$("#sucmsg").html(response_array[1]);
//   $("#sucmsg").fadeOut(7000);
	$('#comments'+response_array[3]).html('');
	$('#cmt'+response_array[3]).html(response_array[2]);
	$('#comments'+response_array[3]).html(response_array[1]); 
	$('#savecomment'+response_array[3]).val("");
	  }
 }
  });
  return false;
 }


//for project slection

function sel_cat(uniq_id){
		 var user_id = (uniq_id);
		 var main_cat = $('.main_cat').val();
		  var category = $('.category').val();
	      var design = $('.category_type').val();
		  var material = $('.material_type').val();
		 var project_id = $('#project_id').val();
	// alert(project_id);
	//alert(design);
	// alert(material)
	//  var form = "form"+uniq_id;
	 // alert(form);
	  
	 // alert($('#'+form).serialize());
	  $.ajax({
   type: "POST",
   data: '',
   url: "ajax.php?do=catsubmit&user_id="+user_id+"&category="+category+"&project_id="+project_id+"&design="+design+"&material="+material+"&main_cat="+main_cat,
      success: function(rep)
    {
 //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
   $(".error").html(response_array[1]);
   $(".error").fadeOut(7000);
  }
  if(response_array[0] == 'Success')
  {
 //alert(response_array[0]);
 //(response_array[1]);
 //alert(response_array[2]);
 //alert(response_array[3]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
   //$("#sucmsg").html(response_array[1]);
//   $("#sucmsg").fadeOut(7000);

	$('.resultsof_add').html(response_array[1]); 
	
	  }
 }
  });
  return false;
 }
 
//select user area according to his city
function sel_city(){
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
  }
 }
  });
  return false;
 }
 

 
 
 
 
 
 
 
 
 