jQuery(document).ready(function($) {

  // Global function that works with dynamically generated content on the page
  function applyWhenElementExists(selector, myFunction, intervalTime) {
    var interval = setInterval(function() {
      if (jQuery(selector).length > 0) {
        myFunction();
        clearInterval(interval);
      }
    }, intervalTime);
  }

  // Visually swap submit <input /> for a <button>, without detaching the
  // original input from the DOM — Ninja Forms binds its submit handler
  // directly to that element, so replaceWith() breaks it. Only acts on
  // inputs that are still visible, so it's safe to call repeatedly.
  function convertSubmitButtons($nf_form) {
    $('input[type="submit"]:visible', $nf_form).each(function() {
      var $original_input = $(this);
      var submit_button = $('<button></button>').attr('type', 'button').attr('class', ' btn active').html($original_input.val());

      $original_input.hide();
      $original_input.after(submit_button);

      submit_button.on('click', function(e) {
        e.preventDefault();
        $original_input.trigger('click');
      });
    });
  }

  // Replaces input field submit buttons with button fields
  applyWhenElementExists('.nf-form-cont', function() {

    $('.nf-form-cont').each(function() {
      
      var $nf_form = $(this);

      convertSubmitButtons($nf_form);

      // Ninja Forms re-renders the submit field after a failed validation
      // attempt, which wipes out the injected <button> and restores a
      // fresh native <input>. Watch for that and reapply the swap.
      var observer = new MutationObserver(function() {
        convertSubmitButtons($nf_form);
      });
      observer.observe($nf_form.get(0), { childList: true, subtree: true });

    });

  }, 1000);

});