@extends('layouts.app')



@section('content')

  <div class="jumbotron">
	<h1>Project Flyer</h1>
    <p>
    Bootstrap is the most popular HTML, CSS, and JS framework for developing
    responsive, mobile-first projects on the web.
    </p> 
    @if($signedIn)
        <a href='/flyers/create' class='btn btn-primary'>Create A Flyer</a>
    @else
        <a href='/login' class='btn btn-primary'>Sign In</a>
    @endif
  </div>

@stop