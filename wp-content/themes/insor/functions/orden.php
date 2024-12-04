<?php
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
        update_term_meta($term_id, 'orden_lista', sanitize_text_field($_POST['orden_lista']));
    }
}

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
        $clauses['orderby'] = "ORDER BY CAST(tm.meta_value AS UNSIGNED) ASC, t.name";
    }

    return $clauses;
}
