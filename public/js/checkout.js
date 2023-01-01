$(document).ready(function() {
    // Load cart items from local storage on page load
    const storedItems = JSON.parse(localStorage.getItem('cart')) || [];
    let total = 0;
  
    // Populate checkout items
    storedItems.forEach(item => {
      $('.checkout-items1').append(`<li class="list-item">
      <div class="d-flex justify-content-between gap-2">
          <div class="d-flex gap-3">
          ${item.image}
              <h3 class="title">
              ${item.product}
              </h3>
          </div>
          <h3 class="price">${item.price.toFixed(2)}</h3>
      </div>
  </li>`);
  $('.checkout-items2').append(`<li class="list-item">
      <div class="d-flex justify-content-between gap-2">
          <div class="d-flex gap-3">
          ${item.image}
              <h3 class="title">
              ${item.product}
              </h3>
          </div>
          <h3 class="price">${item.price.toFixed(2)}</h3>
      </div>
  </li>`);
  $('.checkout-items3').append(`<li class="list-item">
      <div class="d-flex justify-content-between gap-2">
          <div class="d-flex gap-3">
          ${item.image}
              <h3 class="title">
              ${item.product}
              </h3>
          </div>
          <h3 class="price">${item.price.toFixed(2)}</h3>
      </div>
  </li>`);
      total += item.price;
    });
  
    // Update total on the checkout page
    $('#checkout-subtotal').text(`£${total.toFixed(2)}`);
    $('#checkout-total').text(`£${total.toFixed(2)}`);
    $('#amount').val(`£${total.toFixed(2)}`);
    document.getElementById('cart-input').value = JSON.stringify(storedItems);
  });

  (function () {
    var ccnum = document.getElementById('ccnum'),
        type = document.getElementById('ccnum-type'),
        expiry = document.getElementById('expiry'),
        cvc = document.getElementById('cvc'),
        submit = document.getElementById('omplete-order'),
        result = document.getElementById('result');

    payform.cardNumberInput(ccnum);
    payform.expiryInput(expiry);
    payform.cvcInput(cvc);

    ccnum.addEventListener('input', updateType);

    submit.addEventListener('click', function () {
        var valid = [],
            expiryObj = payform.parseCardExpiry(expiry.value);

        valid.push(fieldStatus(ccnum, payform.validateCardNumber(ccnum.value)));
        valid.push(fieldStatus(expiry, payform.validateCardExpiry(expiryObj)));
        valid.push(fieldStatus(cvc, payform.validateCardCVC(cvc.value, type.innerHTML)));

        result.className = 'emoji ' + (valid.every(Boolean) ? 'valid' : 'invalid');
    });

    function updateType(e) {
        var cardType = payform.parseCardType(e.target.value);
        type.innerHTML = cardType || 'invalid';
    }


    function fieldStatus(input, valid) {
        if (valid) {
            removeClass(input.parentNode, 'error');
        } else {
            addClass(input.parentNode, 'error');
        }
        return valid;
    }

    function addClass(ele, _class) {
        if (ele.className.indexOf(_class) === -1) {
            ele.className += ' ' + _class;
        }
    }

    function removeClass(ele, _class) {
        if (ele.className.indexOf(_class) !== -1) {
            ele.className = ele.className.replace(_class, '');
        }
    }
})();
  