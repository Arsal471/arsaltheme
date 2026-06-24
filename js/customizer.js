(function($){
  wp.customize('arsal_header_text', function(value) {
    value.bind(function(newval) {
      $('h1').text(newval);
    });
  });
})(jQuery);
