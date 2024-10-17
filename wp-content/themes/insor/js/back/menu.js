jQuery(document).ready(function ($) {
    var frame;
    $(document).on('click', '.seleccionar-imagen-menu', function (e) {
        e.preventDefault();
        let idinput = $(this).data('id');  // Capturamos el id del botón clicado
        let idimg = $(this).data('image'); 
        let idbutton = $(this).data('button'); 
    
        // Crea un nuevo frame cada vez que se haga clic en el botón
        let frame = wp.media({
            title: 'Seleccionar Imagen',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false
        });
    
        // Cuando se selecciona una imagen
        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $("#" + idinput).val(attachment.url);  // Asignamos la URL de la imagen al campo correcto
            $("#" + idimg).attr("src",attachment.url);
            $("#" + idimg).css("width","100%");
            $("#" + idbutton).css("display","inline");
        });
    
        frame.open();  // Abrimos la biblioteca de medios
    });
    $(document).on('click', '.eliminar-imagen-menu', function (e) {
        $("#" + $(this).data('id')).val("");  // Capturamos el id del botón clicado
        $("#" + $(this).data('image')).attr("src","");
        $(this).css("display","none");
    });
});
