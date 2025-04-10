jQuery(document).on('change', ".lista-year", function () {

    //jQuery(".lista-year").change(function () {+
    var contenido = "#contenido-" + this.id;
    var cargando = "#cargando-" + this.id;
    var year_id = jQuery(this).val();

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
            jQuery(cargando).show();
            jQuery(contenido).hide();
        },
        success: function (result) {
            //console.log(result);
            jQuery(contenido).html(result);
            jQuery(contenido).show();
            jQuery(cargando).hide();

        }, error: function (result) {
            console.log(result);
        }
    });
});
//});
