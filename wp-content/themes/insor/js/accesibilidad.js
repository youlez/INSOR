
document.addEventListener("keyup", detectTabKey);
var contrast_on = false;
var classIndex = 5;
var clases = [
  'f-0',
  'f-1',
  'f-2',
  'f-3',
  'f-4',
  'f-5',
  'f-6',
  'f-7',
  'f-8',
  'f-9',
  'f-10',
];

function detectTabKey(e) {
  if (e.keyCode == 9) {
    if (document.getElementById("botoncontraste").classList.contains("active-barra-accesibilidad-govco")) {
      document.getElementById("botoncontraste").classList.toggle("active-barra-accesibilidad-govco");
    }
    if (document.getElementById("botonaumentar").classList.contains("active-barra-accesibilidad-govco")) {
      document.getElementById("botonaumentar").classList.toggle("active-barra-accesibilidad-govco");
    }
    if (document.getElementById("botondisminuir").classList.contains("active-barra-accesibilidad-govco")) {
      document.getElementById("botondisminuir").classList.toggle("active-barra-accesibilidad-govco");
    }
  }
}

function cambiarContexto() {
  if (contrast_on) {
    jQuery('html').removeClass('hight-contrast');
    contrast_on = false;
  } else {
    jQuery('html').addClass('hight-contrast');
    contrast_on = true;
  }
}

function changeClass(previous, next) {
  if (previous !== next) {
    jQuery('html').removeClass(clases[previous]);
    jQuery('html').addClass(clases[next]);
  }
}

function disminuirTamanio() {
  var previousClass = classIndex;
  classIndex--;
  classIndex = classIndex < 0 ? 0 : classIndex;
  changeClass(previousClass, classIndex);
}

function aumentarTamanio() {
  var previousClass = classIndex;
  classIndex++;
  classIndex =
    classIndex === clases.length
      ? clases.length - 1
      : classIndex;
  changeClass(previousClass, classIndex);
}

function normalTamanio() {
  clases.forEach(element => {
    jQuery('html').removeClass(element);
  });

}