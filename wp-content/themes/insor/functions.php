<?php
include('functions/scripts.php');
include('functions/posts.php');

add_theme_support('post-thumbnails');

function registrar_menus()
{
  register_nav_menus(
    array(
      'menu-principal' => __('Principal')
    )
  );
}
add_action('init', 'registrar_menus');

class agregar_clase_Walker_Nav_Menu extends Walker_Nav_Menu
{
  // Modificamos la función que inicia cada submenú <ul>
  function start_lvl(&$output, $depth = 0, $args = null)
  {
    // Definir la clase personalizada que quieres agregar al <ul>
    $clase_personalizada = 'sub-menu'; // Puedes personalizar la clase según el nivel

    if ($depth > 0) {
      $clase_personalizada .= " right-submenu";
    }

    // Crear el contenedor <ul> con la clase personalizada
    $indent = str_repeat("\t", $depth); // Sangrado para HTML ordenado
    $output .= "\n$indent<ul class=\"$clase_personalizada\">\n";
  }
}

// Agrega un campo personalizado para seleccionar la imagen
function agregar_campo_imagen_menu($item_id, $item, $depth, $args)
{
  // Recupera el valor actual del campo personalizado (si existe)
  $image = get_post_meta($item_id, '_menu_item_image', true);
?>
  <p class="field-custom description description-wide">
    <label for="edit-menu-item-image-<?php echo esc_attr($item_id); ?>">
      <?php _e('Seleccionar Imagen', 'textdomain'); ?><br>
      <input style="display: none;" type="text" id="edit-menu-item-image-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-image" name="menu-item-image[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($image); ?>" />
      <img <?php echo esc_attr($image) != "" ? 'style="width: 100%;"' : '' ?> id="image-<?php echo esc_attr($item_id); ?>" src="<?php echo esc_attr($image); ?>" alt="">
      <button type="button" class="button button-secondary seleccionar-imagen-menu" data-image="image-<?php echo esc_attr($item_id); ?>" data-button="eliminar-<?php echo esc_attr($item_id); ?>" data-id="edit-menu-item-image-<?php echo esc_attr($item_id); ?>">Seleccionar Imagen</button>
      <button <?php echo esc_attr($image) == "" ? 'style="display: none;"' : '' ?> type="button" class="button button-secondary eliminar-imagen-menu" id="eliminar-<?php echo esc_attr($item_id); ?>" data-image="image-<?php echo esc_attr($item_id); ?>" data-id="edit-menu-item-image-<?php echo esc_attr($item_id); ?>">Eliminar Imagen</button>
    </label>
  </p>
<?php
}
add_action('wp_nav_menu_item_custom_fields', 'agregar_campo_imagen_menu', 10, 4);

// Guardar la imagen seleccionada cuando el menú se guarde
function guardar_campo_imagen_menu($menu_id, $menu_item_db_id)
{
  if (isset($_POST['menu-item-image'][$menu_item_db_id])) {
    $image = sanitize_text_field($_POST['menu-item-image'][$menu_item_db_id]);
    update_post_meta($menu_item_db_id, '_menu_item_image', $image);
  } else {
    delete_post_meta($menu_item_db_id, '_menu_item_image');
  }
}
add_action('wp_update_nav_menu_item', 'guardar_campo_imagen_menu', 10, 2);

// Agregar script para la biblioteca de medios en el editor de menús
function agregar_scripts_biblioteca_medios_menu()
{
  wp_enqueue_media();
  wp_enqueue_script('menu-image-upload', get_template_directory_uri() . '/js/menu-image-upload.js', array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'agregar_scripts_biblioteca_medios_menu');

function mostrar_imagen_menu($title, $item, $args, $depth)
{
  $image_url = get_post_meta($item->ID, '_menu_item_image', true);
  if ($image_url) {
    $title = '<div class="img-menu"><img src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '" class="img-fluid" /></div>' . $title;
  }
  return $title;
}
add_filter('nav_menu_item_title', 'mostrar_imagen_menu', 10, 4);




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

add_action("widgets_init", "insorWidgetsInit");

function insorWidgetsInit()
{

  register_sidebar(array(
    'name' => __('Footer', 'insor'),
    'id' => 'sidebar-footer',
    'description' => __('Widgets for footer', 'insor'),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
}

/**
 * Add support to Theme Customizer
 */
function insor_customize_register($wp_customize)
{
  // Add new section to Customizer
  $wp_customize->add_section('theme_options', array(
    'title'    => __('Logos', 'insor'),
    'priority' => 130, // Before Additional CSS.
  ));

  // Display the form for change the logo on header
  $wp_customize->add_setting('logo', array(
    'transport'   => 'refresh',
  ));

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'logo',
      array(
        'label'      => __('Subir imagen del logo ', 'insor'),
        'section'    => 'theme_options'
      )
    )
  );
  // Display the form for change the logo on header
  $wp_customize->add_setting('logo-movil', array(
    'transport'   => 'refresh',
  ));

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'logo-movil',
      array(
        'label'      => __('Subir imagen del logo para movil', 'insor'),
        'section'    => 'theme_options'
      )
    )
  );
}

add_action('customize_register', 'insor_customize_register');
