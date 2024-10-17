</div>
</body>
<footer>
  <div class="position-relative">
    <div class="gov-fondo position-absolute"></div>
    <div class="container">
      <div class="govco-data-front position-relative">
        <div class="row py-3 p-4">
          <div class="col-12 col-lg-7">
            <a href="/" rel="home" class="col-12 d-flex d-lg-none justify-content-center mb-3" aria-label="Portal INSOR  - Instituto Nacional para Sordos">
              <?php
              $logo_header = get_theme_mod('logo');

              if ($logo_header) {
                echo '<img class="img-fluid" src="' . $logo_header . '" alt="' . get_bloginfo('name') . '">';
              } else {
                bloginfo('name');
              }

              ?>
            </a>
            <?php if (is_active_sidebar('sidebar-footer')) : ?>
              <?php dynamic_sidebar('sidebar-footer'); ?>
            <?php endif; ?>
          </div>
          <div class="col-12 col-lg-5">
            <div class="row justify-content-center d-none d-lg-flex">
              <a href="/" rel="home" class="col-10 col-sm-8 col-md-7" aria-label="Portal INSOR  - Instituto Nacional para Sordos">
                <?php
                $logo_header = get_theme_mod('logo');

                if ($logo_header) {
                  echo '<img class="img-fluid" src="' . $logo_header . '" alt="' . get_bloginfo('name') . '">';
                } else {
                  bloginfo('name');
                }

                ?>
              </a>
            </div>
            <div class="mt-lg-4">
              <div class="row redes">
                <div class="col-12 col-lg-6">
                  <a
                    href="https://x.com/insorcolombia"
                    alt="X"
                    title="Ir a X"
                    target="_blank">
                    <i class="fa-brands fa-square-x-twitter"></i>
                    @insorcolombia
                  </a>
                </div>
                <div class="mt-2 mt-sm-0 col-12 col-lg-6">
                  <a
                    href="https://www.instagram.com/insorcolombiaoficial/"
                    alt="Instagram"
                    title="Ir a Instagram"
                    target="_blank"
                    class="icono-instagram">
                    @insorcolombiaoficial
                  </a>
                </div>
                <div class="mt-2 col-12 col-lg-6">
                  <a
                    href="https://www.facebook.com/InsorColombiaOficial"
                    alt="Facebook"
                    title="Ir a Facebook"
                    target="_blank"
                    class="icono-facebook">
                    InsorColombiaOficial
                  </a>
                </div>
                <div class="mt-2 col-12 col-lg-6">
                  <a
                    href="https://www.youtube.com/channel/UCJQPAjZYGirtoNRraMgfc2w"
                    alt="Youtube"
                    title="Ir a Youtube"
                    target="_blank"
                    class="icono-youtube">
                    @INSOR_colombia
                  </a>
                </div>
                <div class="mt-2 col-12 col-lg-6">
                  <a
                    href="https://www.linkedin.com/company/insor---instituto-nacional-para-sordos/"
                    alt="Linkedin"
                    title="Ir a Linkedin"
                    target="_blank"
                    class="icono-linkedin">
                    INSOR
                  </a>
                </div>
                <div class="mt-2 col-12 col-lg-6">
                  <a
                    href="https://www.tiktok.com/@insorcolombia"
                    alt="Tiktok"
                    title="Ir a Tiktok"
                    target="_blank"
                    class="icono-tiktok">
                    @insorcolombia
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 mt-4">
            <div class="gov-link">
              <div class="row">
                <div class="col-12 col-lg-4">
                  <a class="" href="#" target="_blank">Política de privacidad y condiciones de uso</a>
                </div>
                <div class="col-12 col-lg-5">
                  <a class="" href="#" target="_blank">Política de privacidad y tratamiento de datos personales</a>
                </div>
                <div class="col-12 col-lg-1">
                  <a class="" href="#" target="_blank">Contacto</a>
                </div>
                <div class="col-12 col-lg-2">
                  <a class="" href="#" target="_blank">Mapa del sitio</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="govco-footer-logo position-relative">
    <div class="govco-logo-container">
      <a href="https://colombia.co/" target="_blank">
        <span class="govco-co"></span></a>
      <span class="govco-separator"></span>
      <a href="https://www.gov.co/" target="_blank">
        <span class="govco-logo"></span></a>
    </div>
  </div>

</footer>
<?php
wp_footer();
