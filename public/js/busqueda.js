$(document).ready(function() {
    $(".search-btn").click(function(event) {
      event.preventDefault();
  
      var categoria = $(".input-select").val();
      var nombre = $(".input").val();
  
      // Realizar la solicitud GET utilizando AJAX
      $.ajax({
        url: "http://localhost:8000/api/producto/buscar/" + nombre,
        type: "GET",
        success: function(response1) {
          // Obtener la categoría del producto encontrado
          var categoriaProducto = response.categoria;
  
          // Verificar si la categoría seleccionada coincide con la categoría del producto encontrado
          if (categoria === categoriaProducto) {
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
            // Realizar otra solicitud GET para obtener productos con la misma categoría
            $.ajax({
              url: "http://localhost:8000/api/producto/categoria/" + categoria,
              type: "GET",
              success: function(response2) {
                // Obtener los productos con la misma categoría
                var productosCategoria = response;
  
                // Agregar el producto buscado a la lista de productos de la misma categoría
                productosCategoria.push(productoBuscado);
  
                // Hacer algo con los productos obtenidos
                console.log(productosCategoria);
              },
              error: function(xhr, status, error) {
                console.log("Error al obtener productos por categoría: " + error);
              }
            });
          } else {
            console.log("La categoría seleccionada no coincide con la categoría del producto encontrado.");
          }
        },
        error: function(xhr, status, error) {
          console.log("Error al buscar el producto: " + error);
        }
      });
    });
  });