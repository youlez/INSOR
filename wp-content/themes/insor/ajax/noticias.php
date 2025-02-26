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

      $logo = false;
      if (!is_array(@getimagesize($post_thumbnail_url))) {
        $logo = true;
        $post_thumbnail_url = get_bloginfo('url') . "/wp-content/uploads/2024/10/logo-principal.png";
      }
      $alt_text = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
      $html .= '
            <div class="col-lg-6 py-2">
              <a class="link-noticias row m-0" href="' . get_bloginfo('url') . '/' . get_post_field('post_name', get_post()) . '" target="_blank" aria-label="' . get_the_title() . '">
                <div class="imagen ' . ($logo ? 'd-flex align-items-center' : 'p-0') . '">
                  <img src="' . $post_thumbnail_url . '" alt="' . $alt_text . '" ' . ($logo ? 'style="height: auto;"' : '') . '>
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

function mostrar_transmisiones($pagenumber, $ancho)
{
  $args = array(
    'post_type' => array('transmisiones'),
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
      $video = "";

      if ($post_thumbnail_url == "") {
        // Buscar la URL del iframe usando una expresión regular
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
      }

      $html .= '
            <div class="col-lg-6 py-2 position-relative">
              <div class="ratio ratio-16x9" style="z-index = -1">';

      if ($post_thumbnail_url != "") {
        $html .= '
                <img src="' . $post_thumbnail_url . '" alt="' . $alt_text . '">';
      } else {
        $html .= $video;
      }
      $html .= '      
              </div>  
              <div class="texto p-3">
                <span>' . get_the_date() . '</span>
                <h2 class="m-0">
                  ' . get_the_title() . '
                </h2>
              </div>
              <a class="link-transmisiones row m-0" href="' . get_bloginfo('url') . '/' . get_post_field('post_name', get_post()) . '" target="_blank" aria-label="' . get_the_title() . '">                                              
              </a>
            </div>';
    }
  }
  $html .= paginacion($query->max_num_pages, $pagenumber, $ancho);
  //var_dump($args);
  return $html;
}

function mostrar_videos($pagenumber, $ancho)
{
  $args = array(
    'post_type' => array('videos'),
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
      $video = "";

      if ($post_thumbnail_url == "") {
        // Buscar la URL del iframe usando una expresión regular
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
      }

      $html .= '
            <div class="col-lg-6 py-2 position-relative">
              <div class="ratio ratio-16x9" style="z-index = -1">';

      if ($post_thumbnail_url != "") {
        $html .= '
                <img src="' . $post_thumbnail_url . '" alt="' . $alt_text . '">';
      } else {
        $html .= $video;
      }
      $html .= '      
              </div>  
              <div class="texto p-3">
                <span>' . get_the_date() . '</span>
                <h2 class="m-0">
                  ' . get_the_title() . '
                </h2>
              </div>
              <a class="link-transmisiones row m-0" href="' . get_bloginfo('url') . '/' . get_post_field('post_name', get_post()) . '" target="_blank" aria-label="' . get_the_title() . '">                                              
              </a>
            </div>';
    }
  }
  $html .= paginacion($query->max_num_pages, $pagenumber, $ancho);
  //var_dump($args);
  return $html;
}
