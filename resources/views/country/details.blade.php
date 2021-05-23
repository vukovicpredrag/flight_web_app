@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Country details</h1><br>

        <div class="row">

            <div class="col-md-4">

                <form action="{{ route('country.getDetails') }}" method="GET" id="countryDetailsForm">

                    <label for="country">Country:</label>

                    <select name="country" class="form-control" id="countrySelect">

                    <option value="">Select country...</option>

                    @foreach($countries as $country)
                        <option @if($countryDetails && $countryDetails->alpha2Code == $country->alpha2Code) selected @endif value="{{$country->alpha2Code}}">{{$country->name}}</option>
                    @endforeach

                    </select>

                </form><br>

                @if($countryDetails)

                    <p>Name: <b>{{$countryDetails->name}}</b></p>
                    <p>Capital: <b>{{$countryDetails->capital}}</b></p>
                    <p>Region: <b>{{$countryDetails->region}}</b></p>

                @endif

            </div>

    @if($countryDetails)

            <div class="col-md-6">
                 <img src="{{$countryDetails->flag}}" width="300" height="200">
            </div>

        </div><br>
        <div class="row">

            <h4>Additional information:</h4>

            <table id="countriesTable" class="table table-striped">

            <thead>

                <tr>
                    <th>Subregion</th>
                    <th>Population</th>
                    <th>Area</th>
                    <th>Numeric Code</th>
                    <th>Alpha Code</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>{{$countryDetails->subregion}}</td>
                    <td>{{$countryDetails->population}}</td>
                    <td>{{$countryDetails->area}}</td>
                    <td>{{$countryDetails->numericCode}}</td>
                    <td>{{$countryDetails->alpha3Code}}</td>
                </tr>

            </tbody>

        </table>

        </div>


        <!-- Google map, country position -->
        <div class="row map-container">

            <h4>Position on the map:</h4>
            <div id="map"></div>

        </div>
        <!-- End Google map, country position -->

    @endif
    </div>

@endsection

@section('script')
<script>

    $('#countrySelect').select2();

    var map;

    //set latitude and longitude
    var latitude  = parseInt(@php if($countryDetails){echo $countryDetails->latlng[0]; } @endphp);
    var longitude =  parseInt(@php if($countryDetails){echo $countryDetails->latlng[1]; } @endphp);

    //google map with selected country
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: latitude, lng: longitude },
            zoom: 5,
        });
    }

    $('#countrySelect').change(function (e) {


        $('#countryDetailsForm').submit();

    })


</script>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk3LRKNwh2S5JrwZxRBoyCX99GWQjBfMQ&callback=initMap&libraries=&v=weekly" async></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

@endsection
