jQuery(document).ready(function ($) {
  ajustarMenu();
  $($("#menu-principal .img-menu")[0]).css('left','-75%');
  $($("#menu-principal >li>a .img-menu")[3]).css('left','-25%');
  $($("#menu-principal >li>a .img-menu")[4]).css('left','-30%');
  $("li").mouseenter(function () {
    $(this).find('.sub-menu').first().addClass("show-submenu");
    Array.from($('.img-menu')).forEach(imagen => {
      $(imagen).removeClass("show-img");      
    });
    $(this).find('a .img-menu').first().addClass("show-img");
  });
  $("li").mouseleave(function () {
    $(this).find('.sub-menu').first().removeClass("show-submenu");
    $(this).find('a .img-menu').first().removeClass("show-img");
  });
});

jQuery(window).on("resize", function () {
  ajustarMenu();
});

function ajustarMenu() {
  Array.from(jQuery("#menu-principal >li >ul")).forEach(element => {
    var widthWindow = window.innerWidth;
    var posSubMenu = jQuery(element).offset().left;
    var widthSubMenu = jQuery(element).width();
    let widthTotal = posSubMenu + widthSubMenu + 95;
    if (widthTotal > widthWindow) {
      jQuery(element).css("right", "0")
    }
    Array.from(jQuery(element).find(".sub-menu")).forEach(submenu => {
      var widthSub = jQuery(submenu).width();
      let widthTotal = posSubMenu + widthSubMenu + widthSub + 95;
      if (widthTotal > widthWindow) {
        jQuery(submenu).removeClass("right-submenu");
        jQuery(submenu).addClass("left-submenu");
      }
      Array.from(jQuery(submenu).find(".sub-menu")).forEach(ultimo => {
        let widthUlt = jQuery(ultimo).width();
        let widthTotal = posSubMenu + widthSubMenu + widthSub + widthUlt + 95;        
        if (widthTotal > widthWindow) {
          jQuery(submenu).removeClass("right-submenu");
          jQuery(ultimo).removeClass("right-submenu");
          jQuery(submenu).addClass("left-submenu");
          jQuery(ultimo).addClass("left-submenu");
        }
      });
    });
  });
}