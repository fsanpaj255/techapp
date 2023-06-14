// Variable que recoje el precio rtotal
var precioTotal = 0;

// Array para guardar todos los productos en el carrito 
var carritoProductos = [];

// Función para agregar al carrito cosas o productos
function addToCart(productId) {
  $.ajax({
    url: 'http://localhost:8000/api/producto/get/' + productId,
    type: 'GET',
    success: function(producto) {
      var productonombre = producto.nombre;
      var productoprecio = producto.precio;
      var productoimagen = producto.imageName;

      // Incrementar el valor en +1 en el icono carrito cada vez que se hace el ajax GET
      var carritoQtyElement = $('.qty.carrito');
      var currentQuantity = parseInt(carritoQtyElement.text());
      carritoQtyElement.text(currentQuantity + 1);

      // Verificar si el producto ya esta en el carrito o no 
      var productWidget = $('.cart-list').find('[data-product-id="' + productId + '"]');
      if (productWidget.length > 0) {
        // si ya esta se incrementa el numero
        var quantityElement = productWidget.find('.qty');
        var currentQuantity = parseInt(quantityElement.text());
        quantityElement.text((currentQuantity + 1) + 'x');
      } else {
        // Y si el producto no esta en el carrito se genera el codigo html
        var productWidget = $('<div class="product-widget" data-product-id="' + productId + '"></div>');
        var productImg = $('<div class="product-img"><img src="./img/' + productoimagen + '" alt=""></div>');
        var productBody = $('<div class="product-body"></div>');
        var productNameElement = $('<h3 class="product-name"><a href="#">' + productonombre + '</a></h3>');
        var productPriceElement = $('<h4 class="product-price"><span class="qty">1x</span>' + productoprecio.toFixed(2) + ' € </h4>');
        var deleteButton = $('<button class="delete"><i class="fa fa-close"></i></button>');

        // hacer los appends de los elementos al carrito
        productWidget.append(productImg);
        productBody.append(productNameElement);
        productBody.append(productPriceElement);
        productWidget.append(productBody);
        productWidget.append(deleteButton);

        // Agregar el producto al carrito 
        $('.cart-list').append(productWidget);
      }

      // Sumar el precio del producto al precio total
      precioTotal += productoprecio;
      // Actualizar el precio total 
      $('.cart-summary h5').text('SUBTOTAL: ' + precioTotal.toFixed(2) + ' €');

      // Guardar el producto en la lista de productos del carrito
      carritoProductos.push({
        id: productId,
        nombre: productonombre,
        precio: productoprecio,
        imagen: productoimagen
      });

      // Guardar el carrito en LCAL STORAGE
      guardarCarritoEnLocalStorage();
    },
    error: function(error) {
      console.log("AAAAAAAAAAAAAAAAAAAAAAAAA");
    }
  });
}

// Función para eliminar del carrito REVISARARR
$(document).on('click', '.delete', function() {
  console.log("ELIMINANDO")
  // Buscar el producto en el carrito por su id
  var productId = $(this).closest('.product-widget').data('product-id');
  var productWidget = $('.cart-list').find('[data-product-id="' + productId + '"]');
  if (productWidget.length > 0) {
    // Obtener el precio del producto que se va a eliminar
    var productoprecio = parseFloat(productWidget.find('.product-price').text().replace('€', ''));

    // Restar el precio del producto eliminado al precio total
    precioTotal -= productoprecio;

    // Actualizar el precio total en el html
    $('.cart-summary h5').text('SUBTOTAL: ' + precioTotal.toFixed(2) + ' €');

    // Eliminar el producto del carrito
    productWidget.remove();

    // quitarel producto de la lista de productos del carrito
    carritoProductos = carritoProductos.filter(function(producto) {
      return producto.id !== productId;
    });

    // Guardar el carrito en local storage
    guardarCarritoEnLocalStorage();
  }
});

// Si no hay productos en el carrito se muestra esto
function verificarCarritoVacio() {
  if ($('.cart-list').children().length === 0) {
    $('.cart-summary h5').text('No se han añadido productos al carrito aún.');
  }
}

// Función para guardar en el localstorage
function guardarCarritoEnLocalStorage() {
  var carrito = {
    precioTotal: precioTotal,
    productos: carritoProductos
  };

  // Guardar el carrito en el local storage
  localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Recoger los productos del local storage
function cargarCarritoDesdeLocalStorage() {
  var carritoGuardado = localStorage.getItem('carrito');
  if (carritoGuardado) {
    carritoGuardado = JSON.parse(carritoGuardado);

    // Recoger el precio total desde local storage
    precioTotal = carritoGuardado.precioTotal;

    // Actualizar el precio total en el html
    $('.cart-summary h5').text('SUBTOTAL: ' + precioTotal.toFixed(2) + ' €');

    // coger los productos desde el local storage
    carritoProductos = carritoGuardado.productos;

    // Recorrer los productos y agregarlos al carrito :D
    carritoProductos.forEach(function(producto) {
      var productId = producto.id;
      var productName = producto.nombre;
      var productPrice = producto.precio;
      var productImage = producto.imagen;

      // Crear el HTML del producto
      var productWidget = $('<div class="product-widget" data-product-id="' + productId + '"></div>');
      var productImg = $('<div class="product-img"><img src="./img/' + productImage + '" alt=""></div>');
      var productBody = $('<div class="product-body"></div>');
      var productNameElement = $('<h3 class="product-name"><a href="#">' + productName + '</a></h3>');
      var productPriceElement = $('<h4 class="product-price"><span class="qty">1x</span>' + productPrice.toFixed(2) + ' € </h4>');
      var deleteButton = $('<button class="delete"><i class="fa fa-close"></i></button>');

      // Appends al carrito
      productWidget.append(productImg);
      productBody.append(productNameElement);
      productBody.append(productPriceElement);
      productWidget.append(productBody);
      productWidget.append(deleteButton);

      
      $('.cart-list').append(productWidget);
    });
  }

  // Verificar si no hay productos en el carrito y mostrar el mensaje correspondiente
  verificarCarritoVacio();

}

// funcion que vacia el carrito y resetea el local storage
function vaciarCarrito() {
  // Reiniciar el precio total y la lista de productos
  precioTotal = 0;
  carritoProductos = [];

  // Actualizar el precio total en el HTML
  $('.cart-summary h5').text('No se han añadido productos al carrito aún.');

  // Vaciar el contenido del  html
  $('.cart-list').empty();

  // Eliminar el carrito del local storage
  localStorage.removeItem('carrito');
}
$('.pagar').on('click', function() {
  enviarProductosAlControlador();
});

function enviarProductosAlControlador() {
   // Obtener los datos del carrito y el precio total
   var productosJson = JSON.stringify(carritoProductos);
   var precioTotalJson = JSON.stringify(precioTotal);

   // Actualizar los datos de los inputs ocultos del form
   $('#productos-input').val(productosJson);
   $('#precio-input').val(precioTotalJson);

   // Enviar el formulario
   $('#pago-form').submit();
 }
// Llamar a la función para verificar el carrito vacío y cargar desde el localstorage al cargar la aplicación
$(document).ready(function() {
  verificarCarritoVacio();
  cargarCarritoDesdeLocalStorage();

  // evento de vaciar el carrito
  $('.cart-summary').append('<button class="vaciar-carrito">Vaciar Carrito</button>');
  $('.vaciar-carrito').on('click', function() {
    vaciarCarrito();
    
  });
});