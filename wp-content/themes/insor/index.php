<?php get_header(); ?>
<html>
<div class="container">
  <section class="pb-4">
    <!-- <div id="carouselExampleCaptions" class="carousel ">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner_Septiembre-08_360_1130.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner_Pag-web-INSOR_7AGO-07_360_1130.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner-69-anos-INSOR-1_360_1130.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner_Pag-web-INSOR_Manual-03_360_1130.png" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Banner-IITPS-Web_360_1130.jpg" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner_Ibague-y-Villavicencio_360_1130.jpg" class="d-block w-100">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div> -->
    <?php echo do_shortcode('[serious-slider id="5"]') ?>
  </section>

  <section class="py-4">
    <div class="row titleContainer">
      <div class="col-lg-3 p-3 title ">
        <h3>
          MICROSITIOS
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <div class="row banner">
      <div class="col-lg-6" id="mask">
        <a href="#" class="position-relative">
          <img src="<?php bloginfo('template_url'); ?>/assets/img/banner/DSC00824.JPG" class="imgBanner" alt="Banner Image" onmouseover="showTooltip(event)" onmouseout="hideTooltip()">

          <p>
            INSOR <br />
            <span>EDUCATIVO</span>
          </p>
        </a>

      </div>
      <hr class="barra">
      </hr>
      <div class="col-lg-6" id="mask">
        <a href="#" class="position-relative">
          <img src="<?php bloginfo('template_url'); ?> /assets/img/banner/Taller Cultura Sorda 3.jpg" class="imgBanner">
          <p>
            INSOR <br />
            <span>LAB</span>
          </p>
        </a>
      </div>
    </div>
  </section>

  <section class="mb-4">

    <div class="row titleContainer">
      <div class="col-lg-3 p-3 title ">
        <h3>
          INFORMATE
        </h3>
      </div>
      <div class="col-lg-8">
      </div>
    </div>

    <!-- <div class="row noticias">
      <div class="row informate-cards">

        <div class="card m-4">
          <div class="row informate-cards">
            <div class="col-md-4">
              <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner_Pag-web-INSOR_7AGO-07_360_1130.jpg">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <p class="card-text">7 agosto, 2024</p>
                <h3 class="card-title mb-2">
                  El 7 de agosto se conmemora el segundo aniversario del Gobierno del Cambio
                </h3>
                <p class="card-text">
                  Este gobierno ha priorizado la vida de las personas, enfrentando deudas
                  históricas y adaptando políticas a las necesidades actuales. En este marco, el instituto...</p>

              </div>
            </div>
          </div>
        </div>

        <div class="card m-4">
          <div class="row informate-cards">
            <div class="col-md-4">
              <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner-69-anos-INSOR-1_360_1130.jpg">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <p class="card-text">
                  15 julio, 2024
                </p>
                <h3 class="card-title mb-2">
                  69 años de inclusión y un siglo de educación
                </h3>
                <p class="card-text">
                  El instituto nacional para sordos (INSOR) conmemora con orgullosu 69° aniversario,
                  coincidiendo con el cemtemario de la educación para personas sordas en colombia...
                </p>

              </div>
            </div>
          </div>
        </div>

        <div class="card m-4">
          <div class="row informate-cards">
            <div class="col-md-4">
              <img src="<?php bloginfo('template_url'); ?> /assets/img/slider_noticias/Banner-IITPS-Web_360_1130.jpg">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <p class="card-text">
                  24 junio, 2024
                </p>
                <h3 class="card-title mb-2">
                  Se abre la convocatoria para publicar en el informe Técnico de Perspectivas y saberes - ITPS
                </h3>
                <p class="card-text">
                  En el años 2021 la subdirección de Promoción y Desarrollo implemento el informe Ténico de Perspectivas y saberes<br />
                  - ITPS como una estrategia de...
                </p>

              </div>
            </div>
          </div>
        </div>

        <div class="card m-4">
          <div class="row informate-cards">
            <div class="col-md-4">
              <img src="<?php bloginfo('template_url'); ?>/assets/img/slider_noticias/Rotabanner_Pag-web-INSOR_Manual-03_360_1130.png">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <p class="card-text">
                  28 junio, 2024
                </p>
                <h3 class="card-title mb-2">
                  Conoce el nuevo Manual de imagen de INSOR
                </h3>
                <br />
                <p class="card-text mb-2">
                  Este manual de imagen institucional reúne los elementos que
                  conforman la imagen corporativa del INSOR y describe las pautas de construcción, el uso...
                </p>

              </div>
            </div>
          </div>
        </div>



      </div>
      <button type="button" class="btn btn-azul justify-self-center">VER MÁS NOTICIAS</button>
    </div> -->


  </section>

  <section class="mb-4">
    <div class="row titleContainer">
      <div class="col-lg-3 p-3 title ">
        <h3>
          TEMAS DE INTERÉS
        </h3>
      </div>
      <div class="col-lg-8">
      </div>
    </div>
    <!-- <div class="row">

      <iframe width="1280" height="720" src="https://www.youtube.com/embed/6N31oUaEMxI" title="¿Sabes cuáles son las funciones del INSOR?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      <iframe width="1280" height="720" src="https://www.youtube.com/embed/bc8ikwawzlQ" title="¿Sabes qué hace el Instituto Nacional para Sordos? 🤓💡" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    </div>
    <button type="button" class="btn btn-azul justify-self-center">VER MÁS TEMAS</button> -->

  </section>

  <section class="mb-4">
    <div class="row titleContainer my-4">
      <div class="col-lg-3 p-3 title ">
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

  <section class="mb-4">
    <div class="row titleContainer">
      <div class="col-lg-3 p-3 title ">
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

  <section class="mb-4">
    <div class="row titleContainer">
      <div class="col-lg-3 p-3 title ">
        <h3>
          REDES SOCIALES
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <!-- <div class="row tabs_container">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="Facebook-tab" data-bs-toggle="tab" data-bs-target="#Facebook-tab-pane" type="button" role="tab" aria-controls="Facebook-tab-pane" aria-selected="true">Facebook</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="X-tab" data-bs-toggle="tab" data-bs-target="#X-tab-pane" type="button" role="tab" aria-controls="X-tab-pane" aria-selected="false">X</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="Instagram-tab" data-bs-toggle="tab" data-bs-target="#Instagram-tab-pane" type="button" role="tab" aria-controls="Instagram-tab-pane" aria-selected="false">Instagram</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="Tiktok-tab" data-bs-toggle="tab" data-bs-target="#Tiktok-tab-pane" type="button" role="tab" aria-controls="Tiktok-tab-pane" aria-selected="false">Tiktok</button>
        </li>
      </ul>
      <div class="tab-content nav-tabs" id="myTabContent">
        <div class="tab-pane fade show active" id="Facebook-tab-pane" role="tabpanel" aria-labelledby="Facebook-tab" tabindex="0">
          <iframe frameborder="0" scrolling="no" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FInsorColombiaOficial&amp;tabs=timeline&amp;width=340&amp;height=400&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" style="border:none;overflow:hidden" width="340"></iframe>
        </div>
        <div class="tab-pane fade" id="X-tab-pane" role="tabpanel" aria-labelledby="X-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="Instagram-tab-pane" role="tabpanel" aria-labelledby="Instagram-tab" tabindex="0">
          <iframe frameborder="0" scrolling="no" src="https://www.instagram.com/insorcolombiaoficial/embed" height="500px" width="440"></iframe>
        </div>
        <div class="tab-pane fade" id="Tiktok-tab-pane" role="tabpanel" aria-labelledby="Tiktok-tab" tabindex="0">...</div>
      </div>
    </div> -->
  </section>

  <section class="mb-4">
    <div class="row titleContainer">
      <div class="col-lg-3 p-3 title ">
        <h3>
          ENLACES
        </h3>
      </div>
      <div class="col-lg-8"> </div>
    </div>
    <!-- <div class="row enlaces_container">
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

    </div> -->
  </section>
</div>

</html>
<?php
get_footer();
