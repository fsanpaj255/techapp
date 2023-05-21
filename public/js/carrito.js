// Variable para almacenar el precio total
var precioTotal = 0;

function addToCart(productId) {
  $.ajax({
    url: 'http://localhost:8000/api/producto/get/' + productId,
    type: 'GET',
    success: function(producto) {
      var productonombre = producto.nombre;
      var productoprecio = producto.precio;
      var productoimagen = producto.imageName;

      // Incrementar el valor en 1 de la etiqueta de cantidad en el carrito cada vez que hace la llamada ajax GET
      var carritoQtyElement = $('.qty.carrito');
      var currentQuantity = parseInt(carritoQtyElement.text());
      carritoQtyElement.text(currentQuantity + 1);

      // Verificar si el producto ya está en el carrito
      var productWidget = $('.cart-list').find('[data-product-id="' + productId + '"]');
      if (productWidget.length > 0) {
        // El producto ya está en el carrito, incrementar la cantidad
        var quantityElement = productWidget.find('.qty');
        var currentQuantity = parseInt(quantityElement.text());
        quantityElement.text((currentQuantity + 1) + 'x');
      } else {
        // El producto no está en el carrito, crear los elementos HTML
        var productWidget = $('<div class="product-widget" data-product-id="' + productId + '"></div>');
        var productImg = $('<div class="product-img"><img src="./img/' + productoimagen + '" alt=""></div>');
        var productBody = $('<div class="product-body"></div>');
        var productNameElement = $('<h3 class="product-name"><a href="#">' + productonombre + '</a></h3>');
        var productPriceElement = $('<h4 class="product-price"><span class="qty">1x</span>' + productoprecio.toFixed(2) + ' € </h4>');
        var deleteButton = $('<button class="delete"><i class="fa fa-close"></i></button>');

        // Agregar los elementos al producto
        productWidget.append(productImg);
        productBody.append(productNameElement);
        productBody.append(productPriceElement);
        productWidget.append(productBody);
        productWidget.append(deleteButton);

        // Agregar el producto al carrito en el div "cart-list"
        $('.cart-list').append(productWidget);
      }

      // Sumar el precio del producto al precio total
      precioTotal += productoprecio;
      // Actualizar el precio total en el elemento HTML correspondiente
      $('.cart-summary h5').text('SUBTOTAL: ' + precioTotal.toFixed(2) + ' €');
    },
    error: function(error) {
      // Manejar el error de la llamada AJAX aquí
    }
  });
}

$(document).on('click', '.delete', function() {
  // Buscar el producto en el carrito por su ID
  var productId = $(this).closest('.product-widget').data('product-id');
  var productWidget = $('.cart-list').find('[data-product-id="' + productId + '"]');
  if (productWidget.length > 0) {
    // Obtener el precio del producto que se va a eliminar
    var productoprecio = parseFloat(productWidget.find('.product-price').text().replace('€', ''));

    // Restar el precio del producto eliminado al precio total
    precioTotal -= productoprecio;

    // Actualizar el precio total en el elemento HTML correspondiente
    $('.cart-summary h5').text('SUBTOTAL: ' + precioTotal.toFixed(2) + ' €');

    // Eliminar el producto del carrito
    productWidget.remove();
  }
});

// Verificar si no hay productos en el carrito y mostrar el mensaje correspondiente
function verificarCarritoVacio() {
  if ($('.cart-list').children().length === 0) {
    $('.cart-summary h5').text('No se han añadido productos al carrito aún.');
  }
}

// Llamar a la función para verificar el carrito vacío al cargar la página
$(document).ready(function() {
  verificarCarritoVacio();
});