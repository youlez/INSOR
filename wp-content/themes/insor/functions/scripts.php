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
    wp_register_script('general', get_template_directory_uri() . '/js/front/general.js', array(), '2024.10.24.02', 'all');
    wp_register_script('menu', get_template_directory_uri() . '/js/front/menu.js', array(), '2024.10.24.02', 'all');
    wp_register_script('home', get_template_directory_uri() . '/js/front/home.js', array(), '2024.10.24.02', 'all');
    wp_register_script('header', get_template_directory_uri() . '/js/front/header.js', array(), '2024.10.24.02', 'all');
    wp_register_script('accesibilidad', get_template_directory_uri() . '/js/front/accesibilidad.js', array(), '2024.10.24.02', 'all');
    wp_register_script('lista-desplegable', get_template_directory_uri() . '/js/front/lista-desplegable.js', array(), '2024.10.24.02', 'all');
    wp_register_script('page', get_template_directory_uri() . '/js/front/page.js', array(), '2024.10.24.02', 'all');
    wp_register_script('glosario', get_template_directory_uri() . '/js/front/glosario.js', array(), '2024.10.24.02', 'all');

    wp_enqueue_script('bootstrap');
    wp_enqueue_script('bootstrap-bundle');
    wp_enqueue_script('general');
    wp_enqueue_script('menu');
    wp_enqueue_script('home');
    wp_enqueue_script('header');
    wp_enqueue_script('accesibilidad');
    wp_enqueue_script('lista-desplegable');
    wp_enqueue_script('page');
    wp_enqueue_script('glosario');
}

function cargar_estilos_head()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.css', array(), false, 'all');
    wp_register_style('fontawesome', get_template_directory_uri() . '/node_modules/@fortawesome/fontawesome-free/css/all.min.css', array(), false, 'all');
    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '2024.10.24.02', 'all');
    wp_register_style('header', get_template_directory_uri() . '/css/header.css', array(), '2024.10.24.02', 'all');
    wp_register_style('home', get_template_directory_uri() . '/css/home.css', array(), '2024.10.24.02', 'all');
    wp_register_style('footer', get_template_directory_uri() . '/css/footer.css', array(), '2024.10.24.02', 'all');

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('fontawesome');
    wp_enqueue_style('style');
    wp_enqueue_style('header');
    wp_enqueue_style('home');
    wp_enqueue_style('footer');
}

function cargar_estilos_footer()
{
    wp_register_style('buscador', get_template_directory_uri() . '/css/buscador.css', array(), '2024.10.24.02', 'all');

    wp_enqueue_style('buscador');
}

add_action('wp_enqueue_scripts', 'cargar_scripts');
add_action('wp_enqueue_scripts', 'cargar_estilos_head');
add_action('wp_footer', 'cargar_estilos_footer');
