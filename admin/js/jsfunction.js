
//select user area according to his city
function sel_city(){
	 var city = $('.city').val();
	// alert(city); 
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax2.php?do=sel_city&city="+city,
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
  // alert(response_array[1]);
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
 

 
 
 
 
 
 
 
 
 