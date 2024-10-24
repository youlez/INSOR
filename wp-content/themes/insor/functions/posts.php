<?php
function modificar_post_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Noticias';
    $submenu['edit.php'][5][0] = 'Noticias';
    $submenu['edit.php'][10][0] = 'A&ntilde;adir Noticias';
    echo '';
}
function modificar_post_object()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Noticias';
    $labels->singular_name = 'Noticias';
    $labels->add_new = 'A&ntilde;adir nueva';
    $labels->add_new_item = 'A&ntilde;adir nuevas noticias';
    $labels->edit_item = 'Editar Noticias';
    $labels->new_item = 'Nueva Noticia';
    $labels->view_item = 'Ver Noticia';
    $labels->search_items = 'Buscar noticias';
    $labels->not_found = 'No se han encontrado noticias';
    $labels->not_found_in_trash = 'No se han encontrado noticias en la papelera';
    $labels->all_items = 'Todos las noticias';
    $labels->menu_name = 'Noticias';
    $labels->name_admin_bar = 'Noticias';
}
add_action('admin_menu', 'modificar_post_label');
add_action('init', 'modificar_post_object');

function crear_entrada($entrada, $nombre, $plural, $genero, $tipo)
{
    if ($genero == 'f') {
        $varios = 'Todas';
        $crear  = 'Nueva';
        $ningun = 'ninguna';
    } else {
        $varios = 'Todos';
        $crear  = 'Nuevo';
        $ningun = 'ninguno';
    }

    $labels = array(
        'name' => __($plural),
        'singular_name' => __($nombre),
        'search_items' =>  __('Buscar ' . strtolower($plural)),
        'all_items' => __($varios),
        'add_new' => __('Añadir ' . strtolower($crear), strtolower($nombre)),
        'add_new_item' => __('Añadir ' . strtolower($crear) . ' ' . strtolower($nombre)),
        'edit_item' => __('Editar ' . strtolower($nombre)),
        'new_item' => __($crear . ' ' . strtolower($nombre)),
        'view_item' => __('Ver ' . strtolower($nombre)),
        'not_found' =>  __('No se ha encontrado ' . $ningun . ' ' . strtolower($nombre)),
        'not_found_in_trash' => __('No se han encontrado ' . $ningun . ' ' . strtolower($nombre) . ' en la papelera'),
        'parent_item_colon' => ''
    );
    register_post_type(
        $entrada,
        array(
            'label' => __(strtolower($nombre)),
            'labels' => $labels,
            'public' => true,
            'can_export' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            '_builtin' => false,
            'capability_type' => $tipo,
            'hierarchical' => true,
            'rewrite' => array('with_front' => true),
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'custom-fields', 'page-attributes'),
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-admin-post',
            'map_meta_cap' => true
        )
    );
}
function crear_entradas()
{
    crear_entrada('videos', 'Video', 'Videos', 'm', 'post');
    crear_entrada('items-acordeon', 'Item Acordeon', 'Items Acordeon', 'm', 'post');
    crear_entrada('items-lista', 'Documento', 'Documentos', 'm', 'post');
    crear_entrada('items-glosario', 'Item Glosario', 'Items Glosario', 'm', 'post');
}
add_action('init', 'crear_entradas');
