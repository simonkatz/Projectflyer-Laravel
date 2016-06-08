<?php

namespace App;

use App\Flyer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer {
    protected $flyer;
    protected $file;
    protected $thumbnail;

    /**
     * Create a new AddPhotoToFlyer object.
     * 
     * @param Flyer          $flyer    
     * @param UploadedFile   $file     
     * @param Thumbnail|null $thumbnail 
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null) {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    /**
     * Process the form.
     * 
     * @return void
     */
    public function save() {
        $photo = $this->flyer->addPhoto($this->makePhoto());
        $this->file->move($photo->baseDir(), $photo->name);
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }

    /**
     * Create a new photo instance
     * 
     * @return Photo
     */
    public function makePhoto() {
        return new photo(['name' => $this->makeFileName()]);
    }

    /**
     * Create the file name;
     * 
     * @return string
     */
    public function makeFileName() {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }
}