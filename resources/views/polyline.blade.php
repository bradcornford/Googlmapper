var polylineCoordinates_{!! $id !!} = [
    @foreach ($options['coordinates'] as $coordinate)
        new google.maps.LatLng({!! $coordinate['latitude'] !!}, {!! $coordinate['longitude'] !!}),
    @endforeach
];

var polyline_{!! $id !!} = new google.maps.Polyline({
    path: polylineCoordinates_{!! $id !!},
    geodesic: {!! $options['strokeColor'] ? 'true' : 'false' !!},
    strokeColor: '{!! $options['strokeColor'] !!}',
    strokeOpacity: {!! $options['strokeOpacity'] !!},
    strokeWeight: {!! $options['strokeWeight'] !!},
    editable: {!! $options['editable'] ? 'true' : 'false' !!}
});

polyline_{!! $id !!}.setMap({!! $options['map'] !!});

shapes.push({
    'polyline_{!! $id !!}': polyline_{!! $id !!}
});

@foreach (['eventClick', 'eventDblClick', 'eventRightClick', 'eventMouseOver', 'eventMouseDown', 'eventMouseUp', 'eventMouseOut', 'eventDrag', 'eventDragStart', 'eventDragEnd', 'eventDomReady'] as $event)

    @if (isset($options[$event]))

        google.maps.event.addListener(polyline_{!! $id !!}, '{!! str_replace('event', '', strtolower($event)) !!}', function (event) {
            {!! $options[$event] !!}
        });

    @endif

@endforeach
