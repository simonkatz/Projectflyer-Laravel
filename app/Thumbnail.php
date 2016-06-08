<?php

namespace App;

use Image;

class Thumbnail {
    /**
     * Create the thumbnail.
     * 
     * @param  string $src 
     * @param  string $destination 
     * @return void
     */
    public function make($src, $destination) {
        Image::make($src)
            ->fit(200)
            ->save($destination);
    }
}