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
      $clase_personalizada .= " rigth-submenu";
    }

    // Crear el contenedor <ul> con la clase personalizada
    $indent = str_repeat("\t", $depth); // Sangrado para HTML ordenado
    $output .= "\n$indent<ul class=\"$clase_personalizada\">\n";
  }
}


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
