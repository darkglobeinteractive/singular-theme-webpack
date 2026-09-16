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

  // Runs against the front-end document, or against each block-editor canvas
  // iframe's document (re-running on every canvas re-render) -- see
  // src/js/dom-context.js. Every block below is scoped to `$root` and guards
  // itself with a `si-initialized` flag so re-runs in the editor don't
  // double-append markup or double-bind event handlers.
  SingularDOM.forEachContext(function(root) {

    var $root = $(root);

    /* Put new code blocks here
    $('.block-element', $root).each(function() {

      // Declare variables
      var $container = $(this);

      // Determine initialization to prevent re-runs
      if ($container.data('si-initialized')) {
        return;
      }
      $container.data('si-initialized', true);
    
  
    });
    */

  });

});
