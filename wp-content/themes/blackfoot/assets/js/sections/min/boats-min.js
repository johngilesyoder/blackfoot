!function($,t,i){$(function(){"use strict";var t=$("#gform_wrapper_8"),i="/wp-content/themes/blackfoot/assets/img/boats/",o=function(){var i=0;$("#byob-form input:checked").each(function(){$(this).attr("data-price")&&(i+=Number($(this).data("price")))}),i>0?$("#submit-button").attr("disabled",!1):$("#submit-button").attr("disabled",!0),$("#sticky-total").text("$"+i.toString()+".00"),$("#mobile-total").text("$"+i.toString()+".00"),$("#sticky-subtotal").text("$"+i.toString()+".00"),$("#mobile-subtotal").text("$"+i.toString()+".00"),t.find("#ginput_base_price_8_17").val("$"+i.toString()+".00").change()};$(document).ready(function(){$("input[name='boat']").change(function(){o();var i=$(this).data("item");t.find("#boat").val(i),$("#boat-lineitem").text(i),$("#boat-price").text($(this).data("price")),$("#boat-options").hide(),$("#boat-lineitems").show(),$("#shop-confidence").show(),$("#sticky-totals").show(),$("#mobile-totals").show(),$("#step-one-edit").show(),$("#step-two").show(),$("#additional-options").show(),$("#step-three").show(),$("#color-picker").show(),$("#step-four").show(),$("#frames").show(),$("#step-five").show(),$("#accessories").show(),$("#step-place-order").show(),$("#step-one-title").addClass("is--completed")}),$("#step-one-edit").on("click",function(){$("#step-one-edit").hide(),$("#boat-lineitems").hide(),$("#boat-options").show(),$("#step-one-title").removeClass("is--completed")}),$("input[name='boat-option']").change(function(){o(),$(this).is(":checked")?($(this).next("span").text($(this).data("price")),t.find("#"+$(this).data("item")).val("true")):($(this).next("span").text("0.00"),t.find("#"+$(this).data("item")).val("false"))}),$("input[name='color']").change(function(){var i=$("#color-button-group .active").attr("id");t.find("#"+i).val($(this).val())}),$("input[name='quantity']").on("keyup paste",function(){e($(this).closest("tr").find(".accessory-checkbox"))}),$("#color-button-group :button").on("click",function(){$(this).siblings().removeClass("active"),$(this).addClass("active");var o=$("#color-button-group .active").attr("id");$("#color-image").attr("src",i+o+".png");var e=t.find("#"+o).val();e&&e.length>0?$("input[name='color'][value='"+e+"']").prop("checked",!0):$("input[name='color']").prop("checked",!1)});var e=function(i){var e=i.data("item"),a=i.closest("tr").find(".accessory-qty-value").val(),n=Number(i.data("price-each")),s=a*n,c=t.find("#"+e);i.is(":checked")?(i.closest("tr").find(".accessory-subtotal-value").text(s.toString()),i.data("price",s.toString())):(i.closest("tr").find(".accessory-subtotal-value").text("0.00"),i.data("price","0.00")),c.val(a),o()};$("input[name='accessory']").change(function(){e($(this))}),$("input[name='frame']").change(function(){o();var i=$(this).data("item");t.find("#frame").val(i)})}),$("#input_8_1").attr("id","boat"),$("#input_8_4").attr("id","additional-chamber-option"),$("#input_8_5").attr("id","top-chafe-option"),$("#input_8_6").attr("id","bottom-wrap-option"),$("#input_8_7").attr("id","primary-boat-color"),$("#input_8_8").attr("id","handle-patch-color"),$("#input_8_9").attr("id","d-ring-patch-color"),$("#input_8_10").attr("id","floor-color"),$("#input_8_11").attr("id","chafe-color"),$("#input_8_12").attr("id","frame"),$("#input_8_13").attr("id","orion-cooler")})}(jQuery,this);