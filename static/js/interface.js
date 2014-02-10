$(document).ready(function(){

	// Lojas
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

		var $stores = $('.stores>li'),
			$states = $('select#states'),
			$arr_places = [];
		$states.after('<select name="places" id="places" class="field-select"></select>');
		var $places = $('select#places');

		$states.find('>optgroup').each(function(i){
			var $this = $(this);
			$arr_places.push($this.html());
			$this.replaceWith('<option value="'+i+'">'+$this.prop('label')+'</option>');
		});
		$places.change(function(){
			$stores.hide();
			codeAddress($('#'+$(this).val()).show().find('span').text() + ',' + $states.find(':selected').text() + ', Brasil');
		});
		$states.change(function(){
			$places.html($arr_places[$(this).val()]).trigger('change');
		}).trigger('change');

	}catch(e){}

});