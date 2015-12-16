<div id="map-canvas-{!! $id !!}" style="height: 100%; margin: 0; padding: 0;"></div>

<script type="text/javascript">

	var maps = [];

	function initialize_{!! $id !!}() {
		var bounds = new google.maps.LatLngBounds();
		var infowindow = new google.maps.InfoWindow();
		var position = new google.maps.LatLng({!! $options['latitude'] !!}, {!! $options['longitude'] !!});

		var mapOptions_{!! $id !!} = {
			@if ($options['center'])
				center: position,
			@endif
			mapTypeId: google.maps.MapTypeId.{!! $options['type'] !!},
			disableDefaultUI: @if (!$options['ui']) true @else false @endif,
			scrollwheel: @if ($options['scrollWheelZoom']) true @else false @endif
		};

		var map_{!! $id !!} = new google.maps.Map(document.getElementById('map-canvas-{!! $id !!}'), mapOptions_{!! $id !!});
		map_{!! $id !!}.setTilt({!! $options['tilt'] !!});

		var markers = [];

		@foreach ($options['markers'] as $key => $marker)
			{!! $marker->render($key, $view) !!}
		@endforeach

		@if ($options['cluster'])
			var markerCluster = new MarkerClusterer(map_{!! $id !!}, markers);
		@endif

		@foreach ($options['shapes'] as $key => $shape)
			{!! $shape->render($key, $view) !!}
		@endforeach

		@if (!$options['center'])
			map_{!! $id !!}.fitBounds(bounds);
		@endif

		@if ($options['overlay'] == 'BIKE')
			var bikeLayer = new google.maps.BicyclingLayer();
			bikeLayer.setMap(map_{!! $id !!});
		@endif

		@if ($options['overlay'] == 'TRANSIT')
			var transitLayer = new google.maps.TransitLayer();
			transitLayer.setMap(map_{!! $id !!});
		@endif

		@if ($options['overlay'] == 'TRAFFIC')
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(map_{!! $id !!});
		@endif

		var listener = google.maps.event.addListener(map_{!! $id !!}, "idle", function () {
			map_{!! $id !!}.setZoom({!! $options['zoom'] !!});
			google.maps.event.removeListener(listener);
		});

		maps.push({
			key: {!! $id !!},
			markers: markers,
			map: map_{!! $id !!}
		});
	}

	google.maps.event.addDomListener(window, 'load', initialize_{!! $id !!});

</script>