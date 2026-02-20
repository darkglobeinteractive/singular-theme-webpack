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


  /* HEADER ON SCROLL ------------------------------------------- */
  /* NOTE: If header dimensions change, use a fixed header, not a sticky header
  $(window).on('scroll', st_throttle(500, function() {

    var window_scroll_top = $(window).scrollTop();

    if ($(window).innerWidth() > 1000) {

      if (window_scroll_top > 150) {
        $('body').addClass('scrolled-header');
      } else {
        $('body').removeClass('scrolled-header');
      }

    } 

  }));  
  */

  /* MODAAL FUNCTIONALITY --------------------------------------- */

  // For text/image columns with a video button
  $('a.modaal-video').modaal({
    type: 'video'
  });


  /* NAVIGATION ------------------------------------------------- */
  $('#navigation').each(function() {

    // Create variable for container element
    var $navigation = $(this);

    // Handle no-link menu items
    $('> ul.menu', $navigation).each(function() {

      // Create variable for the main navigation menu
      var $menu = $(this);

      // Handle items with no-link
      $('li.no-link', $menu).each(function() {

        // Create variable to contain the text of the item
        var element_text = $('> a', this).text();

        $('> a', this).detach();
        $(this).removeClass('no-link').prepend('<span class="no-link">'+element_text+'</span>');

      });

    });

    // Configure the mobile menu
    var mmenu = new Mmenu( '#navigation', {
      'offCanvas': {
        'position': 'right-front'
      },
      'navbar': false,
      'navbars': [
        {
          'use': true,
          'position': 'top',
          'content': [
            'prev',
            'title',
            'close'
          ]
        }
      ]
    },{
      'offCanvas': {
        'clone': true
      }
    });

    // Utilize mmenu API to use independent mobile menu trigger
    var mmenu_api = mmenu.API;
    $('#mm-trigger').on('click', function() {
      if ($('body').hasClass('mm-wrapper--opened')) {
        mmenu_api.close();
      } else {
        mmenu_api.open();
      }
    });

  });


  /* SEARCH FORM FUNCTIONALITY ---------------------------------- */
  $('.search-form').each(function() {

    // Declare variables
    var $search_form = $(this);
    var $search_input = $('input[type="text"]', $search_form);
    var $search_submit = $('button[type="submit"]', $search_form);
    var placeholder_text = 'Enter your search term';

    // Set default placeholder appearance of input field
    if ($search_input.val() == '') {
      $search_input.val(placeholder_text);
    }
    
    // Handle focusing and blur of the field
    $search_input.on('focus', function() {

      if ($(this).val() == placeholder_text) {
        $(this).val('');
      }

    }).on('blur', function() {

      if ($(this).val() == '') {
        $(this).val(placeholder_text);
      }
      
    });

    // Handle submit, preventing it if the placeholder is still in-place
    $search_form.on('submit', function(e) {
      if ($search_input.val() == placeholder_text) {
        e.preventDefault();
      }
    });

  });


  /* SMOOTH SCROLLING ------------------------------------------- */
  $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[href*="#modal"]').click(function(t){
    
    // Set variable determining if this is a keyboard click or a mouse click
    var event_type = t.originalEvent.detail;

    if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){

    var e = $(this.hash);

    // Determine the heights of possible elements on the page to take into consideration
    var header_height = 0; 
    // header_height = $('#header').innerHeight(); // Fixed headers need to be taken into consideration

    var wpadminbar_height = ($('#wpadminbar').length > 0 ? $('#wpadminbar').innerHeight() : 0); // Height of WordPress admin bar
    var scroll_top_padding = 20; // Extra padding

    // Calculate the final offset for scrolling by removing the height of the items above (and some padding) from the total offset height
    var e_offset_top = e.offset().top - (header_height + wpadminbar_height + scroll_top_padding);

  (e=e.length?e:$("[name="+this.hash.slice(1)+"]")).length&&(t.preventDefault(),$("html, body").animate({
    scrollTop:e_offset_top
  },1e3,function(){
    var t=$(e);

    // If this is a standard mouse click, set focusVisible to false
    if (event_type == 1) {
      if(t.focus({ focusVisible: false }),t.is(":focus"))return!1;
      t.attr("tabindex","-1"),t.focus({ focusVisible: false })
    } else {
      if(t.focus(),t.is(":focus"))return!1;
      t.attr("tabindex","-1"),t.focus()
    }
  }))}});

});
