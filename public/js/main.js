$(document).ready(function() {
  // Initialize the cart total
  let total = 0;

  // Load cart items from local storage on page load
  const storedItems = JSON.parse(localStorage.getItem('cart')) || [];

  if (storedItems === null  || (Array.isArray(storedItems) && storedItems.length === 0) ) {
        // If cart value is null, hide the checkout button and show the alternative button
        $('#checkoutBtn').hide();
        $('#alternativeBtn').show();
    } else {
        // If cart value is not null, hide the alternative button
        $('#alternativeBtn').hide();
    }
  storedItems.forEach(item => {
    $('#cart-items').append(`<li class="list-item">${item.image}
    <div class="w-100">
        <h5 class="product-title">${item.product}</h5>
        <p class="text text-muted">Blue</p>
        <div class="d-flex justify-content-between align-items-end mb-2">
            <input class="form-control shadow-none" type="number" value="${item.quantity}" style="max-width: 70px;">
            <div class="text-primary fs-6">${item.price.toFixed(2)}</div>
        </div>
        <a data-product="${item.product}" data-price="${item.price}" data-image="${item.image}" class="text-primary remove-item" class="text-primary">Remove</a>
    
    </div></li>`);
    total += item.price;
  });

  updateTotal();

  // Add to Cart button click event
  $('.add-to-cart').on('click', function() {
      $('#checkoutBtn').show();
        $('#alternativeBtn').hide();
    const product_id = $(this).data('product_id');
    const product = $(this).data('product');
    const price = parseFloat($(this).data('price'));
    const quantity = parseFloat($(this).data('quantity'));
    const image = $(this).data('image');
    // Check if the item is already in the cart
    const isItemInCart = storedItems.some(item => item.product === product);

    if (isItemInCart) {
      alert('Item is already in your cart.');
      $('#cartCanvas').addClass('show');
      return;
    }

    total += price*quantity;

    // Add item to cart
    $('#cart-items').append(`<li class="list-item">${image}
    <div class="w-100">
        <h5 class="product-title">${product}</h5>
        <p class="text text-muted">Blue</p>
        <div class="d-flex justify-content-between align-items-end mb-2">
            <input class="form-control shadow-none" type="number" value="${quantity}" style="max-width: 70px;">
            <div class="text-primary fs-6">${price.toFixed(2)}</div>
        </div>
        <a  data-product="${product}" data-quantity="${quantity}" data-price="${price}" data-image="${image}" class="text-primary remove-item">Remove</a>
    
    </div></li>`);

    // Save cart items to local storage
    storedItems.push({ product_id,product, price ,image,quantity});
    localStorage.setItem('cart', JSON.stringify(storedItems));

    updateTotal();

    // Close the off-canvas cart
    $('#cartCanvas').addClass('show');
  });

  // Checkout button click event
  $('#checkout').on('click', function() {
    alert('Checkout successful! Total: $' + total.toFixed(2));
  });

  $(document).on('click', '.remove-item', function() {
    let product = $(this).data('product');
    let price = parseFloat($(this).data('price'));
    let quantity = parseFloat($(this).data('quantity'));
    // Find the index of the item in the cart
    let indexToRemove = storedItems.findIndex(item => item.product === product && item.price === price);

    if (indexToRemove !== -1) {
        // Remove the item from the cart
        storedItems.splice(indexToRemove, 1);
        localStorage.setItem('cart', JSON.stringify(storedItems));
        console.log(storedItems);

    // Update the UI
    $(this).closest('li').remove();

    // Update total

    total -= price*quantity;
    updateTotal();
    }
  });


  // Function to update the total displayed in the cart
  function updateTotal() {
    $('.total').text(`Total: £${total.toFixed(2)}`);
  }
});

function incrementQuantity() {
  const quantityInput = document.getElementById('quantity');
  const quantities = document.getElementsByClassName('qty');
  const currentQuantity = parseInt(quantityInput.value, 10);

  const maxQuantity = parseInt(quantityInput.max, 10);

  if (currentQuantity < maxQuantity) {
      const newQuantity = currentQuantity + 1;
      quantityInput.value = newQuantity;
      Array.from(quantities).forEach(function (quantity) {
          quantity.value = newQuantity;
      });
      const id = quantityInput.getAttribute('data-id');
      var myButton = document.getElementById('add-to-cart');

    // Change the data-value attribute
    myButton.setAttribute('data-quantity',newQuantity);

  }
}

function decrementQuantity() {
  const quantityInput = document.getElementById('quantity');
  const quantities = document.getElementsByClassName('qty');
  const currentQuantity = parseInt(quantityInput.value, 10);

  if (currentQuantity > 1) {
      const newQuantity = currentQuantity - 1;
      quantityInput.value = newQuantity;
      Array.from(quantities).forEach(function (quantity) {
          quantity.value = newQuantity;
      });
      const id = quantityInput.getAttribute('data-id');
      var myButton = document.getElementById('add-to-cart');

    // Change the data-value attribute
    myButton.setAttribute('data-quantity',newQuantity);

  }
}

$(document).on('click', '#btn-close', function() {
  $('#cart').removeClass('show');
  $('.offcanvas ').removeClass('show');
});
