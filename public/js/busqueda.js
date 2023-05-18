$(document).ready(function() {
  $(".search-btn").click(function(event) {
      event.preventDefault();

      var nombre = $(".input").val();

      // Realizar la solicitud GET utilizando AJAX
      $.ajax({
          url: "http://localhost:8000/api/producto/buscar/" + nombre,
          type: "GET",
          success: function(response) {
              // Preparar datos del producto buscado
              var productoBuscado = {
                  id: response.id,
                  precio: response.precio,
                  nombre: response.nombre,
                  descripcion: response.descripcion,
                  tamano: response.tamano,
                  modelo: response.modelo,
                  color: response.color,
                  peso: response.peso,
                  imageName: response.imageName,
                  categoria: response.categoria
              };
              console.log(productoBuscado);
              
              // Enviar los datos a la ruta del controlador en Symfony
              $.ajax({
                  url: "http://localhost:8000/resultado/busqueda",
                  type: "POST",
                  data: {
                      datos: [productoBuscado]
                  },
                  success: function() {
                      // Redirigir a la pantalla Twig de resultados
                      window.location.href = "http://localhost:8000/resultado/busqueda";
                  },
                  error: function(xhr, status, error) {
                      console.log("Error al enviar los datos al controlador: " + error);
                  }
              });
          },
          error: function(xhr, status, error) {
              console.log("Error al buscar el producto: " + error);
          }
      });
  });
});