<?php get_header(); ?>
<html>
<div class="container contenedor">
  <section class="pb-4">
    <?php echo do_shortcode('[serious-slider id="5"]') ?>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
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
      <hr class="barra d-none d-lg-block">
      </hr>
      <div class="col-lg-6" id="mask">
        <a href="#" class="position-relative link-micrositios">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/banner/Taller_Cultura_Sorda_3.jpg" class="imgBanner">
          <p>
            INSOR <br />
            <span>LAB</span>
            <img class="img-gif" src="<?php bloginfo('template_url'); ?>/assets/img/banner/BIDES.gif">
          </p>
        </a>
      </div>
    </div>
  </section>

  <section class="py-4">

    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
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
              <a class="link-noticias row m-0" href="<?php bloginfo('url'); ?>/<?php echo get_post_field('post_name', get_post()); ?>">
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
              </a>
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
    <div class="row m-0 titleContainer mb-4">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h3>
          TEMAS DE INTERÉS
        </h3>
      </div>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="row m-0 temas_Interes">

      <!-- <div class="row align-items-center  m-4">
        <div class="col-md-3">
          <div class="video-container prev">
            <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FInsorColombiaOficial%2Fvideos%2F459759910166884%2F%3Fref%3Dembed_video&show_text=0&width=560" width="560" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            <div class="video-overlay" data-action="prev"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="video-container center-video">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/bc8ikwawzlQ?si=3JwdMncva7sccN6L" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-md-3">
          <div class="video-container next">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/6N31oUaEMxI?si=oL-IQTixCUbt7cJp" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <div class="video-overlay" data-action="next"></div>
          </div>
        </div>
      </div> -->
      <button type="button" class="btn btn-azul justify-self-center">VER MÁS TEMAS</button>
    </div>

  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer my-4">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h3>
          DESTACADOS
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row m-0 justify-content-center">
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
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h3>
          INSOR PARA NIÑOS
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="mt-4 position-relative link-kids">
      <a target="_blank" href="https://www.insor.gov.co/portalninos/">
        <div class="tituloKids position-absolute">
          <p>
            INSOR <br />
            <span>PARA NIÑOS</span>
          </p>
        </div>
        <img src="<?php bloginfo('template_url'); ?>/assets/img/niños/Insor_niños.jpg" class="d-block w-100">
      </a>
    </div>
  </section>

  <section class="py-4">
    <div class="row m-0 titleContainer">
      <div class="col-7 col-sm-5 col-md-4 col-lg-3 p-2 title">
        <h3>
          REDES SOCIALES
        </h3>
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
        <h3>
          ENLACES
        </h3>
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
                <a target="_blank" href="https://www.vicepresidencia.gov.co/">Vidcepresidencia</a>
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


</html>
<?php
get_footer();
