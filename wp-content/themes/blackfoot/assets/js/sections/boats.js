(function ($, root, undefined) {
  
  $(function () {
    
    'use strict';
    
    // DOM ready, take it away
    var gravityForm = $('#gform_wrapper_8');
    var imageAssetDir = '/wp-content/themes/blackfoot/assets/img/boats/';

    var updateTotal = function() {
      var total = 0.00;

      $('#byob-form input:checked').each(function() {
        if($(this).attr('data-price')) {
          total += Number($(this).data('price'));
        }
      });

      if(total > 0) {
        $('#submit-button').attr('disabled', false);
      } else {
        $('#submit-button').attr('disabled', true);
      }

      $('#sticky-total').text('$' + total.toString() + '.00');
      $('#mobile-total').text('$' + total.toString() + '.00');
      $('#sticky-subtotal').text('$' + total.toString() + '.00');
      $('#mobile-subtotal').text('$' + total.toString() + '.00');
      gravityForm.find('#ginput_base_price_8_17').val('$' + total.toString() + '.00').change();
    }

    $(document).ready(function() {
      $("input[name='boat']").change(function() {
        updateTotal();
        var boat = $(this).data('item');

        // Set the gravity form boat hidden field value
        gravityForm.find('#boat').val(boat);

        $('#boat-lineitem').text(boat);
        $('#boat-price').text($(this).data('price'));
        //$('#boat-subtotal').text($(this).data('price'));
        $('#boat-options').hide();
        $('#boat-lineitems').show();
        $('#shop-confidence').show();
        $('#sticky-totals').show();
        $('#mobile-totals').show();
        $('#step-one-edit').show();
        $('#step-two').show();
        $('#additional-options').show();
        $('#step-three').show();
        $('#color-picker').show();
        $('#step-four').show();
        $('#frames').show();
        $('#step-five').show();
        $('#accessories').show();
        $('#step-place-order').show();
        $('#step-one-title').addClass('is--completed');
      });

      $('#step-one-edit').on('click', function() {
        $('#step-one-edit').hide();
        $('#boat-lineitems').hide();
        $('#boat-options').show();
        $('#step-one-title').removeClass('is--completed');
      });

      $("input[name='boat-option']").change(function() {
        updateTotal();

        if($(this).is(':checked')) {
          $(this).next('span').text($(this).data('price'));
          gravityForm.find('#' + $(this).data('item')).val('true');
        } else {
          $(this).next('span').text('0.00');
          gravityForm.find('#' + $(this).data('item')).val('false');
        }
      });

      $("input[name='color']").change(function() {
        var buttonId = $('#color-button-group .active').attr('id');
        gravityForm.find('#' + buttonId).val($(this).val());
      });

      $("input[name='quantity']").on('keyup paste', function() {
        // Todo check if quantity is a number
        calculateAccessory($(this).closest('tr').find('.accessory-checkbox'));
      });

      $('#color-button-group :button').on('click', function() {
        $(this).siblings().removeClass('active')
        $(this).addClass('active');

        var buttonId = $('#color-button-group .active').attr('id');
        $('#color-image').attr("src", imageAssetDir + buttonId + '.png');

        var currentValue = gravityForm.find('#' + buttonId).val();

        if(currentValue && currentValue.length > 0) {
          $("input[name='color'][value='" + currentValue + "']").prop('checked', true);
        } else {
          $("input[name='color']").prop('checked', false);
        }
      });

      var calculateAccessory = function(element) {
        var accessory = element.data('item');
        var quantity = element.closest('tr').find('.accessory-qty-value').val();
        var priceEach = Number(element.data('price-each'));
        var totalPrice = quantity * priceEach;

        var gravityFormElement = gravityForm.find('#' + accessory);

        if(element.is(':checked')) {
          element.closest('tr').find('.accessory-subtotal-value').text(totalPrice.toString() + '.00');
          element.data('price', totalPrice.toString());
        } else {
          element.closest('tr').find('.accessory-subtotal-value').text('0.00');
          element.data('price', '0.00');
        }

        gravityFormElement.val(quantity);
        updateTotal();
      }

      $("input[name='accessory']").change(function() {
        calculateAccessory($(this));
      });

      $("input[name='frame']").change(function() {
        updateTotal();
        var frame = $(this).data('item');

        // Set the gravity form frame hidden field value
        gravityForm.find('#frame').val(frame);
      });
    });

    // Rename hidden input IDs
    $('#input_8_1').attr('id','boat');
    $('#input_8_4').attr('id','additional-chamber-option');
    $('#input_8_5').attr('id','top-chafe-option');
    $('#input_8_6').attr('id','bottom-wrap-option');
    $('#input_8_7').attr('id','primary-boat-color');
    $('#input_8_8').attr('id','handle-patch-color');
    $('#input_8_9').attr('id','d-ring-patch-color');
    $('#input_8_10').attr('id','floor-color');
    $('#input_8_11').attr('id','chafe-color');
    $('#input_8_12').attr('id','frame');
    $('#input_8_13').attr('id','orion-cooler');

    //$('#input_3_2').attr('id','purchase-total');

  });
  
})(jQuery, this);