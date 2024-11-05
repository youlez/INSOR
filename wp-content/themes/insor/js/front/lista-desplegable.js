jQuery(document).ready(function ($) {
    $(".lista-year").change(function () {
        var contenido = "#contenido-" + this.id;
        var cargando = "#cargando-" + this.id;
        var year_id = $(this).val();

        var datos = new FormData();
        datos.append('action', 'mostrarcontenidotabla');
        datos.append('id', year_id);

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
