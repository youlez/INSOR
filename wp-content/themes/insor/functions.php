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

function modificar_elementos($content)
{
  if (strpos($content, 'wp-block-embed__wrapper') !== false) {
    $content = preg_replace(
      '/<div class="wp-block-embed__wrapper(.*?)">/',
      '<div class="wp-block-embed__wrapper$1 ratio ratio-16x9">',
      $content
    );
  }

  if (strpos($content, 'class="wp-block-table') !== false) {
    $content = preg_replace(
      '/<figure class="wp-block-table(.*?)">/',
      '<figure class="wp-block-table$1 table-responsive">',
      $content
    );
  }

  if (strpos($content, 'class="has-fixed-layout') !== false) {
    $content = preg_replace(
      '/<table class="has-fixed-layout(.*?)">/',
      '<table class="has-fixed-layout$1 table">',
      $content
    );
  }

  if (strpos($content, '<a') !== false) {

    $content = preg_replace_callback('/<a(.*?)>(.*?)<\/a>/i', function ($matches) {
      /*verificar si es un archivo se agrega el icono*/
      $cont = '<a' . $matches[1] . '>' . $matches[2] . '</a>';
      if (strpos($matches[1], 'href=') !== false) {
        if ((strpos($matches[1], '.pdf') !== false) || (strpos($matches[1], '.PDF') !== false)) {
          $matches[2]  = '<i class="fa-solid fa-file-pdf"></i>' . $matches[2];
          $cont = '<a' . $matches[1] . '>' . $matches[2] . '</a>';

          if (strpos($matches[1], 'class=') !== false) {
            $cont = '<a' . preg_replace('/class=["\'](.*?)["\']/', 'class="$1 link-file"', $matches[1]) . '>' . $matches[2] . '</a>';
          } else {
            // Si no tiene clase, añadimos la clase normalmente
            $cont = '<a' . $matches[1] . ' class="link-file">' . $matches[2] . '</a>';
          }
        }
      }
      return $cont;
    }, $content);


    $content = preg_replace_callback('/<a(.*?)>/i', function ($matches) {
      // Si el enlace ya tiene una clase, añadimos la nueva clase al final de la existente
      if (strpos($matches[1], 'class=') !== false) {
        return '<a' . preg_replace('/class=["\'](.*?)["\']/', 'class="$1 link"', $matches[1]) . '>';
      } else {
        // Si no tiene clase, añadimos la clase normalmente
        return '<a' . $matches[1] . ' class="link">';
      }
    }, $content);
  }


  if (strpos($content, 'btn-icono') !== false) {
    $content = preg_replace_callback('/<div(.*?)class=["\'](.*?)btn-icono(.*?)[\'"](.*?)>(.*?)<a(.*?)>(.*?)<\/a>(.*?)<\/div>/is', function ($matches) {
      // Obtener las clases después de `btn-icono`
      $extra_classes = trim($matches[3]);

      // Crear el elemento <i> con las clases extraídas
      $icon = '<i class="' . $extra_classes . '"></i>';

      // Reconstruir el div sin las clases adicionales
      $div = '<div' . $matches[1] . 'class="' . $matches[2] . 'btn-icono"' . $matches[4] . '>';

      // Reconstruir el enlace <a> con el elemento <i> añadido dentro
      $link = '<a' . $matches[6] . '>' . $icon . ' ' . $matches[7] . '</a>';

      // Unir el div y el nuevo enlace con el contenido que pueda estar después del <a>
      return $div . $matches[5] . $link . $matches[8] . '</div>';
    }, $content);
  }

  return $content;
}

// Aplica el filtro a the_content para modificar el contenido del post
add_filter('the_content', 'modificar_elementos');


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

include('html/miga_pan.php');
