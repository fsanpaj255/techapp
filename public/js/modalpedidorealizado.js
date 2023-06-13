$(document).ready(function() {
  // Verificar si se ha realizado el pedido
  var pedidoRealizado = true; 

  $('#btn-realizar-pedido').click(function() {
    // Mostrar el modal
    mostrarModal();
  });
});

function mostrarModal() {
  // Mostrar el modal
  $('#pedido-realizado-modal').css('display', 'block');

  // Cerrar el modal al hacer clic en la "x"
  $('.close').click(function() {
    ocultarModal();
  });

  // Cerrar el modal al hacer clic fuera del contenido
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