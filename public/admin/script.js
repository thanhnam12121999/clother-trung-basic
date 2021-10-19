$(function () {
    const BASE_URL = $('base').attr('href');
    $(document).on('click', '.admin-notify-section .read-at', function () {
        const notiId = $(this).data('noti-id')
        $.get(`${BASE_URL}admin/notifications/${notiId}/mark-as-read`, (result, status) => {
            if (result.status) {
                const link = $(this).data('link')
                window.location.href = link;
            }
        });
    })
})
