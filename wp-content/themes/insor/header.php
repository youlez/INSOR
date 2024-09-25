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
    <div class="barra-superior-govco" aria-label="Barra superior">
      <div class="container">
        <a class="my-2" href="https://www.gov.co/"
          data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logo de GOV.CO"
          target="_blank" aria-label="Portal del Estado Colombiano - GOV.CO"></a>
      </div>
    </div>
    <div class="container">
      <div class="row my-2 justify-content-between">
        <a class="col-lg-2" href="/" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logo de insor">
          <img class="img-fluid" src="<?php bloginfo('template_url'); ?>/images/logos/logo-principal.png">
        </a>
        <div class="col-lg-3 d-flex align-items-center">
          <?php
          echo do_shortcode('[wpdreams_ajaxsearchlite]');
          ?>
        </div>
      </div>
    </div>
    <div class="menu-principal">
      <div class="container">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'menu-principal', // Nombre registrado
          'container' => 'nav', // Etiqueta HTML para contener el menú
          'container_class' => 'navbar navbar-expand-lg p-0', // Clase CSS opcional para el contenedor
          'menu_class' => 'navbar-nav col-12 p-0  justify-content-between position-relative', // Clase CSS opcional para los elementos del menú
          'walker' => new agregar_clase_Walker_Nav_Menu(),
        ));
        ?>
      </div>
    </div>
  </header>