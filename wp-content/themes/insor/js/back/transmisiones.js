jQuery(document).ready(function ($) {
    $('.switch-activo-inactivo').on('change', function () {
        const postId = $(this).data('post-id');
        const activo = $(this).is(':checked') ? 1 : 0;

        $.post(ajaxurl, {
            action: 'guardar_activo_inactivo',
            post_id: postId,
            activo: activo
        }, function (response) {
            console.log(response);
        });
    });
});