$(document).ready(function() {
    $('#search-form').submit(function(e) {
      e.preventDefault();
  
      var nombreProducto = $('#nombre-input').val();
  
      // Enviar al controller el nombre del producto como parámetro en la URL SIN USO
      window.location.href = "{{ path('resultado_busqueda') }}" + "?producto=" + encodeURIComponent(nombreProducto);
    });
  });