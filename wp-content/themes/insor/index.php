<?php get_header(); ?>
<div class="container contenedor" id="content">
  <section class="pb-4">
    <?php echo do_shortcode('[serious-slider id="5"]') ?>
  </section>


  <?php
  $ultima_transmision_activa = new WP_Query([
    'post_type'      => 'transmisiones', // Cambia a tu tipo de post personalizado
    'meta_key'       => '_activo_inactivo',
    'meta_value'     => '1', // Solo transmisiones activas
    'posts_per_page' => 1,   // Solo una
    'orderby'        => 'date',
    'order'          => 'DESC',
  ]);

  if ($ultima_transmision_activa->have_posts()) {
  ?>
    <section class="py-4">
      <div class="row m-0 titleContainer">
        <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
          <h1>
            TRANSMISIÓN EN VIVO
          </h1>
        </div>
        <div class="col-lg-8"> </div>
      </div>
      <?php
      while ($ultima_transmision_activa->have_posts()) {
        $ultima_transmision_activa->the_post();
        if (preg_match('/<iframe[^>]+src="([^"]+)"/', get_the_content(), $matches)) {
          $url = $matches[1]; // La URL del iframe está en el primer grupo de captura
        } else {
          if (preg_match('/<figure[^>]*>\s*<div class="wp-block-embed__wrapper">\s*(https?:\/\/[^\s<]+)\s*<\/div>/i', get_the_content(), $matches)) {
            $url = $matches[1]; // La URL está en el primer grupo de captura
          }
        }
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=|live\/)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches)) {
          $video_id = $matches[1]; // ID del video
          // Construir el iframe
          $video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
      ?>
        <div class="row m-0">
          <div class="col-6 p-0">
            <div class="ratio ratio-16x9">
              <?php echo $video; ?>
            </div>
          </div>
          <div class="col-6 p-4 texto-transmision">
            <div>
              <h2 class="m-0">
                <?php echo get_the_title() ?>
              </h2>
              <span><?php echo get_the_date() ?></span>
            </div>
          </div>
        </div>

      <?php
      }
      ?>
    </section>
  <?php
  }
  ?>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h1>
          MICROSITIOS
        </h1>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row m-0 banner">
      <div class="col-lg-6" id="mask">
        <a href="https://educativo.insor.gov.co" target="_blank" class="position-relative link-micrositios">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/banner/DSC00824.JPG" class="imgBanner" alt="Insor educativo">
          <h2 class="mb-4">
            INSOR <br />
            <span>EDUCATIVO</span>
            <img class="img-gif" alt="Insor educativo" target="_blank" href="https://educativo.insor.gov.co" src="<?php bloginfo('template_url'); ?>/assets/img/banner/INSOR_EDUCATIVO.gif">
          </h2>
        </a>
      </div>
      <hr class="barra d-none d-lg-block">
      </hr>
      <div class="col-lg-6" id="mask">
        <a href="https://www.insor.gov.co/insorlab" target="_blank" class="position-relative link-micrositios">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/banner/Taller_Cultura_Sorda_3.jpg" alt="Insor lab" class="imgBanner">
          <h2 class="mb-4">
            INSOR <br />
            <span>LAB</span>
            <img class="img-gif" alt="Insor Lab" target="_blank" href="https://www.insor.gov.co/insorlab" src="<?php bloginfo('template_url'); ?>/assets/img/banner/BIDES.gif">
          </h2>
        </a>
      </div>
    </div>
  </section>

  <section class="py-4">

    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h1>
          INFÓRMATE
        </h1>
      </div>
      <div class="col-lg-8">
      </div>
    </div>

    <div class="noticias">
      <div class="row mt-2">
        <?php
        $args = array(
          'post_type' => array('post'),
          'post_status' => 'publish',
          'orderby'  => 'date',
          'order' => 'DESC',
          'posts_per_page' => '4'
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            $post_thumbnail_id = get_post_thumbnail_id();
            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
            $alt_text = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
        ?>
            <div class="col-lg-6 py-2">
              <a class="link-noticias row m-0" href="<?php bloginfo('url'); ?>/<?php echo get_post_field('post_name', get_post()); ?>" aria-label="<?php echo get_the_title(); ?>">
                <div class="imagen p-0">
                  <img src="<?php echo $post_thumbnail_url; ?>" alt="<?php echo $alt_text; ?>">
                </div>
                <div class="texto p-3">
                  <span><?php echo get_the_date(); ?></span>
                  <h2 class="mb-2">
                    <?php echo get_the_title(); ?>
                  </h2>
                  <p>
                    <?php echo get_the_excerpt(); ?>
                  </p>
                </div>
              </a>
            </div>
        <?php

          }
        }

        ?>
      </div>

    </div>
    <div class="d-flex justify-content-center mt-2">
      <a href="<?php bloginfo('url'); ?>/noticias">
        <button type="button" class="btn btn-azul justify-self-center">VER MÁS NOTICIAS</button>
      </a>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer mb-4">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h1>
          TEMAS DE INTERÉS
        </h1>
      </div>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="row m-0 temas_Interes">

      <div class="row align-items-center">
        <?php
        $args = array(
          'post_type' => array('videos'),
          'post_status' => 'publish',
          'orderby'  => 'date',
          'order' => 'DESC',
          'posts_per_page' => '3'
        );
        $index = 0;
        $query = new WP_Query($args);
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            $post_thumbnail_id = get_post_thumbnail_id();
            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
        ?>
            <div class="<?php echo $index == 0 ? 'col-6 col-lg-3 my-4 order-2 order-lg-1' : ($index == 1 ? 'col-12 order-1 col-lg-6 order-lg-2 my-4' : 'col-6 col-lg-3 my-4 order-3') ?>">
              <div class="video-container <?php echo ($index == 1) ? 'center-video' : '' ?>">
                <div class="ratio ratio-16x9">
                  <?php the_content(); ?>
                </div>
                <?php if ($index != 1) { ?>
                  <div class="video-overlay" data-action="prev"></div>
                <?php } ?>
              </div>
            </div>
        <?php
            $index++;
          }
        }
        ?>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <a href="<?php bloginfo('url'); ?>/temas-de-interes">
        <button type="button" class="btn btn-azul justify-self-center">VER MÁS TEMAS</button>
    </div>
    </a>

  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer mb-4">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h1>
          DESTACADOS
        </h1>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row m-0 justify-content-center">
      <div class="btn-icono m-2">
        <a href="<?php bloginfo('url'); ?>/transparencia-y-acceso-a-la-informacion-publica/" target="_blank">
          <span class="icon-programa icon"></span>
          Programa de transparencia y ética pública
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="<?php bloginfo('url'); ?>/asistencia-tecnica/" target="_blank">
          <span class="icon-formulario icon"></span>
          Formulario unico de solicitud de asistencia técnica
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="<?php bloginfo('url'); ?>/notificaciones-judiciales/" target="_blank">
          <span class="icon-notificaciones icon"></span>
          Notificaciones judiciales
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="<?php bloginfo('url'); ?>/peticiones-quejas-reclamos-sugerencias-y-denuncias-insor/" target="_blank">
          <span class="icon-peticiones icon"></span>
          Peticiones, quejas, reclamos y denuncias
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="<?php bloginfo('url'); ?>/contacto/" target="_blank">
          <span class="icon-contacto icon"></span>
          Contacto
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="<?php bloginfo('url'); ?>/calendario-de-actividades/" target="_blank">
          <span class="icon-agenda icon"></span>
          Agenda INSOR
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="<?php bloginfo('url'); ?>/poblacion-sorda-en-cifras/" target="_blank">
          <i class="fa-solid fa-users-between-lines"></i>
          Población sorda en cifras
        </a>
      </div>

    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h1>
          INSOR PARA NIÑOS
        </h1>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="mt-4 position-relative link-kids">
      <a target="_blank" href="https://www.insor.gov.co/insorninos/">
        <div class="tituloKids position-absolute d-none d-lg-flex">
          <p>
            INSOR <br />
            <span>PARA NIÑOS</span>
          </p>
        </div>
        <img src="<?php bloginfo('template_url'); ?>/assets/img/niños/Insor_niños.jpg" class="d-none d-lg-block w-100">
        <img src="<?php bloginfo('template_url'); ?>/assets/img/banner/banner_insor_ninos_mobiles.jpg" class="d-block d-lg-none w-100">
      </a>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h1>
          REDES SOCIALES
        </h1>
      </div>
      <div class="col-lg-8">
      </div>
    </div>


    <div class="row m-0 redes my-4">
      <div class="text-center tabsContainer">

        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active btn-tab" id="nav-instagram-tab" data-bs-toggle="tab" data-bs-target="#nav-instagram" type="button" role="tab" aria-controls="nav-instagram" aria-selected="false">Instagram</button>
            <button class="nav-link btn-tab" id="nav-facebook-tab" data-bs-toggle="tab" data-bs-target="#nav-facebook" type="button" role="tab" aria-controls="nav-facebook" aria-selected="true">Facebook</button>
            <button class="nav-link btn-tab" id="nav-x-tab" data-bs-toggle="tab" data-bs-target="#nav-x" type="button" role="tab" aria-controls="nav-x" aria-selected="false">X</button>
            <button class="nav-link btn-tab" id="nav-tiktok-tab" data-bs-toggle="tab" data-bs-target="#nav-tiktok" type="button" role="tab" aria-controls="nav-tiktok" aria-selected="false" tiktok>Tiktok</button>
          </div>
        </nav>


        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade" id="nav-facebook" role="tabpanel" aria-labelledby="nav-facebook-tab" tabindex="0">
            <div class=" d-flex justify-content-center">
              <div style="width: 550px;height: 600px;">
                <div class="ratio ratio-16x9">
                  <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FInsorColombiaOficial&tabs=timeline&width=500&height=600&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="600" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show active" id="nav-instagram" role="tabpanel" aria-labelledby="nav-instagram-tab" tabindex="0">
            <iframe frameborder="0" scrolling="no" src="https://www.instagram.com/insorcolombiaoficial/embed" height="500px" width="300"></iframe>
          </div>
          <div class="tab-pane fade" id="nav-x" role="tabpanel" aria-labelledby="nav-c-tab" tabindex="0">
            <div class=" d-flex justify-content-center">
              <a class="twitter-timeline" data-lang="es" data-width="500" data-height="300" data-dnt="true" data-theme="light" href="https://twitter.com/insorcolombia?ref_src=twsrc%5Etfw">Tweets by insorcolombia</a>
              <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
          </div>


          <div class="tab-pane fade" id="nav-tiktok" role="tabpanel" aria-labelledby="nav-tiktok-tab" tabindex="0">
            <blockquote class="tiktok-embed" scrolling="no" frameborder="0" cite="https://www.tiktok.com/@insorcolombia" data-unique-id="insorcolombia" data-embed-from="embed_page" data-embed-type="creator" style="max-width:600px; min-width:58rem; border: 0px !important; border-radius: 0px;">
              <section> <a target="_blank" href="https://www.tiktok.com/@insorcolombia?refer=creator_embed">@insorcolombia</a> </section>
            </blockquote>
            <script async src="https://www.tiktok.com/embed.js"></script>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h1>
          ENLACES
        </h1>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row m-0 enlaces_container">
      <div class="col-lg-3 imgCol mt-2 mb-2">
        <img src="<?php bloginfo('template_url'); ?>/assets/img/logos/Logo-Gobierno-de-Colombia-2024.png" class="d-block imgLogoEnlaces">
      </div>
      <div class="col-lg-9 mt-4 ">
        <div class="row">
          <div class="col-4 col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a target="_blank" href="https://www.presidencia.gov.co/">Presidencia</a>
              </li>
              <li>
                <a target="_blank" href="https://www.vicepresidencia.gov.co/">Vicepresidencia</a>
              </li>
              <li>
                <a target="_blank" href="https://www.minjusticia.gov.co/">MinJusticia</a>
              </li>
              <li>
                <a target="_blank" href="https://www.mindefensa.gov.co/">MinDefensa</a>
              </li>
              <li>
                <a target="_blank" href="https://www.mininterior.gov.co/">MinInterior</a>
              </li>
            </ul>
          </div>
          <div class="col-4 col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a target="_blank" href="https://www.cancilleria.gov.co/">Cancillería</a>
              </li>
              <li>
                <a target="_blank" href="https://www.minhacienda.gov.co/webcenter/portal/Minhacienda">MinHacienda</a>
              </li>
              <li>
                <a target="_blank" href="https://www.minenergia.gov.co/es/">MinMinas</a>
              </li>
              <li>
                <a target="_blank" href="https://www.mincit.gov.co/inicio">MinComercio</a>
              </li>
              <li>
                <a target="_blank" href="https://www.mintic.gov.co/portal/inicio/">MinTIC</a>
              </li>
            </ul>
          </div>
          <div class="col-4 col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a target="_blank" href="https://www.mincultura.gov.co/">MinCultura</a>
              </li>
              <li>
                <a target="_blank" href="https://www.minagricultura.gov.co/paginas/default.aspx">MinAgricultura</a>
              </li>
              <li>
                <a target="_blank" href="https://www.minambiente.gov.co/">MinAmbiente</a>
              </li>
              <li>
                <a target="_blank" href="https://mintransporte.gov.co/">MinTransporte</a>
              </li>
              <li>
                <a target="_blank" href="https://www.minvivienda.gov.co/">MinVivienda</a>
              </li>
            </ul>
          </div>
          <div class="col-4 col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a target="_blank" href="https://www.mineducacion.gov.co/portal/">MinEducación</a>
              </li>
              <li>
                <a target="_blank" href="https://www.mintrabajo.gov.co/web/guest/inicio">MinTrabajo</a>
              </li>
              <li>
                <a target="_blank" href="https://www.minsalud.gov.co/Portada/index.html">MinSalud</a>
              </li>
              <li>
                <a target="_blank" href="https://www.dnp.gov.co/">DNP</a>
              </li>
              <li>
                <a target="_blank" href="https://www.dane.gov.co/">DANE</a>
              </li>
            </ul>
          </div>
          <div class="col-4 col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a target="_blank" href="http://www.dps.gov.co/">DPS</a>
              </li>
              <li>
                <a target="_blank" href="https://dni.gov.co/">DNI</a>
              </li>
              <li>
                <a target="_blank" href="https://www.mindeporte.gov.co/">Coldeportes</a>
              </li>
              <li>
                <a target="_blank" href="https://minciencias.gov.co/">Colciencias</a>
              </li>
              <li>
                <a target="_blank" href="https://www.colombiaagil.gov.co/">Colombia Ágil</a>
              </li>
            </ul>
          </div>
        </div>

      </div>

    </div>
  </section>
  <?php
  $popup = new WP_Query([
    'post_type'      => 'modales', // Cambia a tu tipo de post personalizado
    'meta_key'       => '_activo_inactivo',
    'meta_value'     => '1', // Solo transmisiones activas
    'posts_per_page' => 1,   // Solo una
    'orderby'        => 'date',
    'order'          => 'DESC',
  ]);

  if ($popup->have_posts()) {
  ?>
    <div class="modal-backdrop fade"></div>
    <div class="modal fade" id="modalInicio" tabindex="-1" aria-labelledby="modalInicioLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <?php
          while ($popup->have_posts()) {
            $popup->the_post();
          ?>
            <div class="modal-header">
              <h1 class="modal-title fs-3" id="modalInicioLabel"><?php the_title(); ?></h1>
              <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php the_content(); ?>
            </div>
        </div>
      <?php } ?>
      </div>
    </div>

  <?php
  }
  get_footer();
