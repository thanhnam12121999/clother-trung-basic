'use strict';

$(function () {
    window.BASE_URL = $('base').attr('href')
    $('[data-toggle="popover"]').popover()
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
