@if ($options['place'])

    var service = new google.maps.places.PlacesService({!! $options['map'] !!});
    var request = {
        placeId: {!! json_encode((string) $options['place']) !!}
    };

    service.getDetails(request, function(placeResult, status) {
        if (status != google.maps.places.PlacesServiceStatus.OK) {
            alert('Unable to find the Place details.');
            return;
        }

@endif

@if ($options['locate'] && $options['marker'])
    if (typeof navigator !== 'undefined' && navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            marker_0.setPosition(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
        });
    }
@endif

var markerPosition_{!! $id !!} = new google.maps.LatLng({!! $options['latitude'] !!}, {!! $options['longitude'] !!});

var marker_{!! $id !!} = new google.maps.Marker({
    position: markerPosition_{!! $id !!},
    @if ($options['place'])
        place: {
            placeId: {!! json_encode((string) $options['place']) !!},
            location: { lat: {!! $options['latitude'] !!}, lng: {!! $options['longitude'] !!} }
        },
        attribution: {
            source: document.title,
            webUrl: document.URL
        },
    @endif

    @if (isset($options['clickable']))
        clickable: {!! json_encode((bool) $options['clickable']) !!},
    @endif

    @if (isset($options['cursor']))
        cursor: {!! json_encode((string) $options['cursor']) !!},
    @endif

    @if (isset($options['draggable']))
        draggable: {!! json_encode((bool) $options['draggable']) !!},
    @endif

    @if (isset($options['opacity']))
        opacity: {!! json_encode((float) $options['opacity']) !!},
    @endif

    @if (isset($options['visible']))
        visible: {!! json_encode((bool) $options['visible']) !!},
    @endif

    @if (isset($options['zIndex']))
        zIndex: {!! json_encode((int) $options['zIndex']) !!},
    @endif

    title: {!! json_encode((string) $options['title']) !!},
    label: @if (is_array($options['label']))
        {
            @foreach ($options['label'] as $key => $value)
                {!! $key !!}: {!! json_encode((string) $value) !!},
            @endforeach
        }
    @else
        {!! json_encode($options['label']) !!}
    @endif
    ,
    animation: @if (empty($options['animation']) || $options['animation'] == 'NONE') '' @else google.maps.Animation.{!! $options['animation'] !!} @endif,
    @if (isset($options['icon']))
        icon: @if (is_array($options['icon']))
            {
                @foreach ($options['icon'] as $key => $value)

                    @switch($key)
@case('symbol')
                            path: google.maps.SymbolPath.{!! $value !!},
                        @break;

                        @case('size')
                        @case('scaledSize')
                            @if (is_array($value))
                                {!! $key !!}: new google.maps.Size({!! $value[0] !!}, {!! $value[1] !!}),
                            @else
                                {!! $key !!}: new google.maps.Size({!! $value !!}, {!! $value !!}),
                            @endif
                        @break;

                        @case('anchor')
                        @case('origin')
                        @case('labelOrigin')
                            @if (is_array($value))
                                {!! $key !!}: new google.maps.Point({!! $value[0] !!}, {!! $value[1] !!}),
                            @else
                                {!! $key !!}: new google.maps.Point({!! $value !!}, {!! $value !!}),
                            @endif
                        @break;

                        @case('fillOpacity')
                        @case('rotation')
                        @case('scale')
                        @case('strokeOpacity')
                        @case('strokeWeight')
                            {!! $key !!}: {!! json_encode((int) $value) !!},
                        @break

                        @default
                            {!! $key !!}: {!! json_encode((string) $value) !!},
                        @break

                    @endswitch

                @endforeach
            }
        @else
            {!! json_encode((string) $options['icon']) !!}
        @endif
    @endif
});

bounds.extend(marker_{!! $id !!}.position);

marker_{!! $id !!}.setMap({!! $options['map'] !!});
markers.push(marker_{!! $id !!});

@if ($options['place'])

        marker_{!! $id !!}.addListener('click', function() {
            infowindow.setContent('<a href="' + placeResult.website + '">' + placeResult.name + '</a>');
            infowindow.open({!! $options['map'] !!}, this);
        });
    });

@else

    @if (!empty($options['content']))

        var infowindow_{!! $id !!} = new google.maps.InfoWindow({
            content: {!! json_encode((string) $options['content']) !!}
        });

        @if (isset($options['maxWidth']))

            infowindow_{!! $id !!}.setOptions({ maxWidth: {!! $options['maxWidth'] !!} });

        @endif

        @if (isset($options['open']) && $options['open'])

            infowindow_{!! $id !!}.open({!! $options['map'] !!}, marker_{!! $id !!});

        @endif

        google.maps.event.addListener(marker_{!! $id !!}, 'click', function() {

            @if (isset($options['autoClose']) && $options['autoClose'])

                for (var i = 0; i < infowindows.length; i++) {
                    infowindows[i].close();
                }

            @endif

            infowindow_{!! $id !!}.open({!! $options['map'] !!}, marker_{!! $id !!});
        });

        infowindows.push(infowindow_{!! $id !!});

    @endif

@endif

@foreach (['eventClick', 'eventDblClick', 'eventRightClick', 'eventMouseOver', 'eventMouseDown', 'eventMouseUp', 'eventMouseOut', 'eventDrag', 'eventDragStart', 'eventDragEnd', 'eventDomReady'] as $event)

    @if (isset($options[$event]))

        google.maps.event.addListener(marker_{!! $id !!}, '{!! str_replace('event', '', strtolower($event)) !!}', function (event) {
            {!! $options[$event] !!}
        });

    @endif

@endforeach
