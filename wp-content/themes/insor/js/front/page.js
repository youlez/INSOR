jQuery(document).ready(function ($) {
  Array.from($('.page-interna a')).forEach(element => {
    $(element).addClass("link");
    let href = $(element).attr('href');

    if (href != undefined && ((href.indexOf('.pdf') != -1) || (href.indexOf('.PDF') != -1))) {
      $(element).addClass("link-file");
      let html = $(element).html();
      $(element).html('<i class="fa-solid fa-file-pdf"></i>' + html);
    }
  });
  Array.from($('.page-interna .icono-carta a')).forEach(element => {
    let html = $(element).html();
    $(element).html('<i class="fa-solid fa-file-lines"></i>' + html);
  });
  Array.from($('.page-interna .icono-peticiones a')).forEach(element => {
    let html = $(element).html();
    $(element).html('<i class="fa-solid fa-envelope-open-text"></i>' + html);
  });
  Array.from($('.page-interna .icono-normativa a')).forEach(element => {
    let html = $(element).html();
    $(element).html('<i class="fa-solid fa-gavel"></i>' + html);
  });
  Array.from($('.page-interna .icono-citas a')).forEach(element => {
    let html = $(element).html();
    $(element).html('<i class="fa-solid fa-user-clock"></i>' + html);
  });
  Array.from($('.page-interna .icono-edit a')).forEach(element => {
    let html = $(element).html();
    $(element).html('<i class="fa-solid fa-pen-to-square"></i>' + html);
  });
  Array.from($('.page-interna .icono-search a')).forEach(element => {
    let html = $(element).html();
    $(element).html('<i class="fa-solid fa-magnifying-glass"></i>' + html);
  });
  Array.from($('.page-interna .icono-user-check a')).forEach(element => {
    let html = $(element).html();
    $(element).html('<i class="fa-solid fa-user-check"></i>' + html);
  });
});