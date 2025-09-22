jQuery(document).ready(function($) {

  // Replaces input field submit buttons with button fields
  applyWhenElementExists('.nf-form-cont', function() {

    $('.nf-form-cont').each(function() {
      
      var $nf_form = $(this);

      // Replace all submit <input /> with <button>
      $('input[type="submit"]', $nf_form).each(function() {
        var submit_button = $('<button></button>').attr('type', 'submit').attr('id', $(this).attr('id')).attr('class', ' btn active').html($(this).val());
        $(this).replaceWith(submit_button);
      });

    });

  }, 1000);

});