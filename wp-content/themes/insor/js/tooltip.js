function showTooltip(event) {
  console.log("Tooltip activado");  // Para verificar que el evento funciona
    var tooltip = document.getElementById('tooltip');
    tooltip.style.display = 'block';
    tooltip.style.top = event.pageY + 'px';
    tooltip.style.left = event.pageX + 'px';
  }
  
  function hideTooltip() {
    var tooltip = document.getElementById('tooltip');
    tooltip.style.display = 'none';
  }