jQuery(document).ready(function ($) {
    $(document).on("click", ".letra", function (e) {
        Array.from($(".letra")).forEach(element => {
            $(element).removeClass('active');
        });
        $(this).addClass('active');
        var id = $(this).data('id');
        var letra = $(this).data('letra');
        var contenido = "#glosario-" + id;
        var cargando = "#cargando-" + id;

        var datos = new FormData();
        datos.append('action', 'mostrarcontenidoglosario');
        datos.append('id', id);
        datos.append('letra', letra);

        jQuery.ajax({
            url: ajaxurl,
            contentType: false,
            processData: false,
            dataType: "html",
            type: "POST",
            data: datos,
            beforeSend: function () {
                $(cargando).show();
                $(contenido).hide();
            },
            success: function (result) {
                //console.log(result);
                $(contenido).html(result);
                $(contenido).show();
                $(cargando).hide();

            }, error: function (result) {
                console.log(result);
            }
        });
    });
});
