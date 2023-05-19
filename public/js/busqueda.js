$(document).ready(function() {
    $('#search-form').submit(function(e) {
      e.preventDefault();
  
      var nombreProducto = $('#nombre-input').val();
  
      // Redirigir al controlador con el nombre del producto como parámetro en la URL
      window.location.href = "{{ path('resultado_busqueda') }}" + "?producto=" + encodeURIComponent(nombreProducto);
    });
  });