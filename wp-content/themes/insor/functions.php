<?php
include('functions/scripts.php');
include('functions/posts.php');
include('functions/taxonomys.php');
include('functions/menu.php');
include('functions/personalizar.php');

add_theme_support('post-thumbnails');

add_action('admin_head', 'my_custom_css');

function my_custom_css()
{
  if (is_user_logged_in()) { // check if there is a logged in user 

    $user = wp_get_current_user(); // getting & setting the current user 
    $roles = (array) $user->roles; // obtaining the role 
    if (in_array('editor', $roles, true)) {
      echo '<style>
                    #menu-tools {
                        display:none !important;
                    } 
                    #menu-settings {
                        display:none !important;
                    } 
                    #toplevel_page_heateor-sss-options{
                        display:none !important;
                    } 
                    #menu-comments{
                        display:none !important;
                    } 
                </style>';
    }
  }
}

function agregar_clases_elementos($content)
{
  // Verifica si el contenido tiene el div con la clase wp-block-embed__wrapper
  if (strpos($content, 'wp-block-embed__wrapper') !== false) {
    // Agrega la clase 'mi-clase-personalizada' a los div con la clase wp-block-embed__wrapper
    $content = preg_replace(
      '/<div class="wp-block-embed__wrapper(.*?)">/',
      '<div class="wp-block-embed__wrapper$1 ratio ratio-16x9">',
      $content
    );
  }
  if (strpos($content, 'class="wp-block-table') !== false) {
    // Agrega la clase 'mi-clase-personalizada' a los div con la clase class="wp-block-table
    $content = preg_replace(
      '/<figure class="wp-block-table(.*?)">/',
      '<figure class="wp-block-table$1 table-responsive">',
      $content
    );
  }
  if (strpos($content, 'class="has-fixed-layout') !== false) {
    // Agrega la clase 'mi-clase-personalizada' a los div con la clase class="has-fixed-layout
    $content = preg_replace(
      '/<table class="has-fixed-layout(.*?)">/',
      '<table class="has-fixed-layout$1 table">',
      $content
    );
  }
  return $content;
}

// Aplica el filtro a the_content para modificar el contenido del post
add_filter('the_content', 'agregar_clases_elementos');


/* archivos de listas */
function agregar_campo_personalizado()
{
  add_meta_box(
    'archivo_personalizado',
    'Seleccionar Archivo de Medios',
    'mostrar_campo_personalizado',
    'items-lista',
    'side'
  );
}

add_action('add_meta_boxes', 'agregar_campo_personalizado');

function mostrar_campo_personalizado($post)
{
?>
  <div>
    <input type="text" id="archivo_medios" name="archivo_medios" value="" style="width:100%;" readonly />
    <input type="button" id="seleccionar_archivo" class="button" value="Seleccionar Archivo" />
  </div>

  <script>
    jQuery(document).ready(function($) {
      $('#seleccionar_archivo').click(function(e) {
        e.preventDefault();

        var mediaUploader;

        if (mediaUploader) {
          mediaUploader.open();
          return;
        }

        mediaUploader = wp.media({
          title: 'Seleccionar Archivo',
          button: {
            text: 'Usar Archivo'
          },
          multiple: false
        });

        mediaUploader.on('select', function() {
          var attachment = mediaUploader.state().get('selection').first().toJSON();
          $('#archivo_medios').val(attachment.url);
        });

        mediaUploader.open();
      });
    });
  </script>
<?php
}

function guardar_archivo_medios($post_id)
{
  if (isset($_POST['archivo_medios'])) {
    update_post_meta($post_id, 'archivo_medios', sanitize_text_field($_POST['archivo_medios']));
  }
}

add_action('save_post', 'guardar_archivo_medios');

include('ajax/lista-archivos.php');
include('ajax/glosario.php');
