jQuery(document).ready(function ($) {
    var frame;
    $(document).on('click', '.seleccionar-imagen-menu', function (e) {
        e.preventDefault();
        var input = $(this).prev('input');
        var id = $(this).data('id');

        // Si ya hemos abierto la biblioteca de medios, reutilizamos el frame
        if (frame) {
            frame.open();
            return;
        }

        // Crea un nuevo frame de la biblioteca de medios
        frame = wp.media({
            title: 'Seleccionar Imagen',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false
        });

        // Cuando se selecciona una imagen
        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            console.log(attachment.url);
            $("#"+id).val(attachment.url);
        });

        frame.open();
    });
});
