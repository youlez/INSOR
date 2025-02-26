<?php
get_header();
while (have_posts()) : the_post();
  $post_name = get_post_field('post_name', get_post());
  $post_thumbnail_id = get_post_thumbnail_id();
  $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
  $alt_text = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
?>
  <section class="container my-4 page-interna">
    <div style="display: ruby;">
      <div class="miga">
        <a class="link" href="<?php bloginfo('url'); ?>/">Inicio</a>
      </div>
      <?php
      if (get_post_type() == "post") {
      ?>
        <div class="miga">
          <a class="link" href="<?php bloginfo('url'); ?>/sala-de-prensa">Sala de Prensa</a>
        </div>
        <div class="miga">
          <a class="link" href="<?php bloginfo('url'); ?>/noticias">Noticias</a>
        </div>
      <?php
      }

      if (get_post_type() == "transmisiones") {
      ?>
        <div class="miga">
          <a class="link" href="<?php bloginfo('url'); ?>/transmisiones">Transmisiones</a>
        </div>
      <?php
      }

      if (get_post_type() == "videos") {
      ?>
        <div class="miga">
          <a class="link" href="<?php bloginfo('url'); ?>/temas-de-interes">Temas de Interés</a>
        </div>
      <?php
      }
      ?>
      <span><?php the_title(); ?></span>
    </div>

    <div class="titulo-internas my-4" id="content">
      <h1 class="px-4 py-2">
        <?php the_title(); ?>
      </h1>
    </div>
    <?php
    if (get_post_type() == "post") {
    ?>
      <span class="fecha_noticia"><?php echo get_the_date(); ?></span>
    <?php
    }
    ?>
    <div class="mt-3">
      <?php
      if ($post_thumbnail_url != "" && get_post_type() != "transmisiones" && get_post_type() != "videos" && get_post_type() != "post") {
      ?>
        <img src="<?php echo $post_thumbnail_url; ?>" alt="<?php echo $alt_text; ?>" class="col-12 offset-lg-3 col-lg-6">
      <?php
      }
      echo the_content(); ?>
    </div>
  </section>
<?php
endwhile;
get_footer();
