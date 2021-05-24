@extends('layouts.app')

@section('content')

<div class="container"><br>

    <table id="countriesTable" class="table table-striped">

        <thead>

            <tr>
                <th>Country name</th>
                <th>Region</th>
                <th>Population</th>
                <th>Manage</th>
            </tr>

        </thead>
        <tbody>

            @foreach($countries as $country)
                @php $userData = App\Models\Country::where('country_code', $country->alpha2Code)->where('user_id',auth()->user()->id)->first();@endphp
                <tr>
                    <td>{{$country->name}}</td>
                    <td>{{$country->region}}</td>
                    <td>{{$country->population}}</td>
                    @if($userData && $userData->favorite==1)
                        <td><button class="btn btn-warning favorite-btn" data-user-id="{!! auth()->user()->id !!}" data-country-code="{{$country->alpha2Code}}">Remove from favorites</button></td>
                        @else
                        <td><button class="btn btn-primary favorite-btn" data-user-id="{!! auth()->user()->id !!}" data-country-code="{{$country->alpha2Code}}">Add to favorites</button></td>
                    @endif
                </tr>
            @endforeach

        </tbody>

    </table>

</div>


@endsection

@section('script')

<script>

    $('#countriesTable').DataTable({
        "pageLength": 25
    });

    $(document).on('click', '.favorite-btn', function (e) {

         var favoritesBtn = $(this);
         var buttonText   = favoritesBtn.text();
         var countryCode  = favoritesBtn.data('country-code');
         var userId       = favoritesBtn.data('user-id');
         var favorite     = buttonText == "Add to favorites" ? 1 : 0;


         //toggle btn text and classes
         favoritesBtn.text(buttonText == "Add to favorites" ? "Remove from favorites" : "Add to favorites");
         favoritesBtn.toggleClass("btn-primary btn-warning");

        
         $.ajax({
             url: "{{ route('country.favorite.manage') }}",
             method: 'POST',
             data: {countryCode: countryCode, userId: userId, favorite: favorite},

         })

     })

</script>
@endsection


