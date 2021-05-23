<?php

namespace App\Http\Controllers;

use App\Helper\CountryHelper;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $countryHelper = new CountryHelper();

        $countries = $countryHelper->getCountruesAll();

        return view('home', [ 'countries' => $countries]);

    }








}
