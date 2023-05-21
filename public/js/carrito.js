
  function addToCart(productId) {
    $.ajax({
      url: 'http://localhost:8000/api/producto/get/' + productId,
      type: 'GET',
      success: function(producto) {
        console.log(productId);
        // Obtener los datos del producto de la respuesta de la API
        var productonombre = producto.nombre;
        var productoprecio = producto.precio;
        var productoimagen = producto.imageName;
        console.log(producto.nombre);
        console.log(producto.precio);
  
          // Crear los elementos HTML del producto
          var productWidget = $('<div class="product-widget"></div>');
          var productImg = $('<div class="product-img"><img src="./img/'+productoimagen+'" alt=""></div>');
          var productBody = $('<div class="product-body"></div>');
          var productNameElement = $('<h3 class="product-name"><a href="#">' + productonombre + '</a></h3>');
          var productPriceElement = $('<h4 class="product-price"><span class="qty">1x</span>$' + productoprecio + '</h4>');
          var deleteButton = $('<button class="delete"><i class="fa fa-close"></i></button>');
  
          // Agregar los elementos al producto
          productWidget.append(productImg);
          productBody.append(productNameElement);
          productBody.append(productPriceElement);
          productWidget.append(productBody);
          productWidget.append(deleteButton);
  
          // Agregar el producto al carrito en el div "cart-list"
          $('.cart-list').append(productWidget);
        },
        error: function(error) {
          // Manejar el error de la llamada AJAX aquí
        }
      });
    }

