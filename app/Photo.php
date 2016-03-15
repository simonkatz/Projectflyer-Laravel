<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	protected $table = 'flyer_photos';
	protected $fillable = ['photo'];
	/**
	 * A photo belongs to a single flyer.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function flyer() {
    	return $this->belongsTo('App\Flyer');
    }
}
