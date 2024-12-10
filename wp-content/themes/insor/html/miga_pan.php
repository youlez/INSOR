<?php
function miga_pan()
{
?>
  <div style="display: ruby;">
    <div class="miga">
      <a class="link" href="<?php bloginfo('url'); ?>/">Inicio</a>
    </div>
    <?php
    // Obtener el menú asignado en WordPress
    $menu_name = 'menu-principal';
    $menu_locations = get_nav_menu_locations();

    // Verifica si el menú existe
    if (isset($menu_locations[$menu_name])) {
      $menu = wp_get_nav_menu_object($menu_locations[$menu_name]);
      $menu_items = wp_get_nav_menu_items($menu->term_id);

      // Obtener la URL actual
      $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

      // Variable para rastrear los elementos ancestros
      $ancestors = [];

      // Recorrer el menú y encontrar el camino de ancestros
      foreach ($menu_items as $menu_item) {
        if ($menu_item->url === $current_url) {
          // Buscar ancestros si existen
          $parent_id = $menu_item->menu_item_parent;
          while ($parent_id != 0) {
            foreach ($menu_items as $parent_item) {
              if ($parent_item->ID == $parent_id) {
                array_unshift($ancestors, $parent_item); // Añadir al inicio del array de ancestros
                $parent_id = $parent_item->menu_item_parent;
                break;
              }
            }
          }
          break;
        }
      }

      // Mostrar la ruta de los ancestros en la miga de pan
      foreach ($ancestors as $ancestor) {
    ?>
        <div class="miga">
          <a class="link" href="<?php echo $ancestor->url ?>"><?php echo $ancestor->title ?></a>
        </div>
    <?php
      }

      // Muestra el título de la página actual sin enlace
      echo '<span>' . get_the_title() . '</span>';
    }
    ?>
  </div>
<?php
}
