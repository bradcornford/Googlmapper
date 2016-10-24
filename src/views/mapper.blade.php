@include('googlmapper::javascript')

@foreach ($items as $id => $item)

	{!! $item->render($id, $view) !!}

@endforeach

