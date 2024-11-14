<?php
get_header();
while (have_posts()) : the_post();
  $post_name = get_post_field('post_name', get_post());
?>
  <div class="container mt-4">
    <?php miga_pan(); ?>
  </div>
  <section class="container my-4 page-interna <?php echo $post_name; ?>" id="content">
    <div class="titulo-internas my-4">
      <h1 class="px-4 py-2">
        <?php the_title(); ?>
      </h1>
    </div>
    <div><?php the_content(); ?></div>
    <?php

    // Obtiene el ID de la página actual o especifica el ID de la página deseada
    $page_id = get_the_ID(); // o coloca el ID de la página específica aquí

    $ordenes = get_post_meta($page_id, '_orden_taxonomias', true);
    if ($ordenes == "") {
      $ordenes = [];
    }

    // Obtiene todas las taxonomías registradas para el tipo de post 'page'
    $taxonomies = get_object_taxonomies('page', 'names');

    $selected_parent_terms = [];

    foreach ($taxonomies as $taxonomy) {
      // Obtiene los términos seleccionados de cada taxonomía en la página
      $terms = get_the_terms($page_id, $taxonomy);
      if ($terms && !is_wp_error($terms)) {
        // Filtra solo los términos que son padres (parent == 0)
        $parent_terms = array_filter($terms, function ($term) {
          return is_object($term) && $term->parent === 0;
        });

        // Agrega el campo 'orden' si el término está en el array $ordenes
        foreach ($parent_terms as &$term) { // Usa referencia (&) para modificar el término
          if (array_key_exists($term->term_id, $ordenes)) {
            $term->orden = $ordenes[$term->term_id];
          } else {
            $term->orden = 0; // Opcional: establece 'orden' como null si no está en el array
          }
        }

        // Ordena los términos por el campo 'orden'
        usort($parent_terms, function ($a, $b) {
          return $a->orden <=> $b->orden;
        });

        if (!empty($parent_terms)) {
          $selected_parent_terms[$taxonomy] = $parent_terms;
        }
      }
    }

    // Muestra los términos seleccionados por taxonomía, ordenados por 'orden'
    foreach ($selected_parent_terms as $taxonomy => $datos) {

      foreach ($datos as $dato) {

        if ($taxonomy == 'lista') {
          // Obtener los hijos de la categoría actual
          $hijos = get_terms(array(
            'taxonomy' => $taxonomy,
            'parent' => $dato->term_id,
            'hide_empty' => false, // Si quieres incluir categorías vacías
            'orderby' => 'name',
            'order' => 'DESC',
          ));

          // Mostrar los hijos (subcategorías)
          if ($hijos && !is_wp_error($hijos)) {
    ?>

            <h2><?php echo $dato->name ?></h2>
            <div class="row mb-4">
              <div class="col-3">
                <label class="form-label" for="<?php echo $dato->term_id ?>">Seleccione una opción:</label>
                <select class="form-select select-insor lista-year" id="<?php echo $dato->term_id ?>" aria-label="<?php echo $dato->term_id ?>">
                  <?php
                  $index = 0;
                  foreach ($hijos as $hijo) {
                  ?>
                    <option value="<?php echo $hijo->term_id ?>" <?php echo $index == 0 ? 'selected' : '' ?>><?php echo $hijo->name ?></option>
                  <?php
                    $index++;
                  } ?>

                </select>
              </div>
              <div class="col-9">
              <?php
            }
            $args = array(
              'post_type' => array('items-lista'),
              'post_status' => 'publish',
              'orderby'  => 'date',
              'order' => 'DESC',
              'posts_per_page' => -1,
              'tax_query' => array(
                array(
                  'taxonomy' => $taxonomy,
                  'field'    => 'term_id',
                  'terms'    => $hijos[0]->term_id,
                  'operator' => 'IN',
                  'include_children' => false
                ),
                'relation' => 'AND'
              )
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
              $tipo_contenido = get_term_meta($hijos[0]->term_id, 'tipo_contenido', true);
              ?>
                <div class="table-responsive">
                  <div id="cargando-<?php echo $dato->term_id ?>" class=" row m-0 justify-content-center p-4" style="display: none;">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Cargando ...</span>
                    </div>
                  </div>
                  <div id="contenido-<?php echo $dato->term_id ?>">
                    <?php
                    if ($tipo_contenido == 2) {
                    ?>
                      <table class="table border">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Fecha de publicación</th>
                            <th scope="col">Documento</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          $index = 1;
                          while ($query->have_posts()) {
                            $query->the_post();
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

                          ?>
                              <tr>
                                <td><?php echo $index; ?></td>
                                <td><?php echo get_the_date(); ?></td>
                                <td>
                                  <a

                                    class="link link-file"
                                    href="<?php echo esc_url($archivo_medios); ?>"
                                    target="_blank">
                                    <?php
                                    echo $icono;
                                    the_title(); ?>
                                  </a>

                                </td>
                              </tr>
                          <?php
                              $index++;
                            }
                          }
                          ?>

                        </tbody>
                      </table>
                      <?php
                    } else {

                      while ($query->have_posts()) {
                        $query->the_post();
                      ?>
                        <h3 class="fw-bold"><?php the_title() ?></h3>
                      <?php
                        the_content();
                      }
                    }

                    $subhijos = get_terms(array(
                      'taxonomy' => $taxonomy,
                      'parent' => $hijos[0]->term_id,
                      'hide_empty' => false, // Si quieres incluir categorías vacías
                      'orderby' => 'name',
                      'order' => 'DESC',
                    ));


                    if ($subhijos && !is_wp_error($subhijos)) {
                      foreach ($subhijos as $subhijo) {
                      ?>
                        <div class="ms-3">
                          <h3 class="fw-bold"><?php echo $subhijo->name ?></h3>
                          <?php
                          $args = array(
                            'post_type' => array('items-lista'),
                            'post_status' => 'publish',
                            'orderby'  => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                              array(
                                'taxonomy' => $taxonomy,
                                'field'    => 'term_id',
                                'terms'    => $subhijo->term_id,
                                'operator' => 'IN',
                                'include_children' => false
                              ),
                              'relation' => 'AND'
                            )
                          );
                          $query = new WP_Query($args);
                          if ($query->have_posts()) {
                            $tipo_contenido_s = get_term_meta($subhijo->term_id, 'tipo_contenido', true);
                          ?>
                            <div class="table-responsive">
                              <?php
                              if ($tipo_contenido_s == 2) {
                              ?>
                                <table class="table border">
                                  <thead>
                                    <tr>
                                      <th scope="col">No.</th>
                                      <th scope="col">Fecha de publicación</th>
                                      <th scope="col">Documento</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    $index = 1;
                                    while ($query->have_posts()) {
                                      $query->the_post();
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

                                    ?>
                                        <tr>
                                          <td><?php echo $index; ?></td>
                                          <td><?php echo get_the_date(); ?></td>
                                          <td>
                                            <a

                                              class="link link-file"
                                              href="<?php echo esc_url($archivo_medios); ?>"
                                              target="_blank">
                                              <?php
                                              echo $icono;
                                              the_title(); ?>
                                            </a>

                                          </td>
                                        </tr>
                                    <?php
                                        $index++;
                                      }
                                    }
                                    ?>

                                  </tbody>
                                </table>
                                <?php

                              } else {
                                while ($query->have_posts()) {
                                  $query->the_post();
                                ?>
                                  <div class="ms-3">
                                    <h3 class="fw-bold"><?php the_title() ?></h3>
                                    <?php
                                    the_content();
                                    ?>
                                  </div>
                              <?php
                                }
                              }
                              ?>
                            </div>
                          <?php
                          }
                          ?>
                        </div>
                  </div>
                </div>
          <?php
                      }
                    }
                  }
          ?>
              </div>
            </div>
            </div>
      <?php
        }
      }
    }
      ?>
  </section>
<?php
endwhile;
get_footer();
