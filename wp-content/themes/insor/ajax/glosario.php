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
        while ($query->have_posts()) {
            $query->the_post();
            $html .= '<div class="col-6"><h3 class="fw-bold m-0">' . get_the_title() . '</h3><p>' . get_the_content() . '</p></div>';
        }
    }
    $html .= '</div>';

    echo $html;
    die();
}

add_action('wp_ajax_mostrarcontenidoglosario', 'mostrarcontenidoglosario');
add_action('wp_ajax_nopriv_mostrarcontenidoglosario', 'mostrarcontenidoglosario');
