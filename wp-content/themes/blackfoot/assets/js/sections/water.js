(function ($, root, undefined) {
  
  $(function () {
    
    'use strict';
    
    $('#description-content').html(function (i, html) {
      return html.replace(/(\w+\s\w+\s\w+)/, '<strong class="leading-words">$1</strong>')
    });
    

  });
  
})(jQuery, this);
