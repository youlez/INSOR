<?php

function agregar_columna_shortcode_acordeon($columns)
{
    $columns['term_shortcode'] = 'Shortcode'; // Añade una columna llamada "Shortcode"
    return $columns;
}
add_filter('manage_edit-acordeon_columns', 'agregar_columna_shortcode_acordeon'); // Cambia 'acordeon' si estás usando otra taxonomía.

function mostrar_columna_acordeon_shortcode($content, $column_name, $term_id)
{
    if ($column_name === 'term_shortcode') {
        $taxonomy = get_taxonomy('acordeon'); // Cambia 'acordeon' por el slug de tu taxonomía
        if ($taxonomy) {
            $content = '[contenido_interactivo id="' . $term_id . '" tipo="' . esc_attr($taxonomy->name) . '"]';
        }
    }
    return $content;
}
add_filter('manage_acordeon_custom_column', 'mostrar_columna_acordeon_shortcode', 10, 3); // Cambia 'acordeon' si estás usando otra taxonomía.


function agregar_columna_shortcode_lista($columns)
{
    $columns['term_shortcode'] = 'Shortcode'; // Añade una columna llamada "Shortcode"
    return $columns;
}
add_filter('manage_edit-lista_columns', 'agregar_columna_shortcode_lista'); // Cambia 'lista' si estás usando otra taxonomía.

function mostrar_columna_lista_shortcode($content, $column_name, $term_id)
{
    if ($column_name === 'term_shortcode') {
        $taxonomy = get_taxonomy('lista'); // Cambia 'lista' por el slug de tu taxonomía
        if ($taxonomy) {
            $content = '[contenido_interactivo id="' . $term_id . '" tipo="' . esc_attr($taxonomy->name) . '"]';
        }
    }
    return $content;
}
add_filter('manage_lista_custom_column', 'mostrar_columna_lista_shortcode', 10, 3); // Cambia 'acordeon' si estás usando otra taxonomía.


function agregar_columna_shortcode_glosario($columns)
{
    $columns['term_shortcode'] = 'Shortcode'; // Añade una columna llamada "Shortcode"
    return $columns;
}
add_filter('manage_edit-glosario_columns', 'agregar_columna_shortcode_glosario'); // Cambia 'glosario' si estás usando otra taxonomía.

function mostrar_columna_glosario_shortcode($content, $column_name, $term_id)
{
    if ($column_name === 'term_shortcode') {
        $taxonomy = get_taxonomy('glosario'); // Cambia 'glosario' por el slug de tu taxonomía
        if ($taxonomy) {
            $content = '[contenido_interactivo id="' . $term_id . '" tipo="' . esc_attr($taxonomy->name) . '"]';
        }
    }
    return $content;
}
add_filter('manage_glosario_custom_column', 'mostrar_columna_glosario_shortcode', 10, 3); // Cambia 'acordeon' si estás usando otra taxonomía.
