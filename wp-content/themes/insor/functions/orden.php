<?php
//se agrega campo de orden 
add_action('lista_add_form_fields', function () {
?>
    <div class="form-field">
        <label for="orden_lista">Orden</label>
        <input type="number" name="orden_lista" id="orden_lista" value="" style="width: 70px;" />
    </div>
<?php
});

add_action('lista_edit_form_fields', function ($term) {
    $orden_lista = get_term_meta($term->term_id, 'orden_lista', true);
?>
    <tr class="form-field">
        <th scope="row">
            <label for="orden_lista">Orden</label>
        </th>
        <td>
            <input type="number" name="orden_lista" id="orden_lista" style="width: 70px;" value="<?php echo esc_attr($orden_lista); ?>" />
        </td>
    </tr>
<?php
});

add_action('create_lista', 'save_orden_lista');
add_action('edited_lista', 'save_orden_lista');

function save_orden_lista($term_id)
{
    if (isset($_POST['orden_lista'])) {
        if (sanitize_text_field($_POST['orden_lista']) == "") {
            delete_term_meta($term_id, 'orden_lista');
        } else {
            update_term_meta($term_id, 'orden_lista', sanitize_text_field($_POST['orden_lista']));
        }
    }
}

//se agrega check de ordenamiento por orden
add_action('lista_add_form_fields', function () {
?>
    <div class="form-field">
        <label for="ordenamiento">Ordenamiento</label>
        <select class="form-select" name="ordenamiento" id="ordenamiento">
            <option selected></option>
            <option value="1">Por campo de orden ascendente</option>
            <option value="2">Por campo de orden descendente</option>
        </select>
    </div>
<?php
});

add_action('lista_edit_form_fields', function ($term) {
    $ordenamiento = get_term_meta($term->term_id, 'ordenamiento', true);
?>
    <tr class="form-field">
        <th scope="row">
            <label for="ordenamiento">Ordenamiento</label>
        </th>
        <td>
            <select class="form-select" name="ordenamiento" id="ordenamiento">
                <option <?php if ($ordenamiento == '') { ?> selected<?php } ?>></option>
                <option value="1" <?php if ($ordenamiento == '1') { ?> selected<?php } ?>>Por campo de orden ascendente</option>
                <option value="2" <?php if ($ordenamiento == '2') { ?> selected<?php } ?>>Por campo de orden descendente</option>
            </select>
        </td>
    </tr>
<?php
});

add_action('create_lista', 'save_ordenamiento');
add_action('edited_lista', 'save_ordenamiento');

function save_ordenamiento($term_id)
{
    if (isset($_POST['ordenamiento'])) {
        $ordenamiento = sanitize_text_field($_POST['ordenamiento']);
        if ($ordenamiento == '') {
            delete_term_meta($term_id, 'ordenamiento');
        } else {
            update_term_meta($term_id, 'ordenamiento', $ordenamiento);
        }
    }
}

//funcion para ordenar por campo de orden

add_filter('terms_clauses', 'order_terms_by_meta', 10, 3);
function order_terms_by_meta($clauses, $taxonomy, $args)
{
    global $wpdb;

    // Verifica si estás ordenando por el meta deseado
    if (isset($args['orderby']) && $args['orderby'] === 'orden_lista') {
        // Asegúrate de que `termmeta` esté unido usando el alias correcto
        $clauses['join'] .= " 
            LEFT JOIN {$wpdb->termmeta} AS tm ON tm.term_id = t.term_id AND tm.meta_key = 'orden_lista'";


        // Modifica el orden de los términos con el prefijo correcto
        $clauses['orderby'] = "ORDER BY CAST(tm.meta_value AS UNSIGNED)";
    }

    return $clauses;
}
