<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Flyer;
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
}
