jQuery(document).ready(function ($) {
  paginacion(1);
  $(document).on("click", ".pag", function (e) {
    e.preventDefault();
    var pagenumber = $(this).attr("href");
    paginacion(pagenumber);
  });
});
jQuery(window).on("resize", function () {
});
function paginacion(pagenumber) {

  var pagina = jQuery('#pagina').val();
  var ancho = jQuery(window).width();
  var div = '';
  if (pagina == "noticias") {
    div = '.contenedor_noticias';
  }

  jQuery.ajax({
    url: ajaxurl,
    type: "POST",
    data: {
      action: 'pagination',
      pagenumber: pagenumber,
      pagina: pagina,
      ancho: ancho
    },
    beforeSend: function () {
      jQuery("#cargando").show("fast");
      jQuery(div).hide("fast");
    },
    success: function (output) {
      var datos = JSON.parse(output);
      jQuery(div).html(datos);
    },
    complete: function () {
      jQuery("#cargando").hide("fast");
      jQuery(div).show("fast");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log('No se puede mostrar los contenidos, mensaje: (' + textStatus + '/ ' + errorThrown + ')');
    }
  });
}