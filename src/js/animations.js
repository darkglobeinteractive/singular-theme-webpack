jQuery(document).ready(function($) {

  /* REGISTER EFFECTS ------------------------------------------- */

  // FADE IN: Opacity 0 -> 1
  gsap.registerEffect({
    name: 'fadeIn',
    effect: (targets, config) => {
      return gsap.fromTo(
        targets,
        {
          opacity: 0
        },
        {
          scrollTrigger: {
            trigger: targets,
            start: 'top 95%'
          },
          opacity: 1,
          duration: 1,
          ease: 'power2.out'
        }
      )
    }
  });

  // SLIDE RIGHT: Slide-in from the right
  gsap.registerEffect({
    name: 'slideRight',
    effect: (targets, config) => {
      return gsap.fromTo(
        targets,
        {
          x: '-50px'
        },
        {
          scrollTrigger: {
            trigger: targets,
            start: 'top 95%'
          },
          x: 'auto',
          duration: 1,
          ease: 'power2.out'
        }
      )
    }
  });


  /* DEFINE CSS SELECTORS --------------------------------------- */

  $('.st-animate.fade-in').each(function() {
    gsap.effects.fadeIn($(this));
  });

  $('.st-animate.slide-right').each(function() {
    gsap.effects.slideRight($(this));
  });

});
