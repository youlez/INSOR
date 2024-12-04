<?php
include('functions/scripts.php');
include('functions/posts.php');
include('functions/taxonomys.php');
include('functions/menu.php');
include('functions/personalizar.php');
include('functions/elementos.php');
include('functions/tipos-lista.php');
include('functions/shorcode.php');
include('functions/columna-taxonomia.php');
include('functions/orden.php');

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

add_action('phpmailer_init', 'configuracion_smtp');

function configuracion_smtp($phpmailer)
{
  $phpmailer->Host = 'mail.consultorestic.com.co';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 465;
  $phpmailer->Username = 'noresponder@consultorestic.com.co';
  $phpmailer->Password = "3hUeljmQw8+H";
  $phpmailer->SMTPSecure = 'ssl';
  $phpmailer->From = 'noresponder@consultorestic.com.co';
  $phpmailer->FromName = 'INSOR - Instituto Nacional para Sordos';
  $phpmailer->isSMTP();
}

/* archivos de listas */
/*function agregar_campo_personalizado()
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
  $archivo_medios = get_post_meta($post->ID, 'archivo_medios', true);
?>
  <div>
    <input type="text" id="archivo_medios" name="archivo_medios" value="<?php echo $archivo_medios ?>" style="width:100%;" readonly />
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

add_action('save_post', 'guardar_archivo_medios');*/

include('ajax/lista-archivos.php');
include('ajax/glosario.php');

include('html/miga_pan.php');
