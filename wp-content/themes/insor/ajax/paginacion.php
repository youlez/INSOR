<?php
function pagination()
{
    $pagina = $_POST['pagina'];
    $ancho = $_POST['ancho'];
    $pagenumber = $_POST['pagenumber'];

    if ($pagina == "noticias")
        $html = mostrar_noticias($pagenumber, $ancho);

    echo json_encode($html);
    wp_die();
}

add_action('wp_ajax_pagination', 'pagination');
add_action('wp_ajax_nopriv_pagination', 'pagination');
