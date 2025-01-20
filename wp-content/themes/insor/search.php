<?php
get_header();
?>
<section class="container my-4 page-interna <?php echo $post_name; ?>" id="content">
  <div class="titulo-internas my-4">
    <h1 class="px-4 py-2">Resultados de la búsqueda</h1>
  </div>
  <?php if (have_posts()) :
    // Obtener el término de búsqueda
    $search_query = get_search_query();
  ?>

    <p>Resultados para: <b><i>"<?php echo esc_html($search_query); ?>"</i></b></p>
    <div class="row">
      <?php while (have_posts()) : the_post(); ?>
        <div class="col-lg-6 my-2">
          <div class="texto">
            <a class="link" target="_blank" href="<?php echo get_bloginfo('url') . '/' . get_post_field('post_name', get_post()); ?>">
              <h2><?php the_title(); ?></h2>
            </a>
            <p><?php the_excerpt(); ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else : ?>
    <p>No se encontraron resultados.</p>
  <?php endif; ?>
</section>
<?php
get_footer();
