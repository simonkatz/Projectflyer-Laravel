<?php

namespace App\Http\Controllers;


use App\Flyer;
use App\AddPhotoToFlyer;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddFlyerRequest;

class PhotosController extends Controller
{

    /**
     * Add a photo to the referenced flyer.
     * 
     * @param string  $zip     
     * @param string  $street 
     * @param Request $request
     */
    public function store($zip, $street, AddFlyerRequest $request) {
        $flyer = Flyer::locatedAt($zip, $street);
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();
    }
}
