<?php


namespace App\Helper;

/**
 * Country Helper
 * get all countries API
 */

class CountryHelper{


    private $allCountriesUrl     = 'https://restcountries.eu/rest/v2/all';

    private $definedCountriesUrl ='https://restcountries.eu/rest/v2/alpha?codes=';


    public function getCountruesAll()
    {

        // create curl resource
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->allCountriesUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($output);

        return $response;

    }


    /**
     * @param  $list
     * Search by list of ISO 3166-1 2-letter or 3-letter country codes
     */
    public function getSelectedCountrues($list)
    {

        $url = $this->definedCountriesUrl . $list;

        // create curl resource
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($output);

        return $response;


    }

}