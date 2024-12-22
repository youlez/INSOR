<?php
add_filter('manage_edit-transmisiones_columns', function ($columns) {
    $columns['activo_inactivo'] = 'Mostrar en el Inicio';
    return $columns;
});

add_action('manage_transmisiones_posts_custom_column', function ($column, $post_id) {
    if ($column === 'activo_inactivo') {
        $activo = get_post_meta($post_id, '_activo_inactivo', true) === '1';
?>
        <input type="checkbox" data-post-id="<?php echo $post_id; ?>" class="switch-activo-inactivo" <?php checked($activo); ?>>
<?php
    }
}, 10, 2);

add_action('wp_ajax_guardar_activo_inactivo', function () {
    if (!isset($_POST['post_id'], $_POST['activo'])) {
        wp_send_json_error('Datos faltantes');
    }

    $post_id = intval($_POST['post_id']);
    $activo = sanitize_text_field($_POST['activo']);

    update_post_meta($post_id, '_activo_inactivo', $activo);
    wp_send_json_success('Guardado correctamente');
});

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('switch-transmisiones', get_template_directory_uri() . '/js/back/transmisiones.js', ['jquery'], null, true);
});
