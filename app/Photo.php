<?php

namespace App;
use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{

    protected $table = 'flyer_photos';
    protected $fillable = ['path', 'name', 'thumbnail_path'];
    protected $basedir = 'flyer/photos';
    /**
     * A photo belongs to a single flyer.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer() {
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Save the file uploaded from the form.
     * 
     * @param  string $name 
     * @return Self
     */
    public static function named($name) {
        return (new static)->saveAs($name);
    }

    /**
     * Set columns for the saved file.
     * 
     * @param  string $name
     * @return Self
     */
    public function saveAs($name) {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->basedir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->basedir, $this->name);

        return $this;
    }
    /**
     * Move the file to the server
     * 
     * @param  UploadedFile $file
     * @return Self
     */
    public function move(UploadedFile $file) {
        $file->move($this->basedir, $this->name);
        $this->makeThumbnail();
        return $this;
    }

    /**
     * Make Photo Thumbnail
     */
    public function makeThumbnail() {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
    }
}
