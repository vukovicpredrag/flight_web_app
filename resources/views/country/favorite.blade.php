@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Favorites</h1>

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
            @if($countries)
                @foreach($countries as $country)
                    <tr>
                        <td>{{$country->name}}</td>
                        <td>{{$country->region}}</td>
                        <td>{{$country->population}}</td>
                        <td>
                            <button class="btn btn-warning favorite-btn" data-user-id="{!! auth()->user()->id !!}" data-country-code="{{$country->alpha2Code}}">Remove from favorites</button>
                            <small class="float-right comments" data-toggle="modal" data-target="#commentsModal" data-user-id="{!! auth()->user()->id !!}" data-country-code="{{$country->alpha2Code}}" >comments({!! \App\Models\CountryComment::where('country_code',$country->alpha2Code)->count() !!})</small>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>

        </table>

    </div>


    <!-- Comments modal -->
    <div class="modal fade" id="commentsModal" role="dialog">
        <div class="modal-dialog modal-lg" role="document"></div>
    </div>
    <!-- End Comments modal -->


@endsection

@section('script')

    <script>

        $('#countriesTable').DataTable({
            "pageLength": 25
        });


        $(document).on('click', '.favorite-btn', function (e) {

            var favoritesBtn = $(this);
            var countryCode  = favoritesBtn.data('country-code');
            var userId       = favoritesBtn.data('user-id');
            var favorite     = 0;


            $.ajax({
                url: "{{ route('country.favorite.manage') }}",
                method: 'POST',
                data: {countryCode: countryCode, userId: userId, favorite: favorite},
                success: function(){

                    favoritesBtn.parent().parent().hide()
                }

            })

        })


        $("body").on('click','.comments', function(e) {

            var userId      = $(this).data('user-id');
            var countryCode = $(this).data('country-code');

            $.ajax({
                url: "{{ route('country.comments') }}",
                type: 'POST',
                data: {userId: userId, countryCode: countryCode},
                success: function( response ) {
                    $( "#commentsModal .modal-dialog" ).html( response );
                }


            })

        })

    </script>

@endsection


