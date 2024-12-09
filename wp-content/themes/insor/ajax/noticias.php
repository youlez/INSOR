<?php
function mostrar_noticias($pagenumber, $ancho)
{
  $args = array(
    'post_type' => array('post'),
    'post_status' => 'publish',
    'orderby'  => 'date',
    'order' => 'DESC',
    'posts_per_page' => 8,
    'paged' =>  $pagenumber
  );
  $html = "";
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $post_thumbnail_id = get_post_thumbnail_id();
      $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
      $alt_text = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
      $html .= '
            <div class="col-lg-6 py-2">
                <a class="link-noticias row m-0" href="' . get_bloginfo('url') . '/' . get_post_field('post_name', get_post()) . '" aria-label="' . get_the_title() . '">
                  <div class="imagen p-0">
                    <img src="' . $post_thumbnail_url . '" alt="' . $alt_text . '">
                  </div>
                  <div class="texto p-3">
                    <span>' . get_the_date() . '</span>
                    <h2 class="mb-2">
                      ' . get_the_title() . '
                    </h2>
                    <p>
                      ' . get_the_excerpt() . '
                    </p>
                  </div>
                </a>
              </div>';
    }
  }
  $html .= paginacion($query->max_num_pages, $pagenumber, $ancho);
  //var_dump($args);
  return $html;
}
