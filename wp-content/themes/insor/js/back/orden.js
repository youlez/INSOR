jQuery(document).ready(function ($) {

    // Función para añadir el campo de orden a cada término seleccionado
    function agregarCamposOrden() {
        $('.editor-post-taxonomies__hierarchical-terms-choice .components-h-stack').each(function () {
            let elemento = this;
            let name = $(elemento).find('label').text();
            $('#orden_taxonomias .orden-input').each(function () {
                let data = $(this).find('input').data('name');
                if (data == name) {
                    $(elemento).append($(this).clone());
                }
            });
        });
    }

    // Ejecutar actualizarOrdenTaxonomias al cambiar un valor de orden
    $(document).on('input', '.components-h-stack .orden-input input', function () {
        var id = $(this).attr('id');
        var valor = $(this).val();
        $('#orden_taxonomias #' + id).val(valor);
    });

    // Verificar si los términos han sido cargados cada segundo
    const intervalo = setInterval(function () {
        if ($('.components-checkbox-control__input').length > 0) {
            agregarCamposOrden();
            clearInterval(intervalo); // Detener el intervalo una vez que los términos se han cargado
        }
    }, 1000);
});