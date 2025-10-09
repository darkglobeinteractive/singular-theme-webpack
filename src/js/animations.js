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
            start: config.start,
            trigger: targets
          },
          delay: config.delay,
          duration: config.duration,
          ease: config.ease,
          opacity: 1
        }
      )
    },
    defaults: {
      delay: 0,
      duration: 1,
      ease: 'power2.out',
      start: 'top 95%'
    }
  });

  // SLIDE RIGHT: Slide-in from the right
  gsap.registerEffect({
    name: 'slideRight',
    effect: (targets, config) => {
      return gsap.fromTo(
        targets,
        {
          x: config.xstart
        },
        {
          scrollTrigger: {
            start: config.start,
            trigger: targets
          },
          delay: config.delay,
          duration: config.duration,
          ease: config.ease,
          x: 'auto'
        }
      )
    },
    defaults: {
      delay: 0,
      duration: 1,
      ease: 'power2.out',
      start: 'top 95%',
      xstart: '-50px'
    }
  });

  // SLIDE RIGHT: Slide-in from the right
  gsap.registerEffect({
    name: 'slideUp',
    effect: (targets, config) => {
      return gsap.fromTo(
        targets,
        {
          y: config.ystart
        },
        {
          scrollTrigger: {
            start: config.start,
            trigger: targets
          },
          delay: config.delay,
          duration: config.duration,
          ease: config.ease,
          y: 'auto'
        }
      )
    },
    defaults: {
      delay: 0,
      duration: 1,
      ease: 'power2.out',
      start: 'top 95%',
      ystart: '-50px'
    }
  });

  // STAGGER FADE: Each item in a set fades-in at a staggered rate
  gsap.registerEffect({
    name: 'staggerFade',
    effect: (targets, config) => {
      return gsap.fromTo(
        targets,
        {
          opacity: 0
        },
        {
          scrollTrigger: {
            start: config.start,
            trigger: targets
          },
          delay: config.delay,
          duration: config.duration,
          ease: config.ease,
          opacity: 1,
          stagger: config.stagger
        }
      )
    },
    defaults: {
      delay: 0,
      duration: 1,
      ease: 'power2.out',
      stagger: 0.3,
      start: 'top 90%'
    }
  });

  // STAGGER FADE SLIDE: Each item in a set fades-in at a staggered rate and slides in from right
  gsap.registerEffect({
    name: 'staggerFadeSlide',
    effect: (targets, config) => {
      return gsap.fromTo(
        targets,
        {
          left: config.leftstart,
          opacity: 0
        },
        {
          scrollTrigger: {
            start: config.start,
            trigger: targets
          },
          delay: config.delay,
          duration: config.duration,
          ease: config.ease,
          left: 'auto',
          opacity: 1,
          stagger: config.stagger
        }
      )
    },
    defaults: {
      delay: 0,
      duration: 1,
      ease: 'power2.out',
      leftstart: '-30px',
      stagger: 0.3,
      start: 'top 90%'
    }
  });


  /* DIRECT IMMEDIATE ANIMATIONS -------------------------------- */
  if ($('.im-animate.fade-in').length > 0) {
    gsap.fromTo('.im-animate.fade-in', {
      opacity: 0,
    },{
      opacity: 1,
      duration: 1,
      ease: 'power2.out'
    });
  }

  if($('.im-animate.stagger-fade').length > 0) {
    gsap.fromTo('.im-animate.stagger-fade', {
      opacity: 0
    },{
      opacity: 1,
      duration: 0.5,
      stagger: 0.2,
      ease: 'power2.out'
    });
  }


  /* DEFINE CSS SELECTORS --------------------------------------- */
  $('.st-animate.fade-in').each(function() {
    gsap.effects.fadeIn($(this));
  });

  $('.st-animate.slide-right').each(function() {
    gsap.effects.slideRight($(this));
  });

  $('.st-animate.slide-up').each(function() {
    gsap.effects.slideUp($(this));
  });


  /* DEFINE GLOBAL/STANDARD BLOCKS AND SITUATIONS --------------- */

  // global basic content blocks
  $('.wp-block-singular').not('.accordion-container,.color-block-cta-columns,.image-cta-columns,.testimonial-block').each(function() {
    $('> .wp-block-group__inner-container', this).each(function() {
      gsap.effects.fadeIn($(this));
      gsap.effects.slideUp($(this));
    });
  });
  
  // accordions
  $('.wp-block-singular.accordion-container').each(function() {
    gsap.effects.staggerFade('.wp-block-singular.accordion-container .accordion-item', { duration: 0.5, stagger: 0.2 });
  });
  
  // article items
  $('article.item').each(function() {
    gsap.effects.staggerFade('article.item');
  });

  // footer
  $('#footer').each(function() {
    gsap.effects.staggerFade('#footer > .wrap');
  });

  // rich banner
  $('.banner-rich').each(function() {
    gsap.effects.staggerFadeSlide('.banner-rich .content-wrap > *');
  });

  // search results
  $('#search-results').each(function() {
    gsap.effects.staggerFade('#search-results .search-result');
  });

  // simple banner
  $('.banner').each(function() {
    gsap.effects.staggerFadeSlide('.banner .content > *');
  });


  /* DEFINE CUSTOM/UNIQUE BLOCKS AND SITUATIONS ----------------- */

  // color block cta columns
  $('.wp-block-singular.color-block-cta-columns').each(function() {
    gsap.effects.staggerFade('.wp-block-singular.color-block-cta-columns .wp-block-columns .wp-block-column');
  });  

  // image cta columns
  $('.wp-block-singular.image-cta-columns').each(function() {
    gsap.effects.staggerFade('.wp-block-singular.image-cta-columns .wp-block-columns .wp-block-column');
  });  

  // team members grid
  $('.team-members-block').each(function() {
    gsap.effects.staggerFade('.team-members-block .team-member');
  });

  // testimonials block
  $('.wp-block-singular.testimonial-block').each(function() {
    gsap.effects.staggerFadeSlide('.testimonial-section', this);
  });

});
