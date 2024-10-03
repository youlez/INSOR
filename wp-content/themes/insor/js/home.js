jQuery(document).ready(function ($) {
  $(".link-micrositios").mouseenter(function () {
    $(this).find('.img-gif').addClass("opacity-100");
  });
  $(".link-micrositios").mouseleave(function () {
    $(this).find('.img-gif').removeClass("opacity-100");
  });
});