<?php
add_filter('manage_edit-modales_columns', function ($columns) {
    $columns['activo_inactivo'] = 'Mostrar en el Inicio';
    return $columns;
});

add_action('manage_modales_posts_custom_column', function ($column, $post_id) {
    if ($column === 'activo_inactivo') {
        $activo = get_post_meta($post_id, '_activo_inactivo', true) === '1';
?>
        <input type="checkbox" data-post-id="<?php echo $post_id; ?>" class="switch-activo-inactivo" <?php checked($activo); ?>>
<?php
    }
}, 10, 2);

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('switch-modales', get_template_directory_uri() . '/js/back/transmisiones.js', ['jquery'], null, true);
});
