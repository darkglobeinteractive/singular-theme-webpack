jQuery(document).ready(function($) {

  /* MULTI-SLIDER ----------------------------------------------- */
  $('.multi-slider-block').each(function() {

    // The following set_modal_window_height function allows you to set heights of different sections of the modal window upon modal window opening
    function set_modal_window_height() {
      
      var container_height = $('.modaal-wrapper .modaal-container').height();
      var content_height = container_height;
  
      console.log('Container Height: '+container_height);
      console.log('Content Height: '+content_height);
  
      $('.modaal-wrapper .modaal-container .slider-modal-info').css({
        'height': container_height+'px'
      });
    }
  
    function initialize_modal_windows($slider) {
      $('a.wrap.modal', $slider).modaal({
        custom_class: 'multi-slider-modal-window',
        background: '#fff',
        overlay_opacity: 0.5,
        width: 650
        // after_open: set_modal_window_height
      });
    }

    var $container = $(this);
    var $slider_container = $('.multi-slider', $container);
    var $slider = $('.slider > .wrap', $slider_container);
    var slide_count = $('.item', $slider).length;
    var $slider_nav = $('.slider-nav', $container);
    var $nav_prev = $('.slider--prev', $slider_nav);
    var $nav_next = $('.slider--next', $slider_nav);
    var autoplay = ( $container.hasClass('autoplay-slider') ? true : false );
    var autoplay_speed = ( autoplay ? $container.data('autoplay-speed') : 4000 );
    var transition_speed = ( autoplay ? $container.data('transition-speed') : 1000 );
    
    $nav_prev.each(function() {
      $(this).on('click', function() {
        $slider.slick('slickPrev');
      });
    });
    
    $nav_next.each(function() {
      $(this).on('click', function() {
        $slider.slick('slickNext');
      });
    });
    
    $slider.on('init reInit breakpoint', function(slick) {
      
      // Make sure slider is visible
      $slider_container.addClass('show');

      // Determine if custom navigation should show/hide
      var active_slides = $('.slick-active', $slider).length;
      if (active_slides < slide_count) {
        $slider_nav.addClass('show');
      } else {
        $slider_nav.removeClass('show');
      }

      // Re-initialize modal windows if this is a modal slider
      if ($container.hasClass('modal')) {
        initialize_modal_windows($slider);
      }
     
    });

    // Set slider variables
    var slider_args = {
      dots: false,
      arrows: false,
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1921,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 1441,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 961,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 481,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    };

    // Set autoplay variables if necessary
    if (autoplay) {
      slider_args['autoplay'] = true;
      slider_args['autoplaySpeed'] = autoplay_speed;
      slider_args['speed'] = transition_speed;
    }

    $slider.slick(slider_args);

  });

  /* POSTS GRID ------------------------------------------------- */
  $('.posts-block').each(function() {

    // Declare variables
    $container = $(this);
    $filter = $('.post-list-filtering', $container);
    $category_filter = $('select[name="filter-category"]', $filter);
    $text_search = $('input[name="filter-text"]', $filter);

    $text_search.on('focus', function() {
      if ($(this).val() == 'Search by keyword...') {
        $(this).val('');
      }
    });

    $text_search.on('blur', function() {
      if ($(this).val() == '') {
        $(this).val('Search by keyword...');
      }
    });

    $filter.on('submit', function() {
      if ($text_search.val() == 'Search by keyword...') {
        $text_search.val('');
      }
    });

    $category_filter.on('change', function() {
      $filter.submit();
    });

  });


  /* TEAM MEMBERS ----------------------------------------------- */
  $('.team-member > a.wrap').modaal({
    'background': '#000000',
    'overlay_opacity': 0.75,
    'custom_class': 'team-member-modal',
    'hide_close': true
  });
  $('.team-member-modal-content button.close-modal').on('click', function() {
    $('.team-member > a.wrap').modaal('close');
  });

});