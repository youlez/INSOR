<?php
function cargar_scripts()
{
?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php

    wp_register_script('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js', array('jquery'), false, false);
    wp_register_script('bootstrap-bundle', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), false, false);
    wp_register_script('general', get_template_directory_uri() . '/js/general.js', array(), '2024.09.19.01', 'all');
    wp_register_script('menu', get_template_directory_uri() . '/js/menu.js', array(), '2024.09.19.01', 'all');
    wp_register_script('home', get_template_directory_uri() . '/js/home.js', array(), '2024.09.19.01', 'all');

    wp_enqueue_script('bootstrap');
    wp_enqueue_script('bootstrap-bundle');
    wp_enqueue_script('general');
    wp_enqueue_script('menu');
    wp_enqueue_script('home');
}

function cargar_estilos()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.css', array(), false, 'all');
    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '2024.09.19.01', 'all');
    wp_register_style('header', get_template_directory_uri() . '/css/header.css', array(), '2024.09.19.01', 'all');
    wp_register_style('home', get_template_directory_uri() . '/css/home.css', array(), '2024.09.19.01', 'all');
    wp_register_style('footer', get_template_directory_uri() . '/css/footer.css', array(), '2024.09.19.01', 'all');

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('header');
    wp_enqueue_style('style');
    wp_enqueue_style('home');
    wp_enqueue_style('footer');
}

add_action('wp_enqueue_scripts', 'cargar_scripts');
add_action('wp_enqueue_scripts', 'cargar_estilos');
