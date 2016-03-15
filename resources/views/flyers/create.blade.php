@extends('layouts.app')

@section('content')
	<h1>Selling your Home?</h1>
	
	<hr>
	<div class="row">
		<form method="POST" action="/flyers" enctype="multipart/form-data" class='col-md-6'>
			@include('flyers.form')
		</form>
	</div>
	
@stop