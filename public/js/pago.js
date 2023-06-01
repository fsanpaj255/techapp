
// Obtener el contenedor de productos del pedido
const productosDelPedido = document.querySelector('.productos-del-pedido');

// Obtener el contenedor del total del pedido
const totalDelPedido = document.querySelector('.columna-del-pedido.total strong');

// Obtener el botón de compra
const botonDeCompra = document.querySelector('.botón-de-compra');

// Función para calcular el total del pedido
function calcularTotal() {
  // Obtener todos los elementos de producto agregados al carrito
  const elementosDeProducto = document.querySelectorAll('.producto-agregado');

  let total = 0;

  // Calcular el total sumando los precios de los productos
  elementosDeProducto.forEach((elementoDeProducto) => {
    const precio = parseFloat(elementoDeProducto.getAttribute('data-precio'));
    total += precio;
  });

  // Actualizar el texto del total del pedido
  totalDelPedido.textContent = total.toFixed(2);
}

// Función para agregar un producto al carrito
function agregarProducto(nombre, precio) {
  // Crear el elemento del producto
  const producto = document.createElement('div');
  producto.classList.add('producto-agregado');
  producto.setAttribute('data-precio', precio);

  // Crear el nombre del producto
  const nombreProducto = document.createElement('div');
  nombreProducto.textContent = nombre;
  producto.appendChild(nombreProducto);

  // Crear el precio del producto
  const precioProducto = document.createElement('div');
  precioProducto.textContent = precio.toFixed(2);
  producto.appendChild(precioProducto);

  // Agregar el producto al contenedor de productos del pedido
  productosDelPedido.appendChild(producto);

  // Calcular el nuevo total del pedido
  calcularTotal();
}

// Ejemplo de uso: Agregar productos al carrito
agregarProducto('Camisa', 25.99);
agregarProducto('Pantalón', 39.99);
agregarProducto('Zapatos', 59.99);

// Manejar el evento de clic en el botón de compra
botonDeCompra.addEventListener('click', () => {
  // Aquí puedes agregar la lógica para procesar el pago
  // y redirigir al usuario a la página de confirmación
});