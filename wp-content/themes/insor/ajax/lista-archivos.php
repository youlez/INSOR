<?php
function mostrarcontenidotabla()
{
  $id = $_POST["id"];

  $html = "";

  $tipo_contenido = get_term_meta($id, 'tipo_contenido', true);

  if ($tipo_contenido == 2) {

    $html .= '
    <div id="contenido-' . $id . '">
  <table class="table border">
    <thead>
      <tr>
      <th scope="col">No.</th>
      <th scope="col">Fecha de publicación</th>
      <th scope="col">Documento</th>
      </tr>
    </thead>
    <tbody>';
  }

  $args = array(
    'post_type' => array('items-lista'),
    'post_status' => 'publish',
    'orderby'  => 'date',
    'order' => 'DESC',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'lista',
        'field'    => 'term_id',
        'terms'    => $id,
        'operator' => 'IN',
        'include_children' => false
      ),
      'relation' => 'AND'
    )
  );
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $index = 1;
    while ($query->have_posts()) {
      $query->the_post();
      if ($tipo_contenido == 2) {
        $archivo_medios = get_post_meta(get_the_ID(), 'archivo_medios', true);
        $extension = explode(".", $archivo_medios);
        $icono = "";
        if ($extension[count($extension) - 1] == "pdf" || $extension[count($extension) - 1] == "PDF") {
          $icono = '<i class="fa-solid fa-file-pdf"></i>';
        }
        if ($extension[count($extension) - 1] == "xlsx" || $extension[count($extension) - 1] == "XLSX" || $extension[count($extension) - 1] == "xls" || $extension[count($extension) - 1] == "XLS") {
          $icono = '<i class="fa-solid fa-file-excel"></i>';
        }
        if ($archivo_medios) {
          $html .= '
              <tr>
            <td>' . $index . '</td>
            <td>' . get_the_date() . '</td>
            <td>
                <a
                  class="link link-file"
                  href="' . esc_url($archivo_medios) . '"
                  target="_blank">' . $icono . get_the_title() . '
                </a>
            </td>
            </tr>';
        }
        $index++;
      } else {
        $html .= apply_filters('the_content', get_the_content());
      }

      $subhijos = get_terms(array(
        'taxonomy' => 'lista',
        'parent' => $id,
        'hide_empty' => false, // Si quieres incluir categorías vacías
        'orderby' => 'name',
        'order' => 'DESC',
      ));

      if ($subhijos && !is_wp_error($subhijos)) {
        foreach ($subhijos as $subhijo) {
          $html .= '<div class="ms-3">
                      <h3 class="fw-bold">' . $subhijo->name . '</h3>';
          $args_s = array(
            'post_type' => array('items-lista'),
            'post_status' => 'publish',
            'orderby'  => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'lista',
                'field'    => 'term_id',
                'terms'    => $subhijo->term_id,
                'operator' => 'IN',
                'include_children' => false
              ),
              'relation' => 'AND'
            )
          );
          $query_s = new WP_Query($args_s);
          if ($query_s->have_posts()) {
            $tipo_contenido_s = get_term_meta($subhijo->term_id, 'tipo_contenido', true);
            if ($tipo_contenido_s == 2) {

              $html .= '<table class="table border">
                        <thead>
                          <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Fecha de publicación</th>
                          <th scope="col">Documento</th>
                          </tr>
                        </thead>
                        <tbody>';
            }
            $index = 1;
            while ($query_s->have_posts()) {
              $query_s->the_post();
              if ($tipo_contenido_s == 2) {
                $archivo_medios = get_post_meta(get_the_ID(), 'archivo_medios', true);
                $extension = explode(".", $archivo_medios);
                $icono = "";
                if ($extension[count($extension) - 1] == "pdf" || $extension[count($extension) - 1] == "PDF") {
                  $icono = '<i class="fa-solid fa-file-pdf"></i>';
                }
                if ($extension[count($extension) - 1] == "xlsx" || $extension[count($extension) - 1] == "XLSX" || $extension[count($extension) - 1] == "xls" || $extension[count($extension) - 1] == "XLS") {
                  $icono = '<i class="fa-solid fa-file-excel"></i>';
                }
                if ($archivo_medios) {
                  $html .= '<tr>
                                <td>' . $index . '</td>
                                <td>' . get_the_date() . '</td>
                                <td>
                                    <a
                                      class="link link-file"
                                      href="' . esc_url($archivo_medios) . '"
                                      target="_blank">' . $icono . get_the_title() . '
                                    </a>
                                </td>
                              </tr>';
                }
                $index++;
              } else {
                $html .= apply_filters('the_content', get_the_content());
              }
            }
            if ($tipo_contenido_s == 2) {
              $html .= '</tbody>
              </table>
              </div>';
            }
          }
          $html .= '</div>';
        }
      }
    }
  }
  if ($tipo_contenido == 2) {
    $html .= '</tbody>
    </table>
    </div>';
  }
  echo $html;
  die();
}

add_action('wp_ajax_mostrarcontenidotabla', 'mostrarcontenidotabla');
add_action('wp_ajax_nopriv_mostrarcontenidotabla', 'mostrarcontenidotabla');
