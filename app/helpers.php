<?php

function flash($title=null, $message=null) {
	$flash = app('App\Http\Flash');

	if (func_num_args() == 0) {
		return $flash;
	}

	$flash->info($title, $message);
}