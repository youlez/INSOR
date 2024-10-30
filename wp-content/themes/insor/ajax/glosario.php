<?php
function mostrarcontenidoglosario()
{
  $id = $_POST["id"];
  $letra = $_POST["letra"];
  $html = '<h2 class="fs-1">' . $letra . strtolower($letra) . '</h2>
    <div class="row">';

  add_filter('posts_where', 'filter_where_title_starts_with', 10, 2);
  function filter_where_title_starts_with($where, $query)
  {
    global $wpdb;

    if ($query->get('title_starts_with')) {
      $first_letter = $query->get('title_starts_with');
      // Escapar y asegurar que la letra esté formateada correctamente
      $first_letter = esc_sql($first_letter);

      // Añadir condición para que el título comience con la letra específica
      $where .= " AND {$wpdb->posts}.post_title LIKE '{$first_letter}%'";
    }

    return $where;
  }
  $args = array(
    'post_type' => 'items-glosario',
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'glosario',
        'field' => 'term_id',
        'terms' => $id,
        'operator' => 'IN',
        'include_children' => false,
      ),
    ),
    // Aquí defines la letra con la que deben empezar los títulos
    'title_starts_with' => $letra, // Cambia 'A' por la letra que quieras
  );
  $query = new WP_Query($args);
  remove_filter('posts_where', 'filter_where_title_starts_with');

  if ($query->have_posts()) {

    $cont = ceil(count($query->posts) / 2);
    $i = 1;

    while ($query->have_posts()) {
      $query->the_post();

      if ($i == 1) {
        $html .= '<div class="col-6">';
      }

      $html .= '<h3 class="fw-bold m-0">' . get_the_title() . '</h3>
                <p>' . modificar_elementos(get_the_content()) . '</p>';

      if ($i == $cont) {
        $html .= '</div>';
      }

      $i++;
      if ($i > $cont) {
        $i = 1;
      }
    }
  }
  $html .= '</div>';

  echo $html;
  die();
}

add_action('wp_ajax_mostrarcontenidoglosario', 'mostrarcontenidoglosario');
add_action('wp_ajax_nopriv_mostrarcontenidoglosario', 'mostrarcontenidoglosario');
