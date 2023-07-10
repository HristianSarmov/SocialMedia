@extends('index')
@extends('leftpane')

@section('gallery')
	<span id="person" value="{{ $person }}"></span>
	<div id="root" class="container-fluid bg-primary border-radius-5 p-2"></div>
	<div id="modalspace"></div>
@stop