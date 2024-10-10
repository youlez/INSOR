<!DOCTYPE html>

<head>
  <title><?php echo get_bloginfo('name'); ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/logos/logo_peq.png" />
  <?php wp_head(); ?>
</head>

<body>
  <header>
    <div class="barra-superior-govco topbar" aria-label="Barra superior">
      <div class="container">
        <div class="enlace-gov">
          <a class="my-2" href="https://www.gov.co/"
            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logo de GOV.CO"
            target="_blank" aria-label="Portal del Estado Colombiano - GOV.CO"></a>
        </div>
      </div>
    </div>
    <div class="container logos">
      <div class="row py-2 justify-content-between">
        <div class="d-flex d-lg-none align-items-center col-2">
          <button class="btn-movil btn-menu fs-1" type="button">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>
        <a class="col-4 col-lg-2 d-flex justify-content-center align-items-center" href="/" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logo de insor" aria-label="Portal INSOR  - Instituto Nacional para Sordos">
          <?php
          $logo_header = get_theme_mod('logo');

          if ($logo_header) {
            echo '<img class="img-fluid d-none d-lg-block" src="' . $logo_header . '" alt="' . get_bloginfo('name') . '">';
          } else {
            bloginfo('name');
          }

          ?>
          <?php
          $logo_header = get_theme_mod('logo-movil');

          if ($logo_header) {
            echo '<img class="img-fluid d-block d-lg-none" src="' . $logo_header . '" alt="' . get_bloginfo('name') . '">';
          } else {
            bloginfo('name');
          }

          ?>
        </a>
        <div class="col-2 col-lg-3 d-flex align-items-center justify-content-end p-1">
          <button class="btn-movil btn-acceso fs-1 d-block d-lg-none" type="button">
            <i class="fa-solid fa-universal-access"></i>
          </button>
          <div class="col-12 d-none d-lg-block">
            <?php
            echo do_shortcode('[wpdreams_ajaxsearchlite]');
            ?></div>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <div class="container movil" id="menu">
        <div class="col-12 d-block d-lg-none p-2">
          <?php
          echo do_shortcode('[wpdreams_ajaxsearchlite]');
          ?></div>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'menu-principal', // Nombre registrado
          'container' => 'nav', // Etiqueta HTML para contener el menú
          'container_class' => 'navbar navbar-expand-lg p-0', // Clase CSS opcional para el contenedor
          'menu_class' => 'navbar-nav navbar-collapse col-12 p-0 justify-content-lg-between position-relative', // Clase CSS opcional para los elementos del menú
          'walker' => new agregar_clase_Walker_Nav_Menu(),
        ));
        ?>
      </div>
    </div>

    <div class="content-example-barra">
      <div class="barra-accesibilidad-govco">
        <button id="botoncontraste" class="icon-contraste" onclick="cambiarContexto()">
          <span id="titlecontraste">Contraste</span>
        </button>
        <button id="botondisminuir" class="icon-reducir" onclick="disminuirTamanio()">
          <span id="titledisminuir">Reducir letra</span>
        </button>
        <button id="botonnormal" class="icon-normal" onclick="normalTamanio()">
          <span id="titlenormal">Ajustar letra</span>
        </button>
        <button id="botonaumentar" class="icon-aumentar" onclick="aumentarTamanio('aumentar')">
          <span id="titleaumentar">Aumentar letra</span>
        </button>
        <a id="botonrelevo" target="_blank" href="https://centroderelevo.gov.co/632/w3-channel.html">

          <img class="img-fluid" class="icon-relevo" src="<?php bloginfo('template_url'); ?>/images/logos/channels_icon_centro_relevo.svg">
          <span id="titlerelevo">Centro de relevo</span>
        </a>
      </div>
    </div>
  </header>