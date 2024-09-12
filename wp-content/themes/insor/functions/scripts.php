<?php
function cargar_scripts()
{
?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php

    wp_register_script('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js', array('jquery'), false, false);
    wp_enqueue_script('bootstrap');
}

function cargar_estilos()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.css', array(), false, 'all');
    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '2024.09.11.01', 'all');

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'cargar_scripts');
add_action('wp_enqueue_scripts', 'cargar_estilos');
