$(document).ready(function(){
	$.ajax({
		url:'process.php',
		data:{name:'name'},
		type:'POST'
	}).done(function(response){
		response = $.parseJSON(response);
		$('.expert-search').autocomplete({source:response});
	});
	$("button[name='expSubmit']").click(function(){
		if($('.expert-search').value().length > 0){
			$('#expert-form').submit();
		}
	});
	$.ajax({
		url:'process.php',
		data:{picture:'picture'},
		type:'POST'
	}).done(function(response){
		//alert(response);
		response = $.parseJSON(response);
		$('.picture-search').autocomplete({source:response});
	});
	$('.expert-search').autocomplete({
		      	source: function( request, response ) {
					//alert(request.term);
		      		$.ajax({
		      			url : 'process.php',
		      			dataType: "json",
						data: {
						  name: request.term,
						   type: 'expert'
						},
						 success: function( data ) {
							// alert(data);
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 1      	
		      });
	$('.picture-search').autocomplete({
		      	source: function( request, response ) {
					//alert(request.term);
		      		$.ajax({
		      			url : 'process.php',
		      			dataType: "json",
						data: {
						  name: request.term,
						   type: 'picture'
						},
						 success: function( data ) {
							// alert(data);
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 1      	
		      });

	$('.pagination li').click(function(e){
		var ind = $(this).index();
		$('.pagination li.active').removeClass('active');
		$('.pagination li').eq(ind).addClass('active');
		$('html,body').animate({scrollTop:0});
	});


	$("button[name='picSubmit']").click(function(){
		if($('.picture-search').value().length > 0){
			$('#picture-form').submit();
		}
	});
	var terms = ['Kitchen','Bathroom','Interior','Tiles','Walls'];
	//$('.auto-search').autocomplete({source:terms});
	$('.feedback').data('hidden','false');
	$('#icon a').on('click',function(e){
		e.preventDefault();
		if($('.feedback').data('hidden')=='false'){
			$('.feedback').animate({right:'0%'},1000);
			$('.feedback').data('hidden','true');
			$('body').append($('<div class="blur"></div>'));
		}
		else{
			$('.feedback').animate({right:'-32.7%'},1000);
			$('.feedback').data('hidden','false');
			$('.blur').remove();
		}
	});
	$('#feed-close').on('click',function(e){
		e.preventDefault();
		if($('.feedback').data('hidden')=='true'){
			$('.feedback').animate({right:'-32.7%'},1000);
			$('.feedback').data('hidden','false');
			$('.blur').remove();
		}
	});
	$('.photo-modal').data('show','false');
	$('.photo-wrap').click(function(e){
		e.preventDefault();
		$('body').append('<div class="blur"></div>');
		$('.photo-modal').fadeIn();
		$('.photo-modal').data('show','true');
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