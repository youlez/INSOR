jQuery(document).ready(function ($) {
  Array.from($("#menu-principal >li >ul")).forEach(element => {
    var widthWindow = window.innerWidth;
    var posSubMenu = $(element).offset().left;
    var widthSubMenu = $(element).width();
    Array.from($(element).find(".sub-menu")).forEach(submenu => {      
      var widthSub = $(submenu).width();
      Array.from($(submenu).find(".sub-menu")).forEach(ultimo => {
        var widthUlt = $(ultimo).width();
        var widthTotal = posSubMenu + widthSubMenu + widthSub + widthUlt;
        if (widthTotal > widthWindow) {
          $(submenu).removeClass("rigth-submenu");
          $(ultimo).removeClass("rigth-submenu");
          $(submenu).addClass("left-submenu");
          $(ultimo).addClass("left-submenu");
        }
      });
    });
  });
  $("li").mouseenter(function () {
    $(this).find('.sub-menu').first().addClass("show-submenu")
  });
  $("li").mouseleave(function () {
    $(this).find('.sub-menu').first().removeClass("show-submenu")
  });
});