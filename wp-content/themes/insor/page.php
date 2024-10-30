<?php
get_header();
while (have_posts()) : the_post();
  $post_name = get_post_field('post_name', get_post());
?>
  <section class="container my-4 page-interna <?php echo $post_name; ?>">
    <?php miga_pan(); ?>
    <div class="titulo-internas mb-4">
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
        if ($taxonomy == 'acordeon') {
    ?>
          <div class="my-4">

            <h2><?php echo $term->name ?></h2>
            <?php
            $args = array(
              'post_type' => array('items-acordeon'),
              'post_status' => 'publish',
              'orderby'  => 'date',
              'order' => 'ASC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'acordeon',
                  'field'    => 'term_id',
                  'terms'    => $dato->term_id,
                  'operator' => 'IN',
                  'include_children' => false
                ),
                'relation' => 'AND'
              )
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
              $index = 0;
            ?>
              <div class="d-flex justify-content-center">
                <div class="accordion" id="accordion<?php echo $dato->term_id; ?>">
                  <?php
                  while ($query->have_posts()) {
                    $query->the_post();
                    $item_name = get_post_field('post_name', get_post());
                  ?>
                    <div class="accordion-item">
                      <div class="accordion-header">
                        <button class="accordion-button <?php echo $index == 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $item_name; ?>" aria-expanded="true" aria-controls="<?php echo $item_name; ?>">
                          <?php the_title(); ?>
                        </button>
                      </div>
                      <div id="<?php echo $item_name; ?>" class="accordion-collapse collapse <?php echo $index == 0 ? 'show' : '' ?>" data-bs-parent="#accordion<?php echo $dato->term_id; ?>">
                        <div class="accordion-body">
                          <?php the_content(); ?>
                        </div>
                      </div>
                    </div>
                  <?php
                    $index++;
                  }
                  ?>

                </div>
              </div>
            <?php
            }
            ?>
          </div>
          <?php
        }
        if ($taxonomy == 'glosario') {
          $terms = wp_get_post_terms(
            get_the_id(),
            $taxonomy,
            array(
              'orderby' => 'id',
              'order' => 'ASC',
            )
          );

          if (is_array($terms))
            foreach ($terms as $term) {

              $args = array(
                'post_type' => 'items-glosario',
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
                'posts_per_page' => -1,
                'tax_query' => array(
                  array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                    'operator' => 'IN',
                    'include_children' => false,
                  )
                )
              );

              $query = new WP_Query($args);
              $titulos = [];
              $abc = [];
              if ($query->have_posts())
                while ($query->have_posts()) {
                  $query->the_post();
                  $titulos[] = get_the_title();
                }

              foreach ($titulos as $titulo) {
                if (!isset($abc[substr($titulo, 0, 1)])) {
                  $abc[substr($titulo, 0, 1)] = substr($titulo, 0, 1);
                }
              }

          ?>
            <div class="row mt-4">
              <h2>Glosario</h2>
              <div class="abc">
                <div class="row m-0 justify-content-center">
                  <?php
                  foreach (array_keys($abc) as $key => $letra) {
                  ?>
                    <button type="button" class="letra btn rounded-0 border-0 fw-bold <?php echo $key == 0 ? 'rounded-top-1 active' : ($key == count($abc) - 1 ? 'rounded-bottom-1' : '') ?>" data-id="<?php echo $term->term_id ?>" data-letra="<?php echo $letra ?>">
                      <?php
                      echo $letra;
                      ?>
                    </button>
                  <?php
                  }
                  ?>
                </div>
              </div>
              <div id="cargando-<?php echo $term->term_id ?>" class="cargando-glosario row m-0 justify-content-center p-4" style="display: none;">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Cargando ...</span>
                </div>
              </div>
              <div class="contenido-glosario" id="glosario-<?php echo $term->term_id ?>">


                <?php
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
                      'taxonomy' => $taxonomy,
                      'field' => 'term_id',
                      'terms' => $term->term_id,
                      'operator' => 'IN',
                      'include_children' => false,
                    ),
                  ),
                  // Aquí defines la letra con la que deben empezar los títulos
                  'title_starts_with' => array_keys($abc)[0], // Cambia 'A' por la letra que quieras
                );

                $query = new WP_Query($args);
                //var_dump($query);
                remove_filter('posts_where', 'filter_where_title_starts_with');

                if ($query->have_posts()) {
                  $cont = ceil(count($query->posts) / 2);
                  $i = 1;
                ?>
                  <h2 class="fs-1"><?php echo array_keys($abc)[0] . strtolower(array_keys($abc)[0]); ?></h2>
                  <div class="row">
                    <?php
                    while ($query->have_posts()) {
                      $query->the_post();
                      if ($i == 1) {
                    ?>
                        <div class="col-6">
                        <?php
                      }
                        ?>
                        <h3 class="fw-bold m-0"><?php the_title(); ?></h3>
                        <p><?php the_content(); ?></p>
                        <?php
                        if ($i == $cont) {
                        ?>
                        </div>
                    <?php
                        }
                        $i++;
                        if ($i > $cont) {
                          $i = 1;
                        }
                      }
                    ?>
                  </div>

                <?php
                }
                ?>
              </div>
            </div>
          <?php
            }
        }
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
                if ($tipo_contenido == 2) {
                ?>
                  <div class="table-responsive">
                    <div id="cargando-<?php echo $dato->term_id ?>" class=" row m-0 justify-content-center p-4" style="display: none;">
                      <div class="spinner-border" role="status">
                        <span class="visually-hidden">Cargando ...</span>
                      </div>
                    </div>
                    <div id="tabla-<?php echo $dato->term_id ?>">
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
                            var_dump($extension[1]);
                            if ($extension[1] == "pdf" || $extension[0] == "PDF") {
                              $icono = '<i class="fa-solid fa-file-pdf"></i>';
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
                    </div>
                  </div>
              <?php
                }
              }
              ?>
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
