// $(document).ready(function() {
//     $('#search-input').keypress(function(event) {
//       // Verificar si se presionó la tecla "Enter"
//       if (event.which === 13) {
//         event.preventDefault(); // Evitar el envío del formulario
        
//         // Obtener el valor del campo de búsqueda
//         var searchTerm = $(this).val();
        
//         // Realizar la llamada AJAX GET
//         $.ajax({
//           url: 'http://localhost:8000/api/producto/get',
//           type: 'GET',
//           dataType: 'json',
//           success: function(response) {
//             // Filtrar los productos por el término de búsqueda
//             var filteredProducts = response.filter(function(product) {
//               return product.nombre.toLowerCase().includes(searchTerm.toLowerCase());
//             });
            
//             // Mostrar los productos filtrados en la página
//             showProducts(filteredProducts);
//           },
//           error: function(xhr, status, error) {
//             console.error(error);
//           }
//         });
//       }
//     });
    
//     function showProducts(products) {
//             var products = [
//               {
//                 imgSrc: './img/product1.png',
//                 label: 'NEW',
//                 category: 'Category',
//                 name: 'Product 1',
//                 price: '$100.00',
//                 oldPrice: '$120.00',
//                 rating: 4.5
//               },
//               {
//                 imgSrc: './img/product2.png',
//                 label: 'SALE',
//                 category: 'Category',
//                 name: 'Product 2',
//                 price: '$80.00',
//                 oldPrice: '$90.00',
//                 rating: 4
//               },
//               {
//                 imgSrc: './img/product3.png',
//                 label: 'NEW',
//                 category: 'Category',
//                 name: 'Product 3',
//                 price: '$60.00',
//                 oldPrice: '$70.00',
//                 rating: 3.5
//               }
//             ];
          
//             var $storeProducts = $('#store .row').empty();
          
//             $.each(products, function(index, product) {
//               var $product = $('<div class="col-md-4 col-xs-6">' +
//                                  '<div class="product">' +
//                                    '<div class="product-img">' +
//                                      '<img src="' + product.imgSrc + '" alt="">' +
//                                      '<div class="product-label"><span class="new">' + product.label + '</span></div>' +
//                                    '</div>' +
//                                    '<div class="product-body">' +
//                                      '<p class="product-category">' + product.category + '</p>' +
//                                      '<h3 class="product-name"><a href="#">' + product.name + '</a></h3>' +
//                                      '<h4 class="product-price">' + product.price + ' <del class="product-old-price">' + product.oldPrice + '</del></h4>' +
//                                      '<div class="product-rating"></div>' +
//                                      '<div class="product-btns">' +
//                                        '<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>' +
//                                        '<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>' +
//                                        '<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>' +
//                                      '</div>' +
//                                    '</div>' +
//                                    '<div class="add-to-cart">' +
//                                      '<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>' +
//                                    '</div>' +
//                                  '</div>' +
//                                '</div>');
          
//               $storeProducts.append($product);
          
//               var $productRating = $product.find('.product-rating');
//               for (var i = 0; i < product.rating; i++) {
//                 $productRating.append('<i class="fa fa-star"></i>');
//               }
//             });
//           }
//   });