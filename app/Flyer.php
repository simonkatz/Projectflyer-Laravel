<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Flyer extends Model
{
    /**
     * Fillable fields for a flyer.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'city',
        'state',
        'zip',
        'country',
        'price',
        'description'
    ];

    /**
     * Format the price
     * 
     * @param  string $price
     * @return string 
     */
    public function getPriceAttribute($price) {
        return '$' . number_format($price);
    }

    /**
     * Find the flyer at the given address.
     * 
     * @param  string  $zip
     * @param  string  $street
     * @return Builder
     */
    public static function locatedAt($zip, $street) {
        $street = str_replace('-', ' ', $street);
        return static::where(compact('$zip', '$street'))->first();
    }

    /**
     * Add a photo to a given flyer.
     * 
     * @param Photo $photo
     */
    public function addPhoto(Photo $photo) {
        return $this->photos()->save($photo);
    }
    
    /**
     * A flyer is composed of many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() {
        return $this->hasMany('App\Photo');
    }
}
