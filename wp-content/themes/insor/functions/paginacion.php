<?php
function paginacion($count, $actual, $ancho)
{
    $total_cuadro = $count;
    $ancho_div = ($ancho) * 0.8333333333;
    $ancho_div = $ancho_div - 24;
    $cantidad_cuadro = floor($ancho_div / 40);
    $aumento = 0;
    $mitad = 0;
    $tope = $count;
    $fin = 0;
    if ($cantidad_cuadro < $count) {
        $ancho_pag = $ancho_div - 140;
        $total_cuadro = floor($ancho_pag / 40);
        $mitad = ceil($total_cuadro / 2) - 1;
        if ($actual >= 2) {
            $aumento = ($actual - $mitad) + 1;
        }
        if ($actual > 1) {
            $total_cuadro = $total_cuadro - 4;
        }
        if ($actual >= $mitad) {
            $total_cuadro = $total_cuadro + ($aumento - 1);
        }
        if ($total_cuadro > $count) {
            $total_cuadro = $count - 1;
        }
        $tope = $count - (($mitad - 2) * 2);
        $fin = $cantidad_cuadro - floor($ancho_pag / 40);
    }
    $sumatoria_cuadro = $total_cuadro;
    $html = '
        <div class="paginacion d-flex justify-content-center col-12 mt-4">';
    for ($i = 1; $i <= $total_cuadro; $i++) {
        if (($cantidad_cuadro < $count) && ($actual >= 2) && ($i == 1)) {
            $html .= '                       
                <a href="' . ($actual - 1) . '" class="pag py-1 px-0 text-center text-white text-decoration-none boton boton_claro otros">
                    << Anterior
                </a>';
        }
        if ((($cantidad_cuadro >= $count) ||
                (($actual >= $mitad) &&
                    (($i > $aumento) ||
                        ($i >= $tope) ||
                        (($actual == $count) &&
                            ($i > ($count - floor($ancho_pag / 40)))
                        )
                    )
                ) ||
                ($actual < $mitad)) &&
            ($i <= $count)
        ) {
            $html .= '
                <a href="' . $i . '" class="pag ';
            $html .= ($i == $actual) ? "active" : "";
            $html .= ' py-1 px-0 text-center text-white text-decoration-none boton boton_claro">
                    ' . $i . '
                </a>';
        }
        if (($cantidad_cuadro < $count) && ($actual >= $mitad) && ($i == ($sumatoria_cuadro))) {
            $total_cuadro++;
        }
        if (($cantidad_cuadro < $count) && ($i == $total_cuadro) && ($actual < $count)) {
            $html .= '                       
                <a href="' . ($actual + 1) . '" class="pag py-1 px-0 text-center text-white text-decoration-none boton boton_claro otros">
                    Siguiente >>
                </a>';
        }
    }
    $html .= '
        </div>';
    return $html;
}
