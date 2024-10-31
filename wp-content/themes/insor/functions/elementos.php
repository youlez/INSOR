<?php

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
        }
        if ((strpos($matches[1], '.xlsx') !== false) || (strpos($matches[1], '.XLSX') !== false) || (strpos($matches[1], '.xls') !== false) || (strpos($matches[1], '.XLS') !== false)) {
          $matches[2]  = '<i class="fa-solid fa-file-excel"></i>' . $matches[2];
        }
        $cont = '<a' . $matches[1] . '>' . $matches[2] . '</a>';

        if (strpos($matches[1], 'class=') !== false) {
          $cont = '<a' . preg_replace('/class=["\'](.*?)["\']/', 'class="$1 link-file"', $matches[1]) . '>' . $matches[2] . '</a>';
        } else {
          // Si no tiene clase, añadimos la clase normalmente
          $cont = '<a' . $matches[1] . ' class="link-file">' . $matches[2] . '</a>';
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
