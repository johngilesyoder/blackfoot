(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away

    //smooth scroll to top
    $('#back-to-top').on('click', function(event){
      event.preventDefault();
      $('body,html').animate({
        scrollTop: 0 ,
        }, 400
      );
    });

	});
	
})(jQuery, this);
