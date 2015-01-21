<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v={{ $options['version'] }}&region={{ $options['region'] }}&language={{ $options['language'] }}&key={{ $options['key'] }}&signed_in={{ $options['user'] ? 'true' : 'false' }}&libraries=places"></script>

@foreach ($items as $id => $item)

	{{ $item->render($id, $view) }}

@endforeach

