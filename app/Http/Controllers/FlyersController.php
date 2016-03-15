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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.home');
    }

    public function create() {
    	return view('flyers.create');
    }

    public function store(Request $request) {
    	Flyer::create($request->all());

    	flash()->success('Success!', 'Your Flyer has been created!');
    	return redirect()->back();
    }
}
