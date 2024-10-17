jQuery(document).ready(function ($) {
  $(window).scroll(function (event) {
    var scroll = $(window).scrollTop();
    var heightTopBar = $(".topbar").height();
    var heightLogos = $(".logos").height();
    if (scroll >= heightTopBar + heightLogos) {
      $(".menu-principal").addClass('fijado');
      topContenedor();
    }
    else {
      $(".menu-principal").removeClass('fijado');
      jQuery('.contenedor').css('margin-top', 'auto');
    }
  });

  $("div.asl_w .probox .proinput input").on("focusout", function () {
    if ($(this).val() != "") {
      $(this).addClass("no-place");
    }
    else {
      $(this).removeClass("no-place");
    }
  });

});

jQuery(window).on("resize", function () {
  topContenedor();
});

function topContenedor() {
  var heightMenu = jQuery('.menu-principal').height();
  jQuery('.contenedor').css('margin-top', heightMenu + 'px');
}