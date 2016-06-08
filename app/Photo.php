<?php

namespace App;
use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    //The associated table
    protected $table = 'flyer_photos';
    //Fillable fields for photo
    protected $fillable = ['path', 'name', 'thumbnail_path'];
  
    /**
     * A photo belongs to a single flyer.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer() {
        return $this->belongsTo('App\Flyer');
    }

    public function setNameAttribute($name) {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }

    /**
     * Get the upload base directory
     * 
     * @return string
     */
    public function baseDir() {
        return 'flyer/photos';
    }
}
