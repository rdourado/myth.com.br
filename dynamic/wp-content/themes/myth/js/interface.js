function ready() {

	//
	// External links
	//

	try{
		$('a').each(function(){
			var a = new RegExp('/' + window.location.host + '/');
			if (!a.test(this.href)) 
				$(this).attr('target', '_blank');
		});
	}catch(e){}

	//
	// Fancybox
	//

	try{
		$('.fancybox', '#content').attr('rel', 'fancy').fancybox({padding: 3, closeClick: true, loop: false});
		function titleFormat(title, currentArray, currentIndex, currentOpts) {
			return '<div id="fancybox-title-over">' + $(".lookbook-list>.look-item:eq("+currentIndex+")>.info").html() + '</div>';
		}
		$('.fancybox-look', '#content').attr('rel', 'lookbook').fancybox({
			overlayColor: '#3a041c',
			hideOnContentClick: false,
			overlayOpacity: 1,
			padding: 0,
			margin: 10,
			titlePosition: 'over',
			titleFormat: titleFormat
		});
		$('.fancybox-look.active', '#content').trigger('click');
	}catch(e){}

	//
	// Input Masks
	//

	try{
		$('#nascimento').mask('99/99/9999');
		$('#tel,#tel_emp1,#tel_emp2,#tel_emp3,#cel,#telefone,#residencia,#comercial,#fax').mask('(99) 9999-9999?9');
		$('#cep').mask('99999-999');
		$('#cpf').mask('999.999.999-99');
		$('#cnpj').mask('99.999.999/9999-99');
	}catch(e){}

	//
	// Menu
	//

	try{
		$('#menu>li>a, #body .ajax, #back, #logo>a').unbind('click').click(function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$.ajax({
				url: href,
				type: 'get',
				data: {ajax:'1'},
				dataType: 'json',
				cache: false
			}).done(function(data){
				$('body').removeClass().addClass(data.slug);
				$('#body').replaceWith(data.post_content);
				$('html,body').scrollTop(0);
				ready();
			});
		});
	}catch(e){}

	//
	// Forms
	//

	try{
		$('#franquiaform,#contatoform', '#body').unbind('submit').submit(function(e){
			e.preventDefault();
			var $this = $(this),
				href  = $this.attr('action'),
				data  = $this.serialize();
			$.ajax({
				url: href,
				data: data,
				type: 'POST',
				dataType: 'json'
			}).done(function(data){
				if (data.ok == 0) {
					for (var i = 0; i < data.errors.length; i++) {
						$('input[name="'+data.errors[i]+'"],textarea[name="'+data.errors[i]+'"]', $this).addClass('error');
					}
				} else if (data.ok == 1) {
					$this.get(0).reset();
					$this.prepend('<p id="error">Mensagem enviada. Por favor, aguarde nosso retorno.</p>');
				}
			});
		});
	}catch(e){}
	try{
		$('#newsform').unbind('submit').submit(function(f){
			var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
			if (!re.test(f.elements["ne"].value)) {
				alert("Digite seu email");
				return false;
			}
			if (f.elements["nn"] && (f.elements["nn"].value == "" || f.elements["nn"].value == f.elements["nn"].defaultValue)) {
				alert("Digite seu nome");
				return false;
			}
			if (f.elements["np1"] && (f.elements["nn"].value == "" || f.elements["nn"].value == f.elements["nn"].defaultValue)) {
				alert("Digite seu nome");
				return false;
			}
			return true;
		});
	}catch(e){}

	//
	// Radio
	//

	try{
		if (!$('#radio', '#head').hasClass('on')) {
			$('#radio', '#head').addClass('on').html('<div id="jquery_jplayer_1" class="jp-jplayer"></div><div id="jp_container_1" class="jp-audio"><div class="jp-type-playlist"><div class="jp-gui jp-interface"><ul class="jp-controls"><li><a href="javascript:;" class="jp-previous">previous</a></li><li><a href="javascript:;" class="jp-play">play</a></li><li><a href="javascript:;" class="jp-pause">pause</a></li><li><a href="javascript:;" class="jp-next">next</a></li><li><a href="javascript:;" class="jp-stop">stop</a></li><li><a href="javascript:;" class="jp-mute" title="mute">mute</a></li><li><a href="javascript:;" class="jp-unmute" title="unmute">unmute</a></li><li><a href="javascript:;" class="jp-volume-max" title="max volume">max volume</a></li></ul><div class="jp-progress"><div class="jp-seek-bar"><div class="jp-play-bar"></div></div></div><div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div><div class="jp-current-time"></div><div class="jp-duration"></div><ul class="jp-toggles"><li><a href="javascript:;" class="jp-shuffle" title="shuffle">shuffle</a></li><li><a href="javascript:;" class="jp-shuffle-off" title="shuffle off">shuffle off</a></li><li><a href="javascript:;" class="jp-repeat" title="repeat">repeat</a></li><li><a href="javascript:;" class="jp-repeat-off" title="repeat off">repeat off</a></li></ul></div><div class="jp-playlist"><ul><li></li></ul></div><div class="jp-no-solution"></div></div></div>');
			new jPlayerPlaylist({jPlayer: "#jquery_jplayer_1", cssSelectorAncestor: "#jp_container_1"}, [
			{
				title:"Diamonds - Rihanna",
				mp3:"http://myth.com.br/wp-content/themes/myth/audio/mp3/rihanna.mp3"
			},
			{
				title:"Locked Out of Heaven - Bruno Mars",
				mp3:"http://myth.com.br/wp-content/themes/myth/audio/mp3/bruno-mars.mp3"
			},
			{
				title:"Beauty And A Beat - Justin Bieber",
				mp3:"http://myth.com.br/wp-content/themes/myth/audio/mp3/justin-bieber.mp3"
			},
			{
				title:"Don't You Worry Child - Swedish House Mafia",
				mp3:"http://myth.com.br/wp-content/themes/myth/audio/mp3/swedish-house-mafia.mp3"
			}],
			{
				playlistOptions: { autoPlay: true },
				swfPath: "/wp-content/themes/myth/js/jplayer",
				supplied: "mp3",
				wmode: "window"
			});
		}
	}catch(e){}

	//
	// Anchors
	//

	try{
		$('.shortcuts a', '#content').click(function(e){
			e.preventDefault();
			var top = $($(this).attr('href')).offset().top + 80;
			$('html,body').animate({scrollTop: top}, 'slow');
		});
	}catch(e){}

	//
	// Slider
	//

	try{
		$('.slider', '#content').each(function(){
			var $this = $(this), 
				sizes = [], 
				wid = 0;
			$('img', this).each(function(){
				var $this = $(this);
				sizes.push({w: $this.width(), h: $this.height()});
				wid += sizes[sizes.length - 1].w;
			});
			$this.data('sizes', sizes).data('current', 0).width(wid);
			$this.wrap('<div class="slider-container"></div>');
			$this.css('position', 'relative');
		});
		$('.slider-container').wrap('<div class="slider-wrap"></div>').css({
			overflow: 'hidden',
			height:   '100%',
			width:    '100%'
		});
		$('.slider-wrap').each(function(){
			var $this = $(this),
				sizes = $this.find('>.slider-container>.slider').data('sizes');
			$this.css({
				marginLeft:  'auto',
				marginRight: 'auto',
				position: 	 'relative',
				height: 	 sizes[0].h,
				width: 		 sizes[0].w
			}).prepend('<a href="" class="slider-prev"></a><a href="" class="slider-next"></a>');
		});
		$('.slider-prev,.slider-next').unbind('click').click(function(e){
			e.preventDefault();
			var $this 		= $(this),
				$wrap 		= $this.parent(),
				is_prev 	= $this.hasClass('slider-prev'),
				$container 	= is_prev ? $this.next().next() : $this.next(),
				$slider 	= $container.find('>.slider');
				sizes 		= $slider.data('sizes'),
				current 	= $slider.data('current');
			
			if (is_prev) current = current > 0 ? current - 1 : 0;
			else current = current < sizes.length - 1 ? current + 1 : sizes.length - 1;

			if (current != $slider.data('current')) {
				$slider.data('current', current).animate({
					left: is_prev ? '+=' + sizes[current].w : '-=' + sizes[current - 1].w
				}, 'slow');
				$wrap.animate({
					width: sizes[current].w,
					height: sizes[current].h
				}, 'slow').css('overflow', 'visible');
			}
		});
		$('body').unbind('keydown').keydown(function(e){
			var keyCode = e.keyCode || e.which,
				arrow = {left: 37, up: 38, right: 39, down: 40};
			if (keyCode == arrow.left)
				$('.slider-prev').trigger('click');
			else if (keyCode == arrow.right)
				$('.slider-next').trigger('click');
		});
	}catch(e){}

	//
	// Lookbook
	//

	try{
		$('#slider-code').tinycarousel({ display : 3, animation : false });
	}catch(e){}

	//
	// Lojas
	//

	try{
		var map, geocoder, marker;
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-14.235004,-51.92528);
		var mapOptions = {
			zoom: 15,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		marker = new google.maps.Marker({ map: map });

		function codeAddress(address) {
			geocoder.geocode( {'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					marker.setPosition(results[0].geometry.location);
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
		}
	}catch(e){}
	try{
		var $places = $('#places'),
			$states = $('#states'),
			$stores = $('.stores>li');
		$places.clone().attr('id','all-places').hide().insertAfter($places);
		var $all_places = $('#all-places');

		$places.change(function(){
			$stores.hide();
			$('#'+$(this).val()).show();
			codeAddress($('#'+$(this).val()).show().find('span').text() + ',' + $states.val() + ', Brasil');
		});
		$states.change(function(){
			$places.empty();
			$places.append($all_places.find('>optgroup[label="'+$(this).val()+'"]').children().clone());
			$places.trigger('change');
		}).val('Rio de Janeiro').trigger('change');
	}catch(e){}

}
$(document).ready(ready);

if (typeof newsletter_check !== "function") {
	window.newsletter_check = function (f) {
	    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
	    if (!re.test(f.elements["ne"].value)) {
	        alert("Digite seu email");
	        return false;
	    }
	    if (f.elements["nn"] && (f.elements["nn"].value == "" || f.elements["nn"].value == f.elements["nn"].defaultValue)) {
	        alert("Digite seu nome");
	        return false;
	    }
	    if (f.elements["np1"] && (f.elements["np1"].value == "" || f.elements["np1"].value == f.elements["np1"].defaultValue)) {
	        alert("Digite seu estado");
	        return false;
	    }
	    return true;
	}
}