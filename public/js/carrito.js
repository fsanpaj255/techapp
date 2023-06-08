// Variable para almacenar el precio total
var precioTotal = 0;

// Arreglo para almacenar los productos del carrito
var carritoProductos = [];

// Función para agregar al carrito
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

      // Guardar el producto en la lista de productos del carrito
      carritoProductos.push({
        id: productId,
        nombre: productonombre,
        precio: productoprecio,
        imagen: productoimagen
      });

      // Guardar el carrito en el almacenamiento local
      guardarCarritoEnLocalStorage();
    },
    error: function(error) {
      // Manejar el error de la llamada AJAX aquí
    }
  });
}

// Función para eliminar del carrito
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

    // Remover el producto de la lista de productos del carrito
    carritoProductos = carritoProductos.filter(function(producto) {
      return producto.id !== productId;
    });

    // Guardar el carrito en el almacenamiento local
    guardarCarritoEnLocalStorage();
  }
});

// Función para verificar si no hay productos en el carrito y mostrar el mensaje correspondiente
function verificarCarritoVacio() {
  if ($('.cart-list').children().length === 0) {
    $('.cart-summary h5').text('No se han añadido productos al carrito aún.');
  }
}

// Función para guardar el carrito en el almacenamiento local
function guardarCarritoEnLocalStorage() {
  var carrito = {
    precioTotal: precioTotal,
    productos: carritoProductos
  };

  // Guardar el carrito en el almacenamiento local
  localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Función para cargar el carrito desde el almacenamiento local
function cargarCarritoDesdeLocalStorage() {
  var carritoGuardado = localStorage.getItem('carrito');
  if (carritoGuardado) {
    carritoGuardado = JSON.parse(carritoGuardado);

    // Cargar el precio total desde el almacenamiento local
    precioTotal = carritoGuardado.precioTotal;

    // Actualizar el precio total en el elemento HTML correspondiente
    $('.cart-summary h5').text('SUBTOTAL: ' + precioTotal.toFixed(2) + ' €');

    // Cargar los productos desde el almacenamiento local
    carritoProductos = carritoGuardado.productos;

    // Recorrer los productos y agregarlos al carrito
    carritoProductos.forEach(function(producto) {
      var productId = producto.id;
      var productName = producto.nombre;
      var productPrice = producto.precio;
      var productImage = producto.imagen;

      // Crear los elementos HTML del producto
      var productWidget = $('<div class="product-widget" data-product-id="' + productId + '"></div>');
      var productImg = $('<div class="product-img"><img src="./img/' + productImage + '" alt=""></div>');
      var productBody = $('<div class="product-body"></div>');
      var productNameElement = $('<h3 class="product-name"><a href="#">' + productName + '</a></h3>');
      var productPriceElement = $('<h4 class="product-price"><span class="qty">1x</span>' + productPrice.toFixed(2) + ' € </h4>');
      var deleteButton = $('<button class="delete"><i class="fa fa-close"></i></button>');

      // Agregar los elementos al producto
      productWidget.append(productImg);
      productBody.append(productNameElement);
      productBody.append(productPriceElement);
      productWidget.append(productBody);
      productWidget.append(deleteButton);

      // Agregar el producto al carrito en el div "cart-list"
      $('.cart-list').append(productWidget);
    });
  }

  // Verificar si no hay productos en el carrito y mostrar el mensaje correspondiente
  verificarCarritoVacio();
}

// Función para vaciar el carrito y resetear el almacenamiento local
function vaciarCarrito() {
  // Reiniciar el precio total y la lista de productos
  precioTotal = 0;
  carritoProductos = [];

  // Actualizar el precio total en el elemento HTML correspondiente
  $('.cart-summary h5').text('No se han añadido productos al carrito aún.');

  // Vaciar el contenido del carrito en el HTML
  $('.cart-list').empty();

  // Eliminar el carrito del almacenamiento local
  localStorage.removeItem('carrito');
}
$('.pagar').on('click', function() {
  enviarProductosAlControlador();
});

function enviarProductosAlControlador() {
   // Obtener los datos del carrito y el precio total
   var productosJson = JSON.stringify(carritoProductos);
   var precioTotalJson = JSON.stringify(precioTotal);

   // Actualizar los valores en los campos ocultos del formulario
   $('#productos-input').val(productosJson);
   $('#precio-input').val(precioTotalJson);

   // Enviar el formulario
   $('#pago-form').submit();
 }
// Llamar a la función para verificar el carrito vacío y cargar desde el almacenamiento local al cargar la página
$(document).ready(function() {
  verificarCarritoVacio();
  cargarCarritoDesdeLocalStorage();

  // Agregar evento al botón de vaciar carrito
  $('.cart-summary').append('<button class="vaciar-carrito">Vaciar Carrito</button>');
  $('.vaciar-carrito').on('click', function() {
    vaciarCarrito();
  });
});