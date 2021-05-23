/*
* Application global javascript
*/

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#navbarDropdown").click(function(){
    $(".dropdown-menu-right").toggle();
});






