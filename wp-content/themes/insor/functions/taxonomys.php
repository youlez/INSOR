<?php
function crear_taxonomia($taxonomia, $nombre, $plural, $genero, $posts, $hierarchical)
{
    if ($genero == 'f') {
        $varios = 'Todas';
        $crear  = 'nueva';
        $ningun = 'ninguna';
    } else {
        $varios = 'Todos';
        $crear  = 'nuevo';
        $ningun = 'ninguno';
    }

    $labels = array(
        'name' => __($plural),
        'singular_name' => __($nombre),
        'search_items' =>  __('Buscar ' . strtolower($plural)),
        'all_items' => __($varios),
        'parent_item' => __($nombre . ' padre'),
        'parent_item_colon' => __($nombre . ' padre:'),
        'edit_item' => __('Editar ' . strtolower($nombre)),
        'update_item' => __('Actualizar ' . strtolower($nombre)),
        'add_new' => _x('Añadir ' . $crear, strtolower($nombre)),
        'add_new_item' => __('Añadir ' . $crear . ' ' . strtolower($nombre)),
        'not_found' =>  __('No se ha encontrado ' . $ningun . ' ' . strtolower($nombre)),
        'menu_name' => __($plural)
    );
    register_taxonomy(
        $taxonomia,
        $posts, // Tipos de Post a los que asociaremos la taxonomía
        array(
            'hierarchical' => $hierarchical, // True para taxonomías del tipo "Categoría" y false para el tipo 
            'labels' => $labels, // La variable con las traducciones de las etiquetas
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => $nombre),
        )
    );
}
function crear_taxonomias()
{
    crear_taxonomia('acordeon', 'Acordeon', 'Acordeones', 'm', array('page', 'items-acordeon'), true);
    crear_taxonomia('lista', 'Lista desplegable', 'Listas Desplegables', 'f', array('page', 'items-lista'), true);
    crear_taxonomia('glosario', 'Glosario', 'Glosarios', 'm', array('page', 'items-glosario'), true);
}
add_action('init', 'crear_taxonomias', 0);
