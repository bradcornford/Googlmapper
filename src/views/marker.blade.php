@if ($options['user'] && $options['place'])

	var service = new google.maps.places.PlacesService({!! $options['map'] !!});
	var request = {
		placeId: '{!! $options['place'] !!}'
	};

	service.getDetails(request, function(placeResult, status) {
		if (status != google.maps.places.PlacesServiceStatus.OK) {
			alert('Unable to find the Place details.');
			return;
		}

@endif

var markerPosition_{!! $id !!} = new google.maps.LatLng({!! $options['latitude'] !!}, {!! $options['longitude'] !!});

var marker_{!! $id !!} = new google.maps.Marker({
	position: markerPosition_{!! $id !!},
	@if ($options['user'] && $options['place'])
		place: {
			placeId: '{!! $options['place'] !!}',
			location: { lat: {!! $options['latitude'] !!}, lng: {!! $options['longitude'] !!} }
		},
		attribution: {
			source: document.title,
			webUrl: document.URL
		},
	@endif
		
	@if (isset($options['draggable']) && $options['draggable'] == true)
		draggable:true,
	@endif
	
	title: '{!! $options['title'] !!}',
	animation: @if (empty($options['animation']) || $options['animation'] == 'NONE') '' @else google.maps.Animation.{!! $options['animation'] !!} @endif,
	@if ($options['symbol'])
		icon: {
			path: google.maps.SymbolPath.{!! $options['symbol'] !!},
			scale: {!! $options['scale'] !!}
		}
	@else
		icon: '{!! $options['icon'] !!}'
	@endif
});

bounds.extend(marker_{!! $id !!}.position);

marker_{!! $id !!}.setMap({!! $options['map'] !!});
markers.push(marker_{!! $id !!});

@if ($options['user'] && $options['place'])

		marker_{!! $id !!}.addListener('click', function() {
			infowindow.setContent('<a href="' + placeResult.website + '">' + placeResult.name + '</a>');
			infowindow.open({!! $options['map'] !!}, this);
		});
	});

@else

	@if (!empty($options['content']))

		var infowindow_{!! $id !!} = new google.maps.InfoWindow({
			content: '{!! $options['content'] !!}'
		});

		google.maps.event.addListener(marker_{!! $id !!}, 'click', function() {
			infowindow_{!! $id !!}.open({!! $options['map'] !!}, marker_{!! $id !!});
		});

	@endif

@endif


@if (isset($options['dragend_event']))
	google.maps.event.addListener(marker_{!! $id !!}, 'dragend', function (event) {
		{!! $options['dragend_event'] !!}
	});
@endif
