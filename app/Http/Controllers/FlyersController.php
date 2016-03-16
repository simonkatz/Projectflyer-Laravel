<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Flyer;
use App\Photo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FlyersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the Flyers home page.
     *
     * @return Response
     */
    public function index()
    {
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
        Flyer::create($request->all());

        flash()->success('Success!', 'Your Flyer has been created!');
        return redirect()->back();
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

        $photo = Photo::fromForm($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    /**
     * Display the flyer.
     * 
     * @param string $zip
     * @param string $street  
     * @return Response
     */
    public function show($zip, $street) {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }
}
