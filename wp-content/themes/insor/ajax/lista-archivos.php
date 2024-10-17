<?php
function mostrarcontenidotabla()
{
  $id = $_POST["id"];
  $html = '
  <table class="table border" id="tabla-' . $id . '">
    <thead>
      <tr>
      <th scope="col">No.</th>
      <th scope="col">Fecha de publicación</th>
      <th scope="col">Documento</th>
      </tr>
    </thead>
    <tbody>';

  $args = array(
    'post_type' => array('items-lista'),
    'post_status' => 'publish',
    'orderby'  => 'date',
    'order' => 'DESC',
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
      $archivo_medios = get_post_meta(get_the_ID(), 'archivo_medios', true);
      if ($archivo_medios) {
        $html .= '
              <tr>
            <td>' . $index . '</td>
            <td>' . get_the_date() . '</td>
            <td>
                <a

                class="link-file"
                href="' . esc_url($archivo_medios) . '"
                target="_blank"><i class="fa-solid fa-file-pdf"></i>' . get_the_title() . '</a>

            </td>
            </tr>';
        $index++;
      }
    }
  }
  $html .= '</tbody>
    </table>';

  echo $html;
  die();
}

add_action('wp_ajax_mostrarcontenidotabla', 'mostrarcontenidotabla');
add_action('wp_ajax_nopriv_mostrarcontenidotabla', 'mostrarcontenidotabla');
