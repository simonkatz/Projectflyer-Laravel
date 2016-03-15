@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-3">
			<h1>{{ $flyer->street }}</h1>
			<hr>

			<h3>{!!$flyer->price !!} </h3>
			<div class="description">{!! nl2br($flyer->description) !!}</div>
		</div>
		<div class="col-md-9">
			@foreach($flyer->photos as $photo)
				<img src="/{{ $photo->path }}">
			@endforeach
		</div>
	</div>
	<hr>
	<h3>Add Photos Here</h3>
	<form id="addPhotosForm" 
		  action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}" 
		  method="POST" 
		  class="dropzone">

		{{ csrf_field() }}
	</form>
	<hr>
@stop

@section('scripts.footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
	<script>
		Dropzone.options.addPhotosForm = {
			paramName: 'photo',
			maxFileSize: 3,
			acceptedFiles: '.jpg, .jpeg, .png .bmp'
		}
	</script>
@stop 