/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/welcome.js ***!
  \*********************************/
$(function () {
  $('.products-count a').click(function (event) {
    event.preventDefault();
    $('.products-actual-count').text($(this).text());
    getProducts($(this).text());
  });
  $('#filter-button').click(function (event) {
    event.preventDefault();
    getProducts($('.products-actual-count').first().text());
  });
  $('body').on('click', '.add-cart-button', function (event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: WELCOME_DATA.addToCart + $(this).data('id')
    }).done(function () {
      Swal.fire({
        title: 'Dodano produkt do koszyka',
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-cart-shopping"></i> Przejdz do koszyka',
        cancelButtonText: '<i class="fa-solid fa-shopping-bag"></i> Kontynuuj zakupy',
        reverseButtons: true
      }).then(function (result) {
        if (result.isConfirmed) {
          window.location = WELCOME_DATA.listCart;
        }
      });
    }).fail(function (data) {
      Swal.fire('Oops...', "Wystąpił bląd", "error");
    });
  });

  function getProducts(paginate) {
    var form = $('form.sidebar-filter').serialize();
    $.ajax({
      method: "GET",
      url: "/",
      data: form + "&" + $.param({
        paginate: paginate
      })
    }).done(function (response) {
      $('#products-wrapper').empty();
      $.each(response.data, function (index, product) {
        var html = '<div class="col-6 col-md-6 col-lg-4 mb-3">\n' + '           <div class="card h-100 border-0">\n' + '               <div class="card-img-top">\n' + '                   <img src="' + getImage(product) + '" class="mx-auto d-block" alt="Product image" width="240px" height="240px" />\n' + '               </div>\n' + '               <div class="card-body text-center">\n' + '                   <h4 class="card-title">\n' + '                       <p class="font-weight-bold text-dark text-uppercase small">' + product.name + '</p>\n' + '                   </h4>\n' + '                   <h5 class="card-price small">\n' + '                       <i>PLN ' + product.price + '</i>\n' + '                   </h5>\n' + '               </div>\n' + '               <button class="btn btn-outline-primary btn-sm add-cart-button' + getDisabled() + '" data-id="' + product.id + '"><i class="fa-solid fa-cart-shopping"></i> Dodaj do koszyka</button>\n' + '             </div>\n' + '           </div>';
        $('#products-wrapper').append(html);
      });
    });
  }

  function getImage(product) {
    if (product.image_path != null) {
      //The same: !!product.image_path
      return WELCOME_DATA.storagePath + product.image_path;
    }

    return WELCOME_DATA.default_img;
  }

  function getDisabled() {
    if (WELCOME_DATA.isGuest) {
      return ' disabled';
    }

    return '';
  }
});
/******/ })()
;