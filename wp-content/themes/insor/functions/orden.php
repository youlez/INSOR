<?php
// Crear un metabox personalizado en la pantalla de edición de páginas
function agregar_metabox_orden_taxonomias()
{
	add_meta_box(
		'orden_taxonomias',
		'Orden de Taxonomias',
		'mostrar_orden_taxonomias_metabox',
		'page', // Tipo de post, cámbialo si deseas aplicarlo a otro tipo de post
		'side',
		'default'
	);
}
add_action('add_meta_boxes', 'agregar_metabox_orden_taxonomias');

// Paso 2: Mostrar el campo de orden en la metabox
function mostrar_orden_taxonomias_metabox($term)
{
	global $post;
	// Recuperar el valor del campo de orden
	$orden = get_post_meta($post->ID, '_orden_taxonomias', true);

	$taxonomias = get_object_taxonomies('page');
	foreach ($taxonomias as $taxonomia) {
		$terms = get_terms(array('taxonomy' => $taxonomia, 'hide_empty' => false));

		foreach ($terms as $term) {
?>
			<label for="orden_taxonomias"><?php echo $term->name ?></label>
			<div class="orden-input" style="width: inherit; padding: 0 10px; display: flex; justify-content: end;">
				<input type="number" min="0" placeholder="Orden" style="width: 75px;" id="orden-<?php echo $term->term_id ?>" name="orden_taxonomias[<?php echo $term->term_id ?>]" data-name="<?php echo $term->name ?>" value="<?php echo esc_attr($orden[$term->term_id] == 0 ? '' : $orden[$term->term_id]); ?>" />
			</div>
<?php
		}
	}
}

// Agregar el script de JavaScript solo en la pantalla de edición de páginas
function agregar_script_orden_taxonomias()
{
	global $post;

	if (isset($post->post_type) && ($post->post_type === 'page')) { // Solo en páginas, modifica si es necesario
		wp_enqueue_script('orden-taxonomias', get_template_directory_uri() . '/js/back/orden.js', array('jquery'), null, true);
	}
}
add_action('admin_enqueue_scripts', 'agregar_script_orden_taxonomias');

// Guardar los valores de orden al guardar la página
function guardar_orden_taxonomias_pagina($post_id)
{
	if (isset($_POST['orden_taxonomias']) && is_array($_POST['orden_taxonomias'])) {
		$ordenes = array_map('intval', $_POST['orden_taxonomias']);
		update_post_meta($post_id, '_orden_taxonomias', $ordenes);
	}
}
add_action('save_post', 'guardar_orden_taxonomias_pagina');
/*
function imprimir_ordenes_guardados_script()
{
    global $post;
    if ($post && $post->post_type === 'page') {
        $ordenes_guardados = get_post_meta($post->ID, '_orden_taxonomias', true);
        echo '<input type="hidden" id="ordenes_guardados" value="' . esc_attr(json_encode($ordenes_guardados)) . '">';
    }
}
add_action('admin_footer', 'imprimir_ordenes_guardados_script');
*/