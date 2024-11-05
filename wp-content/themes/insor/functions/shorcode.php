<?php
// Registrar el shortcode para mostrar términos de una taxonomía personalizada
function contenido_interactivo_shortcode($atts)
{
  $id_term = $atts['id'];
  $taxonomia = $atts['tipo'];
  $term = get_term($id_term);
  $html = '<div class="my-4">
            <h2>' . $term->name . '</h2>';

  if ($taxonomia == "acordeon") {
    $args = array(
      'post_type' => array('items-' . $taxonomia),
      'post_status' => 'publish',
      'orderby'  => 'menu_order',
      'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => $taxonomia,
          'field'    => 'term_id',
          'terms'    => $id_term,
          'operator' => 'IN',
          'include_children' => false
        ),
        'relation' => 'AND'
      )
    );
  }

  if ($taxonomia == "glosario") {
    $items_glosario = wp_get_post_terms(
      get_the_id(),
      $taxonomia,
      array(
        'orderby' => 'id',
        'order' => 'ASC',
      )
    );

    if (is_array($items_glosario)) {
      foreach ($items_glosario as $item) {

        $args_abc = array(
          'post_type' => 'items-' . $taxonomia,
          'post_status' => 'publish',
          'orderby' => 'title',
          'order' => 'ASC',
          'posts_per_page' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => $taxonomia,
              'field' => 'term_id',
              'terms' => $id_term,
              'operator' => 'IN',
              'include_children' => false,
            )
          )
        );

        $query_abc = new WP_Query($args_abc);
        $titulos = [];
        $abc = [];
        if ($query_abc->have_posts())
          while ($query_abc->have_posts()) {
            $query_abc->the_post();
            $titulos[] = get_the_title();
          }

        foreach ($titulos as $titulo) {
          if (!isset($abc[substr($titulo, 0, 1)])) {
            $abc[substr($titulo, 0, 1)] = substr($titulo, 0, 1);
          }
        }
      }
      $html .= '  
            <div class="row">
              <div class="abc">
                <div class="row m-0 justify-content-center">';
      foreach (array_keys($abc) as $key => $letra) {
        $html .= '<button 
                    type="button" 
                    class="letra btn rounded-0 border-0 fw-bold ' . ($key == 0 ? 'rounded-top-1 active' : ($key == count($abc) - 1 ? 'rounded-bottom-1' : '')) . '" 
                    data-id="' . $id_term . '" data-letra="' . $letra . '">
                    ' . $letra . '
                  </button>';
      }
      $html .= '</div>
              </div>
              <div id="cargando-' . $id_term . '" class="cargando-glosario row m-0 justify-content-center p-4" style="display: none;">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Cargando ...</span>
                </div>
              </div>
              <div class="contenido-glosario" id="glosario-' . $id_term . '">';

      //incluir el filtro para glosario
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
            'taxonomy' => $taxonomia,
            'field' => 'term_id',
            'terms' => $term->term_id,
            'operator' => 'IN',
            'include_children' => false,
          ),
        ),
        // Aquí defines la letra con la que deben empezar los títulos
        'title_starts_with' => array_keys($abc)[0], // Cambia 'A' por la letra que quieras
      );
    }
  }

  $query = new WP_Query($args);
  if ($taxonomia == 'glosario') {
    //var_dump($query);
    remove_filter('posts_where', 'filter_where_title_starts_with');
  }
  if ($query->have_posts()) {
    $index = 0;

    if ($taxonomia == "acordeon") {
      $html .= '<div class="d-flex justify-content-center">
                <div class="accordion" id="accordion' . $id_term . '">';
    }

    if ($taxonomia == 'glosario') {
      $cont = ceil(count($query->posts) / 2);
      $i = 1;
      $html .= '  
                <h2 class="fs-1">' . array_keys($abc)[0] . strtolower(array_keys($abc)[0]) . '</h2>
                <div class="row">';
    }

    while ($query->have_posts()) {
      $query->the_post();
      $item_name = get_post_field('post_name', get_post());

      if ($taxonomia == "acordeon") {
        $html .= '  <div class="accordion-item">
                    <div class="accordion-header">
                      <button 
                        class="accordion-button ' . ($index == 0 ? '' : 'collapsed') . '" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#' . $item_name . '" 
                        aria-expanded="true" 
                        aria-controls="' . $item_name . '">' . get_the_title() . '
                      </button>
                    </div>
                    <div 
                      id="' . $item_name . '" 
                      class="accordion-collapse collapse ' . ($index == 0 ? 'show' : '') . '" 
                      data-bs-parent="#accordion' . $id_term . '">
                      <div class="accordion-body">' . apply_filters('the_content', get_the_content()) . '</div>
                    </div>
                  </div>';
      }
      if ($taxonomia == 'glosario') {
        if ($i == 1) {
          $html .= '  
                <div class="col-6">';
        }
        $html .= '<h3 class="fw-bold m-0">' . get_the_title() . '</h3>
                  <p>' . apply_filters('the_content', get_the_content()) . '</p>';
        if ($i == $cont) {
          $html .= '  
                </div>';
        }
        $i++;
        if ($i > $cont) {
          $i = 1;
        }
      }

      $index++;
    }
    if ($taxonomia == "acordeon") {
      $html .= '  </div>
              </div>';
    }
    if ($taxonomia == 'glosario') {
      $html .= '
      </div>';
    }
  }
  $html .= '</div>';
  return $html;
}

// Registrar el shortcode en WordPress
add_shortcode('contenido_interactivo', 'contenido_interactivo_shortcode');
