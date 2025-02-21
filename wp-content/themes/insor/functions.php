<?php
include('functions/scripts.php');
include('functions/posts.php');
include('functions/taxonomys.php');
include('functions/menu.php');
include('functions/personalizar.php');
include('functions/elementos.php');
include('functions/shorcode.php');
include('functions/columna-taxonomia.php');
include('functions/orden.php');
include('functions/gif.php');
include('functions/transmisiones.php');
include('functions/modales.php');

add_theme_support('post-thumbnails');

function ocultar_hijos_taxonomias_en_pages($args)
{
  global $pagenow, $post;

  // Verifica si estamos en el editor de páginas y en el tipo de post 'page'
  if ($pagenow == 'post.php' && $post->post_type == 'page') {
    // Configura el argumento 'parent' a 0 para mostrar solo los términos padre
    echo '<style>
            .editor-post-taxonomies__hierarchical-terms-subchoices {
                display:none !important;
            } 
            #orden_taxonomias{
              display: none !important;
            }
            .components-panel__body{
              display: none !important;
            }  
        </style>';
  }
  return $args;
}
add_action('admin_head', 'ocultar_hijos_taxonomias_en_pages');
function ordenar_terms_por_meta_y_nombre($query)
{
  if (!is_admin() && isset($query->query_vars['taxonomy']) && $query->query_vars['taxonomy'] === 'tu_taxonomia') {
    $query->query_vars['meta_key'] = 'orden_lista';
    $query->query_vars['orderby']  = array('meta_value_num' => 'DESC', 'name' => 'DESC');
  }
}
add_action('pre_get_terms', 'ordenar_terms_por_meta_y_nombre');


include('ajax/lista-archivos.php');
include('ajax/glosario.php');
include('ajax/noticias.php');
include('ajax/paginacion.php');

include('html/miga_pan.php');
include('html/paginacion.php');
