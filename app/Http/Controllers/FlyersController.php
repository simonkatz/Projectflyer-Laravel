<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Flyer;
use App\Photo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlyersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Show the Flyers home page.
     *
     * @return Response
     */
    public function index() {
        return view('pages.home');
    }

    /**
     * Show the flyers create page.
     * 
     * @return Response
     */
    public function create() {
        return view('flyers.create');
    }

    /**
     * Save the flyer to the database.
     * 
     * @param  Request
     * @return Response
     */
    public function store(Request $request) {
        $flyer = Flyer::create($request->all());

        flash()->success('Success!', 'Your Flyer has been created!');
        return $this->show($flyer->zip, $flyer->street);
    }

    /**
     * Add a photo to the referenced flyer.
     * 
     * @param string  $zip     
     * @param string  $street 
     * @param Request $request
     */
    public function addPhotos($zip, $street, Request $request) {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    /**
     * Store the uploaded photo.
     * 
     * @param  UploadedFile $file 
     * @return Photo
     */
    public function makePhoto(UploadedFile $file) {
        return Photo::named($file->getClientOriginalName())->move($file);
    }

    /**
     * Display the flyer.
     * 
     * @param  string $zip
     * @param  string $street  
     * @return Response
     */
    public function show($zip, $street) {
        $flyer = Flyer::locatedAt($zip, $street);
        return view('flyers.show', compact('flyer'));
    }
}
