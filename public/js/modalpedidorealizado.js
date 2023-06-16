$(document).ready(function() {
  // Comprobar si se ha realizado el pedido que le pasamos en en el controller de finalizar pedido por la url un true si vienes a la 
  //landing desde allli
  var pedidoRealizado = false; 

  //Comprobacion de que en la url el modal esta true
  var urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('modal') && urlParams.get('modal') === 'true') {
    pedidoRealizado = true; // Actualizar el valor a true
  }
// y si esta true pues se desoculta el modal
  if (pedidoRealizado) {
    // Mostrar el modal
    mostrarModal();
  }
});

function mostrarModal() {
  // Mostrar el modal
  $('#pedido-realizado-modal').css('display', 'block');

  // Cerrar el modal al hacer clic en la x
  $('.close').click(function() {
    ocultarModal();
  });

  // Cerrar el modal al hacer clic fuera del mismo
  $(window).click(function(event) {
    if (event.target == $('#pedido-realizado-modal')[0]) {
      ocultarModal();
    }
  });
}

function ocultarModal() {
  // Ocultar el modal
  $('#pedido-realizado-modal').css('display', 'none');
}

