<?php

/**
 * Create a flash message.
 * 
 * @param  string|null $title
 * @param  string|null $message
 * @return void
 */
function flash($title=null, $message=null) {
	$flash = app('App\Http\Flash');

	if (func_num_args() == 0) {
		return $flash;
	}

	$flash->info($title, $message);
}