$(document).ready(function(){

	generateOpt();

	$('#top').on('click',function(e){
		e.preventDefault();
		$('html,body').animate({scrollTop:0},600);
	});

	$(function(){
		$('#header').data('size','big');
	});

	$(window).resize(function(){
		if(window.matchMedia('(max-width:768px)').matches){
			if($('.list').data('orientation') == 'vertical'){
				listOrientation('horizontal');
				$('.list').data('orientation','horizontal');
			}
		}
		else{
			if($('.list').data('orientation') == 'horizontal'){
				listOrientation('vertical');
				$('.list').data('orientation','vertical');
			}
		}
	});
	
	if(window.matchMedia('(max-width:768px)').matches){
		listOrientation('horizontal');
		$('.list').data('orientation','horizontal');
	}
	else{
		listOrientation('vertical');
		$('.list').data('orientation','vertical');
	}


	$(window).scroll(function(e){
		var headerHeight = $('#header').height();
		if($(this).scrollTop() > headerHeight){
			if($('#header').data('size') == 'big'){
				$('#header').hide();
				$('#fake-header').slideDown('2000');
				$('#header').data('size','small');
				$('.list').css('marginTop',function(index,margin){
					return parseInt(margin,10) + 100 + 'px';
				});
			}
		}
		else{
			if($('#header').data('size') == 'small'){
				$('#fake-header').hide();
				$('#header').slideDown('2000');
				$('#header').data('size','big');
				$('.list').css('marginTop',function(index,margin){
					return (parseInt(margin,10) - 100) + 'px';
				});
			}
		}
	});

	$('#sublist a').bind('click',function(e){
		e.preventDefault();
		$('#sublist').find('a.active').removeClass('active');
		$(this).addClass('active');
		var ind = $('#sublist a').index($(this));
		checkOpt(ind);
	});
	
});

var json_obj = {
	"Kitchen":["Ply+Laminate","Membrane","Acrylic"],
	"Wardrobes":["Sliding Wardrobes","Shutter Door Wardrobes"],	
	"Sofas":["3+2+1","3+1+1","3+2","3+1","L-shape Sofa","U-shape Sofa"],
	"Dining Tables":["6 Seater","8 Seater","4 Seater"],
	"Coffee Tables":["Square","Rectange","Round"],
	"Corner Tables":["Square","Round"],
	"Crockery Units":["Tall and Slim","Tall and Wide","Short and Square","Short and Wide"],
	"Dresser Mirrors":["Slim","Wide"],
	"Bathrooms":["Bathroom Fittings","Bathroom Accessories"],
	"False Ceiling":["Full House","Living and Dining"]
};

function generateOpt(){
	toappend = '';
	var list = [];
	$('#sublist a').each(function(ind){
		list.push($(this).text());
	});
	for(var k=0;k<list.length;k++){
		toappend += '<div class="panel panel-danger"><div class="panel-heading">'+list[k]+'</div><div class="category panel-body">';
		var curr = list[k];
		for(var i=0;i<json_obj[curr].length;i++){
			toappend+= '<div class="tile tile_sm">'+json_obj[curr][i]+'</div>';
		}
		toappend+="</div></div>";
	}
	$('#item_choice').append(toappend);
	$('.tile').bind('click',function(){
		$(this).toggleClass('select_tile_sm');
	});
}

function checkOpt(index){
	var outerPos = 0;
	if(index > 2){
		if(index == $('#sublist a').length-1)
			outerPos = 60+(index-3)*155;
		else
			outerPos = 60 + (index-2)*155;
		if(outerPos > $(document).height())
			outerPos = $(document).height();
	}
	$("html, body").animate({ scrollTop: outerPos});
}

function listOrientation(orientation){
	if(orientation == 'horizontal'){
		$('.list').hide();
	}
	else{
		$('.list').show();
	}
}

