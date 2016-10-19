@if (!$view->shared('javascript', false))

    @if ($view->share('javascript', true)) @endif

    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v={!! $options['version'] !!}&region={!! $options['region'] !!}&language={!! $options['language'] !!}&key={!! $options['key'] !!}&signed_in={!! $options['user'] ? 'true' : 'false' !!}&libraries=places"></script>

    @if ($options['cluster'])

        <script type="text/javascript" src="//googlemaps.github.io/js-marker-clusterer/src/markerclusterer.js"></script>

    @endif

@endif