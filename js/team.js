jQuery( document ).ready(function( $ ) {
	var $list = $('#member-list'),
			$btn_prev = $('#prev'),
			$btn_next = $('#next'),
			size = $list.children().length,
			current_index = 0,
			interval;
	var	boundaries = {
			rotateX : { min : 40 , max : 90 },
			rotateY : { min : -15 , max : 15 },
			rotateZ : { min : -10 , max : 10 },
			translateX : { min : -200 , max : 200 },
			translateY : { min : -400 , max : -200 },
			translateZ : { min : 250 , max : 550 }
	};

	var getRandTransform = function() {
		return {
			rx : Math.floor( Math.random() * ( boundaries.rotateX.max - boundaries.rotateX.min + 1 ) + boundaries.rotateX.min ),
			ry : Math.floor( Math.random() * ( boundaries.rotateY.max - boundaries.rotateY.min + 1 ) + boundaries.rotateY.min ),
			rz : Math.floor( Math.random() * ( boundaries.rotateZ.max - boundaries.rotateZ.min + 1 ) + boundaries.rotateZ.min ),
			tx : Math.floor( Math.random() * ( boundaries.translateX.max - boundaries.translateX.min + 1 ) + boundaries.translateX.min ),
			ty : Math.floor( Math.random() * ( boundaries.translateY.max - boundaries.translateY.min + 1 ) + boundaries.translateY.min ),
			tz : Math.floor( Math.random() * ( boundaries.translateZ.max - boundaries.translateZ.min + 1 ) + boundaries.translateZ.min )
		};

	}

	/**
	 * Do transform next or prev
	 * @param  {Function} next [description]
	 * @return {[type]}        [description]
	 */
	var transformIt = function(next){
		var $li, transform;
		if (next){
			if (current_index == size - 1){
				return false;
			}
			$li = $('> li:eq('+current_index+')', $list);
			current_index++;
			var rand = getRandTransform();
			transform = 'translateX(' + rand.tx + 'px) translateY(' + rand.ty + 'px) translateZ(' + rand.tz + 'px) rotateX(' + rand.rx + 'deg) rotateY(' + rand.ry + 'deg) rotateZ(' + rand.rz + 'deg)';
		}else{
			if (current_index == 0){
				return false;
			}
			$li = $('> li:eq('+(current_index - 1)+')', $list);
			transform = 'translateX( 0px ) translateY( 0px ) translateZ( 0px ) rotateX( 0deg ) rotateY( 0deg ) rotateZ( 0deg )';
			current_index--;
		}
		$li.css({
			'-webkit-transform': transform,
			'-ms-transform': transform,
			'transform': transform,
			'opacity': (next?0:1),
		});
	}

	// set z-index
	$('> li', $list).each(function(i){
		$(this).css('z-index', size - i);
	});

	// Stacked event click
	if ($list.hasClass('stacked')){
		$btn_next.add($btn_prev).on('click', function(){
			return false;
		}).on('mousedown', function(){
			var next = $(this).prop('id') == 'next';
			transformIt(next);
			interval = setInterval(function(){
				transformIt(next);
			}, 150);
		}).on('mouseup mouseleave', function(){
			if (interval){
				clearInterval(interval);
			}
		});
	}

});
