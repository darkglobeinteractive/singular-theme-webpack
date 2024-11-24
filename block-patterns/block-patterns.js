jQuery(document).ready(function($) {

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

      $('.accordion-item.open').each(function() {

        var $content_wrap = $('.accordion-item-content', this);
        var $content_content = $('> div', $content_wrap);
        var content_height = $content_content.innerHeight() + 'px';
        $content_wrap.css('max-height',content_height);

      });

    });

  });

});
