<?php
get_header();
while (have_posts()) : the_post();
  $post_name = get_post_field('post_name', get_post());
  $post_thumbnail_id = get_post_thumbnail_id();
  $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
  $alt_text = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);

  if (get_post_type() == "post") {
?>
    <section class="container my-4 page-interna">
      <div style="display: ruby;">
        <div class="miga">
          <a class="link" href="/">Inicio</a>
        </div>
        <div class="miga">
          <a class="link" href="/sala-de-prensa">Sala de Prensa</a>
        </div>
        <div class="miga">
          <a class="link" href="/noticias">Noticias</a>
        </div><span><?php the_title(); ?></span>
      </div>

      <div class="titulo-internas my-4" id="content">
        <h1 class="px-4 py-2">
          <?php the_title(); ?>
        </h1>
      </div>

      <span class="fecha_noticia"><?php echo get_the_date(); ?></span>
      <div class="mt-3">
        <img src="<?php echo $post_thumbnail_url; ?>" alt="<?php echo $alt_text; ?>" class="me-3 float-start col-12 col-lg-6">
        <?php echo the_content(); ?>
      </div>
    </section>
<?php
  }
endwhile;
get_footer();
