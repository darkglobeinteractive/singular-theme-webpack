jQuery(document).ready(function($) {

  /*
  jQuery throttle / debounce - v1.1 - 3/7/2010 -- Rewritten to accommodate webpack compilation
  http://benalman.com/projects/jquery-throttle-debounce-plugin/
  */
  function st_throttle(e,f,j,i){var c=undefined;var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g}

  // Global function that works with dynamically generated content on the page
  function applyWhenElementExists(selector, myFunction, intervalTime) {
    var interval = setInterval(function() {
      if (jQuery(selector).length > 0) {
        myFunction();
        clearInterval(interval);
      }
    }, intervalTime);
  }

  /*
  $(window).on('scroll', st_throttle(500, function() {
    console.log('do something');
  }));
  */

  /* ACCORDION SCRIPTS ------------------------------------------ */
  $('.wp-block-singular.accordion-container').each(function() {

    var $accordion = $(this);

    $('.accordion-item', $accordion).each(function() {

      var $item = $(this);
      var $title_wrap = $('.accordion-item-title > div', $item);
      var $content_wrap = $('.accordion-item-content', $item);
      var $content_content = $('> div', $content_wrap);

      $title_wrap.append('<button class="toggle"><span>Toggle</span></button>').on('click', function() {
        
        if ($item.hasClass('open')) {

          $content_wrap.css('max-height','');
          $item.removeClass('open');

        } else {

          var content_height = $content_content.innerHeight() + 'px';
          $content_wrap.css('max-height',content_height);
          $item.addClass('open');

        }

      });

    });

    $(window).on('resize', function() {

      $('.accordion-item.open', $accordion).each(function() {

        var $content_wrap = $('.accordion-item-content', this);
        var $content_content = $('> div', $content_wrap);
        var content_height = $content_content.innerHeight() + 'px';
        $content_wrap.css('max-height',content_height);

      });

    });

  });

});
