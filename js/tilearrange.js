$(document).ready(function(){
	
	autoarrange();
	assignBckg();
	$('.tile_text').after('<span class="icon-checkmark tick"></span>');
	$('.tile').bind('click',function(){
		$(this).toggleClass('selected_tile');
		if($(this).find('.tick').css('display') == 'none')
			$(this).find('.tick').show();
		else
			$(this).find('.tick').hide();
	});
});

function assignBckg(){
	var bckimg = ["kitchen","wardrobe","sofa","bed","dining_table","coffee_table","corner_table","crockery","dresser_mirror","tv_unit","bathroom","false_ceiling","lighting","wall_treatment","window_treatment","office","landscape","garden","flooring"];
	$('.front').each(function(ind,ele){
		$(ele).attr('src','Images/Area_Category/'+bckimg[ind]+'.jpg');
	});
}

function autoarrange(){
	var collist = ["#00a0b1","#2e8def","#a700ae","#643ebf","#bf1e4b","#dc572e","#00a600","#0a5bc4"];
	var count = parseInt(document.getElementsByClassName('tile').length-1);
	var inline = parseInt(count/3);
	for(var i=0;i<2;i++){
		$('.tile').eq(count-inline).after('<br>');
		count = count-inline;
	}
	var prev = -1;
	for(var i=0;i<19;i++){
		var curr = Math.floor((Math.random()*8));
		if(prev == curr){
			curr = (curr+4)%8;
		}
		prev = curr;
		$('.tile').eq(i).css('background-color',collist[curr]);
	}
	//setInterval(slider,10000);	
}

function slider(){
	
	if($('#tile_bg').data('vis')==0){
		$('#tile_bg').css('backgroundImage','none');
		$('#tile_bg').data('vis',1);
	}
	else{
		$('#tile_bg').css('backgroundImage','url("Images/kitchen.jpg")');
		$('#tile_bg').data('vis',0);
	}
}
