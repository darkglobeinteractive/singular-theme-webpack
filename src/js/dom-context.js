/*
DOM CONTEXT HELPER --------------------------------------------------
Shared by any script (in this theme or others) that needs to select
and manipulate block markup that must work both on the front end and
inside the block editor.

On the front end, block markup lives in the normal `document`. In the
block editor, it renders inside the editor canvas iframe(s)
(`iframe[name="editor-canvas"]`) instead -- a separate document that
`$(document)`-scoped selectors never reach, and one that gets
replaced/re-rendered by React whenever blocks are added, moved, or
edited.

`SingularDOM.forEachContext(callback)` hides that difference: it calls
`callback(root_document)` once for the front end, or, in the editor,
waits for each canvas iframe to be ready and calls `callback` with
that iframe's document -- then again on every re-render.

Usage in a block script:

  jQuery(document).ready(function($) {
    SingularDOM.forEachContext(function(root) {

      var $root = $(root);

      $('.my-block', $root).each(function() {

        var $container = $(this);

        // Required: guard against re-init, since the editor branch can
        // re-run this callback against the same, already-processed
        // elements whenever anything else on the canvas changes.
        if ($container.data('si-initialized')) {
          return;
        }
        $container.data('si-initialized', true);

        // ... normal block behavior here ...

      });

    });
  });

This file has no build-time dependencies (no import/export) so it can
be dropped into any theme's `src/js/` folder as-is -- just add it to
the relevant webpack entry array(s) *before* any script that calls
`SingularDOM.forEachContext`.
*/
(function(window, document) {

  var CANVAS_IFRAME_SELECTOR = 'iframe[name="editor-canvas"]';

  // Waits for a specific iframe's document to be ready, then invokes
  // `callback` with that document -- once immediately, and again every
  // time the canvas content changes (throttled).
  function watch_iframe(iframe_el, callback, throttle_ms) {

    var ready_interval = setInterval(function() {

      var iframe_doc = iframe_el.contentDocument || (iframe_el.contentWindow && iframe_el.contentWindow.document);

      if (iframe_doc && iframe_doc.body) {

        clearInterval(ready_interval);

        callback(iframe_doc);

        var last_run = 0;

        new MutationObserver(function() {

          var now = Date.now();

          if (now - last_run < throttle_ms) {
            return;
          }

          last_run = now;
          callback(iframe_doc);

        }).observe(iframe_doc.body, { childList: true, subtree: true });

      }

    }, 200);

  }

  function forEachContext(callback, throttle_ms) {

    throttle_ms = throttle_ms || 500;

    // Run once against the top-level document immediately. On the front end
    // this is the only context that ever exists. In the block editor it's a
    // harmless no-op here, since block markup lives inside the canvas
    // iframe, not in this document.
    callback(document);

    // The canvas iframe only ever exists in wp-admin, so skip watching for
    // it entirely on the front end -- no need to pay for a body-wide
    // MutationObserver there. WordPress always sets this body class
    // server-side, so unlike the iframe itself there's no mount-timing race
    // to worry about here.
    if (!document.body.classList.contains('wp-admin')) {
      return;
    }

    // The canvas iframe doesn't exist yet at this point in the block editor
    // -- React mounts it asynchronously, well after document.ready fires --
    // so watch for it rather than checking once and giving up. This also
    // picks up iframes that get remounted later (e.g. switching between the
    // visual and code editor).
    var handled_iframes = [];

    function maybe_watch(iframe_el) {

      if (handled_iframes.indexOf(iframe_el) !== -1) {
        return;
      }
      handled_iframes.push(iframe_el);

      watch_iframe(iframe_el, callback, throttle_ms);

    }

    Array.prototype.forEach.call(document.querySelectorAll(CANVAS_IFRAME_SELECTOR), maybe_watch);

    new MutationObserver(function() {
      Array.prototype.forEach.call(document.querySelectorAll(CANVAS_IFRAME_SELECTOR), maybe_watch);
    }).observe(document.body, { childList: true, subtree: true });

  }

  window.SingularDOM = window.SingularDOM || {};
  window.SingularDOM.forEachContext = forEachContext;

})(window, document);
