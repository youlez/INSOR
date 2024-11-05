<?php
// Añadir el campo en la creación de la taxonomía
/*function agregar_campo_personalizado_creacion($taxonomy)
{
?>
  <div class="form-field term-parent-wrap">
    <label for="tipo_contenido"><?php _e('Tipo de Contenido'); ?></label>
    <select class="postform" name="tipo_contenido" id="tipo_contenido">
      <option value="1"><?php _e('Contenido enriquecido'); ?></option>
      <option value="2"><?php _e('Tabla de documentos'); ?></option>
    </select>
  </div>
<?php
}
add_action('lista_add_form_fields', 'agregar_campo_personalizado_creacion', 10, 2);

// Añadir el campo en la edición de la taxonomía
function agregar_campo_personalizado_edicion($term)
{
  $valor = get_term_meta($term->term_id, 'tipo_contenido', true);
?>
  <tr class="form-field term-parent-wrap-wrap">
    <th scope="row"><label for="tipo_contenido"><?php _e('Tipo de Contenido'); ?></label></th>
    <td>
      <select class="postform" name="tipo_contenido" id="tipo_contenido">
        <option value="1" <?php selected($valor, '1'); ?>><?php _e('Contenido enriquecido'); ?></option>
        <option value="2" <?php selected($valor, '2'); ?>><?php _e('Tabla de documentos'); ?></option>
      </select>
    </td>
  </tr>
<?php
}
add_action('lista_edit_form_fields', 'agregar_campo_personalizado_edicion', 10, 2);

// Guardar el valor al crear el término
function guardar_valor_lista_desplegable_creacion($term_id)
{
  if (isset($_POST['tipo_contenido'])) {
    update_term_meta($term_id, 'tipo_contenido', sanitize_text_field($_POST['tipo_contenido']));
  }
}
add_action('created_lista', 'guardar_valor_lista_desplegable_creacion', 10, 2);

// Guardar el valor al editar el término
function guardar_valor_lista_desplegable_edicion($term_id)
{
  if (isset($_POST['tipo_contenido'])) {
    update_term_meta($term_id, 'tipo_contenido', sanitize_text_field($_POST['tipo_contenido']));
  }
}
add_action('edited_lista', 'guardar_valor_lista_desplegable_edicion', 10, 2);*/
