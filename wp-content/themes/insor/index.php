<?php get_header(); ?>
<html>
<div class="container">
  <section class="pb-4">
    <?php echo do_shortcode('[serious-slider id="5"]') ?>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-lg-3 p-2 title ">
        <h3>
          MICROSITIOS
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row m-0 banner">
      <div class="col-lg-6" id="mask">
        <a href="#" class="position-relative link-micrositios">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/banner/DSC00824.JPG" class="imgBanner" alt="Banner Image">
          <p>
            INSOR <br />
            <span>EDUCATIVO</span>
            <img class="img-gif" src="<?php bloginfo('template_url'); ?>/assets/img/banner/INSOR_EDUCATIVO.gif">
          </p>
        </a>
      </div>
      <hr class="barra">
      </hr>
      <div class="col-lg-6" id="mask">
        <a href="#" class="position-relative link-micrositios">
          <img src="<?php bloginfo('template_url'); ?> /assets/img/banner/Taller Cultura Sorda 3.jpg" class="imgBanner">
          <p>
            INSOR <br />
            <span>LAB</span>
            <img class="img-gif" src="<?php bloginfo('template_url'); ?>/assets/img/banner/INSOR_EDUCATIVO.gif">
          </p>
        </a>
      </div>
    </div>
  </section>

  <section class="my-4">

    <div class="row m-0 titleContainer">
      <div class="col-lg-3 p-2 title ">
        <h3>
          INFORMATE
        </h3>
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
        ?>
            <div class="col-lg-6 py-2">
              <div class="row m-0">
                <div class="imagen p-0">
                  <img src="<?php echo $post_thumbnail_url; ?>">
                </div>
                <div class="texto p-3">
                  <span><?php echo get_the_date(); ?></span>
                  <h3 class="mb-2">
                    <?php echo get_the_title(); ?>
                  </h3>
                  <p>
                    <?php echo get_the_excerpt(); ?>
                  </p>
                </div>
              </div>
            </div>
        <?php

          }
        }

        ?>
      </div>

    </div>
    <div class="d-flex justify-content-center mt-2">
      <button type="button" class="btn btn-azul justify-self-center">VER MÁS NOTICIAS</button>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-lg-3 p-2 title ">
        <h3>
          TEMAS DE INTERÉS
        </h3>
      </div>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="row temas_Interes">
      <button type="button" class="btn btn-azul justify-self-center">VER MÁS TEMAS</button>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer my-4">
      <div class="col-lg-3 p-2 title ">
        <h3>
          DESTACADOS
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row justify-content-center">
      <div class="btn-icono m-2">
        <a href="#">
          <span class="icon-programa icon"></span>
          Programa de transparencia y ética pública
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="#">
          <span class="icon-formulario icon"></span>
          Formulario unico de solicitud de asistencia técnica
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="#">
          <span class="icon-notificaciones icon"></span>
          Notificaciones judiciales
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="#">
          <span class="icon-peticiones icon"></span>
          Peticiones, quejas, reclamos y denuncias
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="#">
          <span class="icon-contacto icon"></span>
          Contacto
        </a>
      </div>
      <div class="btn-icono m-2">
        <a href="#">
          <span class="icon-agenda icon"></span>
          Agenda INSOR
        </a>
      </div>

    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-lg-3 p-2 title ">
        <h3>
          INSOR PARA NIÑOS
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="mt-4">
      <a target="_blank" href="https://www.insor.gov.co/portalninos/">
        <img src="<?php bloginfo('template_url'); ?> /assets/img/niños/insor_niños.jpg" class="d-block w-100">
      </a>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-lg-3 p-2 title ">
        <h3>
          REDES SOCIALES
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>

    <div class="row ">
      <div class="row redes my-4">
        <div class="text-center tabsContainer">

          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active btn-tab" id="nav-facebook-tab" data-bs-toggle="tab" data-bs-target="#nav-facebook" type="button" role="tab" aria-controls="nav-facebook" aria-selected="true">Facebook</button>
              <button class="nav-link btn-tab" id="nav-x-tab" data-bs-toggle="tab" data-bs-target="#nav-x" type="button" role="tab" aria-controls="nav-x" aria-selected="false">X</button>
              <button class="nav-link btn-tab" id="nav-instagram-tab" data-bs-toggle="tab" data-bs-target="#nav-instagram" type="button" role="tab" aria-controls="nav-instagram" aria-selected="false">Instagram</button>
              <button class="nav-link btn-tab" id="nav-tiktok-tab" data-bs-toggle="tab" data-bs-target="#nav-tiktok" type="button" role="tab" aria-controls="nav-tiktok" aria-selected="false" tiktok>Tiktok</button>
            </div>
          </nav>

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-facebook" role="tabpanel" aria-labelledby="nav-facebook-tab" tabindex="0">
              <!-- <iframe frameborder="0" scrolling="no" src="https://www.facebook.com/InsorColombiaOficial/embed" ></iframe> -->
              <iframe frameborder="0" scrolling="no" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FInsorColombiaOficial&amp;tabs=timeline&amp;width=340&amp;height=400&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" style="border:none;overflow:hidden" height="500px" width="300"></iframe>
            </div>

            <div class="tab-pane fade" id="nav-x" role="tabpanel" aria-labelledby="nav-c-tab" tabindex="0">
            </div>

            <div class="tab-pane fade" id="nav-instagram" role="tabpanel" aria-labelledby="nav-instagram-tab" tabindex="0">
              <iframe frameborder="0" scrolling="no" src="https://www.instagram.com/insorcolombiaoficial/embed" height="500px" width="300"></iframe>
            </div>

            <div class="tab-pane fade" id="nav-tiktok" role="tabpanel" aria-labelledby="nav-tiktok-tab" tabindex="0">

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-lg-3 p-2 title ">
        <h3>
          ENLACES
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row m-0 enlaces_container">
      <div class="col-lg-3 justify-content-center mt-2 mb-2">
        <img src="<?php bloginfo('template_url'); ?> /assets/img/logos/Logo-Gobierno-de-Colombia-2024.png" class="d-block imgLogoEnlaces">
      </div>
      <div class="col-lg-9">
        <div class="row">
          <div class="col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a>Presidencia</a>
              </li>
              <li>
                <a>Vidcepresidencia</a>
              </li>
              <li>
                <a>MinJusticia</a>
              </li>
              <li>
                <a>MinDefensa</a>
              </li>
              <li>
                <a>MinInterior</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a>Cancillería</a>
              </li>
              <li>
                <a>MinHacienda</a>
              </li>
              <li>
                <a>MinMinas</a>
              </li>
              <li>
                <a>MinComercio</a>
              </li>
              <li>
                <a>MinTIC</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a>MinCultura</a>
              </li>
              <li>
                <a>MinAgricultura</a>
              </li>
              <li>
                <a>MinAmbiente</a>
              </li>
              <li>
                <a>MinTransporte</a>
              </li>
              <li>
                <a>MinVivienda</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a>MinEducación</a>
              </li>
              <li>
                <a>MinTrabajo</a>
              </li>
              <li>
                <a>MinSalud</a>
              </li>
              <li>
                <a>DNP</a>
              </li>
              <li>
                <a>DANE</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-2 mt-2 mb-2">
            <ul>
              <li>
                <a>DPS</a>
              </li>
              <li>
                <a>DNI</a>
              </li>
              <li>
                <a>Coldeportes</a>
              </li>
              <li>
                <a>Colciencias</a>
              </li>
              <li>
                <a>Colombia Ágil</a>
              </li>
            </ul>
          </div>
        </div>

      </div>

    </div>
  </section>


</html>
<?php
get_footer();
