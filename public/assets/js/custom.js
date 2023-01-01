$(document).ready(function () {
  setTimeout(function(){
    $('.main-content').css('margin-top', $('.header').height());
  }, 100);
  $(window).scroll(function() {
    if ($(this).scrollTop() > 40) {
      $('.header-top').addClass('active');
    } else {
      $('.header-top').removeClass('active');
    }
  });

  $('.header-top-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dots: false,
    arrows: false,
    infinite: true
  });


  $('.product-slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    centerMode: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
        }
      }
    ]
  });

  $('.product-slider-nav').on('afterChange', function(event, slick, currentSlide){
    // Get the src attribute value of the active slide
    var activeSlideSrc = $('.product-slider-nav .slick-center img').attr('src');
    $('#product-img-preview').attr('src', activeSlideSrc)
  });


  $('.product-img-wrapper img').on('click', function() {
    $('#productImgModal').modal('show');
    let imgUrl = $(this).attr('src');
    $('.single-img').attr('src', imgUrl)
  });

  
  $('.form-check input').each(function () {
    var selectedInput = $(this);

    selectedInput.on('change', function () {
      let selectedColor = selectedInput.val();
      var NavSrc = $('.product-slider-nav .slider-item[color="'+ selectedColor +'"] img').attr('src');
      $('#product-img-preview').attr('src', NavSrc)
    });
  });

  $('.form-control').each(function () {
    var input = $(this);

    input.on('keyup', function () {
      if (input.val().length >= 1) {
        input.parent().addClass('active');
      } else {
        input.parent().removeClass('active');
      }
    });
  });

  $('#optionalAddressToggle').on('click', function () {
    $('#optionalAddressBox').toggleClass('d-block')
  });
  $('#optionalBillingAddressToggle').on('click', function () {
    $('#optionalBillingAddressBox').toggleClass('d-block')
  });


  $('#sameShippingAddress').on('change', function () {
    if ($(this).is(':checked')) {
      $('#sameShippingAddressBox').removeClass('d-block');
    } else {
      $('#sameShippingAddressBox').addClass('d-block');
    }
  });


  $('.accordion-button').on('click', function () {
    var checkbox = $('.form-check-input', this);
    checkbox.prop('checked', !checkbox.prop('checked'));
    if ($('#googlePayBtn').is(':checked')) {
      $('#checkoutSubmitBtn').attr('onclick', 'showDummyErrorModal()');
    } else if($('#paypalBtn').is(':checked')) {
      $('#checkoutSubmitBtn').attr('onclick', 'showDummyErrorModal()');
    }
     else {
      $('#checkoutSubmitBtn').attr('onclick', 'submitChecoutForm()');
      $('#checkoutSubmitBtn').attr('type', 'submit');

    }
  });

});