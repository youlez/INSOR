<?php
add_filter('manage_gif_posts_columns', 'agregar_columna_imagen');
function agregar_columna_imagen($columns)
{
  $columns = array_slice($columns, 1, 1, true) +
    ['imagen_destacada' => __('Imagen')] +
    ['url_imagen_destacada' => __('URL de la Imagen')] +
    array_slice($columns, 1, null, true);
  return $columns;
}

add_action('manage_gif_posts_custom_column', 'mostrar_columna_imagen', 10, 2);
function mostrar_columna_imagen($column, $post_id)
{
  if ($column === 'imagen_destacada') {
    $imagen = get_the_post_thumbnail($post_id); // Tamaño de la miniatura
    echo $imagen ?: __('No hay imagen');
  }
  if ($column === 'url_imagen_destacada') {
    $url_imagen = get_the_post_thumbnail_url($post_id, 'full'); // URL de la imagen destacada
    echo $url_imagen ?: __('No hay URL');
  }
}

add_action('admin_head', 'estilos_columna_imagen');
function estilos_columna_imagen()
{
  echo '<style>
        .column-imagen_destacada img { width: 150px; height: auto; }
    </style>';
}
