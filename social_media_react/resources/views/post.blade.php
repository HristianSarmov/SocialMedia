@extends('index')
@extends('leftpane')

@section('post')
<div class="bg-primary border-radius-5 p-2">
		
	@foreach ($posts as $post)
		@include('singlepost')
	@endforeach
</div>
@stop

