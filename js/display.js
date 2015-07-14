$(document).ready(function(){
	
	var list = ["#customer-proj","#expertcorner","#blog-contri","#overview"];
	var offset = [];
	var heights = [];
	for(var i=0;i<4;i++){
		offset.push($(list[i]).offset().top - 124);
		heights.push($(list[i]).outerHeight());
	}

	$('body').click(function(e){
		if($('.btn-group').hasClass('open')){
			if($(e.target).hasClass('experts')){
				$('#mydropdown').find('a.dropdown-toggle').find('span:first').html($(e.target).text());
			}
			else if($(e.target).hasClass('expert')){
				$('#expert-dropdown').find('a.dropdown-toggle').find('span:first').html($(e.target).text());
			}
		}
	});

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
	
	$('.anchor').on('click',function(){
		var target = $(this).data('target');
		var offset = $(target).offset().top;
		$('html,body').animate({scrollTop:offset},600);
	});

	$('#top').on('click',function(e){
		e.preventDefault();
		$('html,body').animate({scrollTop:0},600);
	});

	$('.front').each(function(index,element){
		if(index == 7)
			return false;
		var ind = index+1;
		$(this).attr('src','Experts/exp'+ind+'.jpg');
	});

	$(function(){
		$('#header').data('size','big');
		$('#header').data('reach','false');
	});
		
	$(window).scroll(function(e){
		var headerHeight = $('#header').height();
		if($(this).scrollTop() > headerHeight){
			if($('#header').data('size') == 'big'){
				$('#header').hide();
				$('#fake-header').slideDown('2000');
				$('#header').data('size','small');
			}

			if($(this).scrollTop() >= 411){
				if($('#header').data('reach') == 'false'){
					$('#header-navigator').slideDown('2000');
					$('#header').data('reach','true');
				}
				scroll_spy($(this).scrollTop(),offset,heights,list);
			}
			else{
				if($('#header').data('reach') == 'true'){
					$('#header-navigator').hide();
					$('#header').data('reach','false');
				}
			}
		}
		else{
			if($('#header').data('size') == 'small'){
				$('#fake-header').hide();
				$('#header').slideDown('2000');
				$('#header').data('size','big');
			}
		}
	});
	setInterval(bckChanger,5000);
});

function bckChanger(){
	var url = $('#wrapper').css('background-image').toString();
	//console.log(url);
	var ch = url.charAt(url.indexOf('bckg_')+5);
	var id = (parseInt(ch)+1)%5;
	url = url.replace(ch,id.toString());
	$('#wrapper').animate({ opacity: 0.2},1400,function(){
		$(this).css({'background-image':url})
		.animate({opacity:0.75},1000);
	});
	//$('#wrapper').css('background-image',url);
}

function scroll_spy(scrollTop,offset,heights,list){
	$('#header-navigator').find('li').find('a').each(function(){
		$(this).addClass('anchor');
	});
	if(scrollTop >= offset[0] && scrollTop <= (offset[0]+heights[0])){
		$('#header-navigator').find('.anchor').eq(0).removeClass('anchor');
	}
	else if(scrollTop >= offset[1] && scrollTop <= (offset[1]+heights[1])){
		$('#header-navigator').find('.anchor').eq(1).removeClass('anchor');
	}
	else if(scrollTop >= offset[2] && scrollTop <= (offset[2]+heights[2])){
		$('#header-navigator').find('.anchor').eq(2).removeClass('anchor');
	}
	else if(scrollTop >= offset[3] && scrollTop <= (offset[3]+heights[3])){
		$('#header-navigator').find('.anchor').eq(3).removeClass('anchor');
	}
}

