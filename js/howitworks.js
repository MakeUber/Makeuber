$(document).ready(function(){
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

	$('.replay').on('click',function(e){
		e.preventDefault();
		hideAll($('.slides'));
		$('#how').data('done','false');
		$('#how').data('open','false');
		$('#how').trigger('click');
	});


	$('#how').data('done','false');
	$('#how').data('open','false');

	$('#how').on('click',function(){
		if($(this).data('done') == 'false'){
			$('#animator').animate({height:'87vh'},1000,function(){
				$(window).scrollTop($('#animator').offset().top);
				$('#slide1').fadeIn(500);
				$('#slide1 h3').slideDown({duration:1000,easing:"easeOutBounce"});
				$('#slide1 span').show('slide',{direction:'left'});
				$('#slide1 button').delay(500).show('slide',{direction:'down'}).on('click',function(){
					$('#slide1').fadeOut(600);
					animateRow1();
				});
				$('.replay').delay(600).show('slide',{direction:'down'});
			});
			$(this).data('done','true');
			$(this).data('open','true');	
		}
		else if($(this).data('done')=='true'){
			if($(this).data('open')=='true'){
				$("div[id^='slide']").each(function(){
					if($(this).css('display')!='none'){
						$(this).fadeOut(100);
						var id=$(this).attr('id');
						$('#how').data('slide',id);
					}
				});
				$('#animator').animate({height:'0vh'},1000);
				$('.replay').fadeOut(500);
				$(this).data('open','false');
			}
			else{
				$('#animator').animate({height:'87vh'},1000);
				var id = $(this).data('slide');
				$('#'+id).fadeIn('1000');
				$('.replay').delay(1200).show('slide',{direction:'down'});
				$(this).data('open','true');
			}
		}
		
	});

});

function hideAll(elem){
	$(elem).children().each(function(){
		if($(this).children().length > 0){
			hideAll($(this));
		}
		var elemList=['DIV','H3','BUTTON'];
		if(elemList.indexOf($(this).prop('tagName'))!=-1){
			$(this).css('display','none');
			$(this).clearQueue();
			$(this).stop();
		}
	});
}

function animateRow1(){
	$('#slide2').fadeIn(100);
	var el = $('#row1').find('h3:first');
	$('#row1').delay(500).fadeIn(500,function(){
		showDiv(el);
		el= $(this).find('div:first');
		setTimeout(function(){showDiv(el)},500);
		setTimeout(function(){$(this).find('button').show('slide',{direction:'up'},500);},3000);
	});
	$('#row1 .next').on('click',function(){
		animateRow2();
	});
}

function animateRow2(){
	$('#row1').fadeOut(500);
	var el = $('#row2').find('h3:first');
	$('#row2').delay(500).fadeIn(500,function(){
		showDiv(el);
		el= $(this).find('div:first');
		setTimeout(function(){showDiv(el)},200);
		setTimeout(function(){$(this).find('button').show('slide',{direction:'up'},500);},3200);
	});
	$('#row2 .next').on('click',function(){
		animateRow3();
	});
}

function animateRow3(){
	$('#row2').fadeOut(500);
	var el = $('#row3').find('h3:first');
	$('#row3').delay(800).fadeIn(500,function(){
		showDiv(el);
		el= $(this).find('div:first');
		setTimeout(function(){showDiv(el)},200);
		setTimeout(function(){$(this).find('button').show('slide',{direction:'up'},500);},3200);
	});
	$('#row3 button').on('click',function(){
		animateMakeSlide();
	});
}

function animateMakeSlide(){
	$('#slide2').fadeOut(500);
	$('#slide3').delay(500).fadeIn(500);
	var el = $('#row4').find('h3:first');
	$('#row4').delay(500).fadeIn(500,function(){
		showDiv(el);
		el= $(this).find('div:first');
		setTimeout(function(){showDiv(el)},800);
		setTimeout(function(){$(this).find('button').show('slide',{direction:'up'},500);},3200);
	});
	$('#row4 button').on('click',function(){
		animateRow4();
	});
}

function animateRow4(){
	$('#row4').fadeOut(500);
	$('#make-5').delay(800).fadeIn(500,function(){
		$(this).find('h3:first').show('slide',{direction:'left'},500);
	});
}

function showDiv(elem){
	if(elem.prop('tagName')=='H3'){
		elem.delay(200).show('slide',{direction:'left'},500);
	}
	else{
		elem.delay(200).slideDown(500,function(){
			$(this).next().length && showDiv($(this).next());
		});
	}
}


// http://jsfiddle.net/4d1khucm/