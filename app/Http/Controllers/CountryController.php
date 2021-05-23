<?php

namespace App\Http\Controllers;

use App\Helper\CountryHelper;
use App\Models\Country;
use App\Models\CountryComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CountryController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }


    public function index()
    {

        return view('country.index');

    }

    /**
     * Get all favorite countries
     */
    public function favorite()
    {

        $countryHelper = new CountryHelper();

        $favorites = Country::where('favorite', 1)->where('user_id', auth()->user()->id)->pluck('country_code')->toArray();

        $favoritesList = implode(';', $favorites);

        $countries = $favorites ? $countryHelper->getSelectedCountrues($favoritesList) : '';

        return view('country.favorite',[ 'countries' => $countries]);

    }


    /**
     * @param Request $request
     * favorite / unfavorite countries
     */
    public function favoriteManage(Request $request)
    {

        $userId      = $request->userId;
        $countryCode = $request->countryCode;
        $favorite    = $request->favorite;

        Country::updateOrCreate(
            ['country_code' => $countryCode, 'user_id' => $userId],
            ['favorite' => $favorite]
        );

    }


    /**
     * @param Request $request
     * handling user country comments
     */
    public function comments(Request $request)
    {

        $countryCode = $request->countryCode;

        $comments = CountryComment::where('country_code', $countryCode)->get();

        return View::make( 'country.modals.comments', ['comments' => $comments, 'countryCode' => $countryCode]);

    }

    /**
     * @param Request $request
     * save user country comments
     */
    public function storeComment(Request $request)
    {

        $userId      = $request->userId;
        $comment     = $request->comment;
        $countryCode = $request->countryCode;

        CountryComment::create([
            'user_id'      => $userId,
            'comment'      => $comment,
            'country_code' => $countryCode
        ]);

        return back();

    }

    /**
     * Countries data and statistic
     */
    public function details()
    {
        $countryDetails = '';

        $countryHelper = new CountryHelper();

        $countries = $countryHelper->getCountruesAll();

        return view('country.details', ['countries' => $countries, 'countryDetails' => $countryDetails]);

    }

    /**
     * @param Request $request
     * selected country details
     */
    public function getDetails(Request $request)
    {

        $selected = $request -> country;

        $countryHelper = new CountryHelper();

        $countries = $countryHelper->getCountruesAll();

        $countryDetails = $countryHelper->getSelectedCountrues($selected)[0] ?: '';

        return view('country.details', ['countries' => $countries, 'countryDetails' => $countryDetails]);

    }

}
