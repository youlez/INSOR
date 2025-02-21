jQuery(document).ready(function ($) {
  var widthWindow = window.innerWidth;
  if (widthWindow > 991) {
    ajustarMenu();
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
  }

  $(document).on('click', '.btn-menu', function (e) {
    $(this).toggleClass('active');
    $("#menu").toggleClass('show-menu');
  });
  $(document).on('click', '.btn-acceso', function (e) {
    $(this).toggleClass('active');
    $(".content-example-barra").toggleClass('active');
  });
});

jQuery(window).on("resize", function () {
  var widthWindow = window.innerWidth;
  if (widthWindow > 991) {
    ajustarMenu();
  }
});

function ajustarMenu() {
  Array.from(jQuery("#menu-principal >li")).forEach(element => {
    var widthItem = jQuery(element).width() + 10;
    var widthImg = jQuery(element).find('>a >.img-menu img').width();
    if (widthImg > widthItem) {
      var left = (widthImg - widthItem) / 2;
      jQuery(element).find('>a >.img-menu').css("left", "-" + left + "px");
    }
  });
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
      let widthTotal = posSubMenu + widthSubMenu + widthSub;
      if (widthTotal > widthWindow) {
        jQuery(submenu).removeClass("right-submenu");
        jQuery(submenu).addClass("left-submenu");
      }
      Array.from(jQuery(submenu).find(".sub-menu")).forEach(ultimo => {
        let widthUlt = jQuery(ultimo).width();
        let widthTotal = posSubMenu + widthSubMenu + widthSub + widthUlt;
        if (widthTotal > widthWindow) {
          jQuery(submenu).removeClass("right-submenu");
          jQuery(ultimo).removeClass("right-submenu");
          jQuery(submenu).addClass("left-submenu");
          jQuery(ultimo).addClass("left-submenu");
          let widthUltA = jQuery(ultimo).width();
          let widthTotalA = posSubMenu + widthSubMenu + widthSub + widthUltA;
          if (widthTotalA > widthWindow) {
            /*jQuery(ultimo).removeClass("left-submenu");
            jQuery(ultimo).addClass("right-submenu");
            Array.from(jQuery(ultimo).find(".sub-menu")).forEach(ult => {
              let widthF = posSubMenu + widthSubMenu + widthSub + widthUlt;
              jQuery(ult).css("min-width", (widthWindow - widthF - 25) + "px");
              jQuery(ult).css("max-width", (widthWindow - widthF - 25) + "px");
            });*/
          } else {
            /*Array.from(jQuery(ultimo).find(".sub-menu")).forEach(ult => {
              let widthU = jQuery(ult).width();
              let widthTotal = posSubMenu + widthSubMenu + widthSub + widthUltA + widthU;
              if (widthTotal > widthWindow) {
                jQuery(ultimo).removeClass("right-submenu");
                jQuery(ult).removeClass("right-submenu");
                jQuery(ultimo).addClass("left-submenu");
                jQuery(ult).addClass("left-submenu");
              }
            });*/
          }
        }
        else {
          /*Array.from(jQuery(ultimo).find(".sub-menu")).forEach(ult => {
            let widthU = jQuery(ult).width();
            let widthTotal = posSubMenu + widthSubMenu + widthSub + widthUltA + widthU;
            if (widthTotal > widthWindow) {
              jQuery(ultimo).removeClass("right-submenu");
              jQuery(ult).removeClass("right-submenu");
              jQuery(ultimo).addClass("left-submenu");
              jQuery(ult).addClass("left-submenu");
            }
        });*/
        }

        Array.from(jQuery(ultimo).find(".sub-menu")).forEach(ult => {
          let widthF = posSubMenu + widthSubMenu + widthSub + widthUlt;
          jQuery(ult).css("min-width", (widthWindow - widthF - 25) + "px");
          jQuery(ult).css("max-width", (widthWindow - widthF - 25) + "px");
        });
      });
    });
  });
}