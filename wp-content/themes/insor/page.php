<?php
get_header();
while (have_posts()) : the_post();
  $post_name = get_post_field('post_name', get_post());
?>
  <section class="container my-4 page-interna <?php echo $post_name; ?>">
    <div class="titulo-internas mb-4">
      <h1 class="px-4 py-2">
        <?php the_title(); ?>
      </h1>
    </div>
    <div><?php the_content(); ?></div>
    <?php
    $terms = wp_get_post_terms(
      get_the_id(),
      'acordeon',
      array(
        'orderby' => 'id',
        'order' => 'ASC',
      )
    );
    //get_the_terms(get_the_id(), 'acordeon');
    if (is_array($terms))
      foreach ($terms as $term) {
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
              'terms'    => $term->term_id,
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
            <div class="accordion" id="accordion<?php echo $term->term_id; ?>">
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
                  <div id="<?php echo $item_name; ?>" class="accordion-collapse collapse <?php echo $index == 0 ? 'show' : '' ?>" data-bs-parent="#accordion<?php echo $term->term_id; ?>">
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

    $terms = get_the_terms(get_the_id(), 'lista');
    if (is_array($terms))
      foreach ($terms as $term) {
        // Obtener los hijos de la categoría actual
        $hijos = get_terms(array(
          'taxonomy' => 'lista',
          'parent' => $term->term_id,
          'hide_empty' => false, // Si quieres incluir categorías vacías
          'orderby' => 'name',
          'order' => 'DESC',
        ));

        // Mostrar los hijos (subcategorías)
        if ($hijos && !is_wp_error($hijos)) {
      ?>

        <h2><?php echo $term->name ?></h2>
        <div class="row">
          <div class="col-3">
            <label class="form-label" for="<?php echo $term->term_id ?>">Seleccione el año de su interés:</label>
            <select class="form-select select-insor lista-year" id="<?php echo $term->term_id ?>" aria-label="<?php echo $term->term_id ?>">
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
          'tax_query' => array(
            array(
              'taxonomy' => 'lista',
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
          ?>
            <div class="table-responsive">
              <div id="cargando-<?php echo $term->term_id ?>" class=" row m-0 justify-content-center p-4" style="display: none;">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Cargando ...</span>
                </div>
              </div>
              <table class="table border" id="tabla-<?php echo $term->term_id ?>">
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
                    if ($archivo_medios) {

                  ?>
                      <tr>
                        <td><?php echo $index; ?></td>
                        <td><?php echo get_the_date(); ?></td>
                        <td>
                          <a

                            class="link-file"
                            href="<?php echo esc_url($archivo_medios); ?>"
                            target="_blank"><?php the_title(); ?></a>

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
          <?php
        }
          ?>
          </div>
        </div>
      <?php
      }

    $terms = wp_get_post_terms(
      get_the_id(),
      'glosario',
      array(
        'orderby' => 'id',
        'order' => 'ASC',
      )
    );

    if (is_array($terms))
      foreach ($terms as $term) {
        $abc = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
      ?>
        <div class="row mt-4">
          <h2>Glosario</h2>
          <div class="row m-0 justify-content-center abc">
            <?php
            foreach ($abc as $key => $letra) {
            ?>
              <button type="button" class="btn rounded-0 border-0 fw-bold <?php echo $key == 0 ? 'rounded-top-1 active' : ($key == count($abc) - 1 ? 'rounded-bottom-1' : '') ?>">
                <?php
                echo $letra;
                ?>
              </button>
            <?php
            }
            ?>
          </div>
          <div class="contenido-glosario">
            <?php

            $args = array(
              'post_type' => array('items-glosario'),
              'post_status' => 'publish',
              'orderby'  => 'date',
              'order' => 'ASC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'glosario',
                  'field'    => 'term_id',
                  'terms'    => $term->term_id,
                  'operator' => 'IN',
                  'include_children' => false
                ),
                'relation' => 'AND',
                'limit' => 1
              )
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) {
              $index = 0;
              while ($query->have_posts()) {
                $query->the_post();
            ?>
                <h3 class="fw-bold"><?php the_title(); ?></h3>
                <p><?php the_content(); ?></p>
            <?php
              }
            }
            ?>
          </div>
        </div>
      <?php
      }
      ?>
  </section>
<?php
endwhile;
get_footer();
