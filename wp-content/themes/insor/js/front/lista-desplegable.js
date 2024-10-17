jQuery(document).ready(function ($) {
    $(".lista-year").change(function () {
        var tabla = "#tabla-" + this.id;
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
                $(tabla).hide();
            },
            success: function (result) {
                //console.log(result);
                $(tabla).html(result);
                $(tabla).show();
                $(cargando).hide();

            }, error: function (result) {
                console.log(result);
            }
        });
    });
});
