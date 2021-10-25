'use strict';

$(function () {
    window.BASE_URL = $('base').attr('href')
    $('[data-toggle="popover"]').popover()
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.banner-section .single-banner', function () {
        const slugCate = $(this).children('.catalog-image').data('slug')
        const urlCate = `${BASE_URL}san-pham/${slugCate}`
        location.replace(urlCate);
    })
})
