document.addEventListener('DOMContentLoaded', function() {

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

  // SLIDE UP: Slide-in from below
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
  if (document.querySelectorAll('.im-animate.fade-in').length > 0) {
    gsap.fromTo('.im-animate.fade-in', {
      opacity: 0,
    },{
      opacity: 1,
      duration: 1,
      ease: 'power2.out'
    });
  }

  if (document.querySelectorAll('.im-animate.stagger-fade').length > 0) {
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
  document.querySelectorAll('.st-animate.fade-in').forEach(function(el) {
    gsap.effects.fadeIn(el);
  });

  document.querySelectorAll('.st-animate.slide-right').forEach(function(el) {
    gsap.effects.slideRight(el);
  });

  document.querySelectorAll('.st-animate.slide-up').forEach(function(el) {
    gsap.effects.slideUp(el);
  });


  /* DEFINE GLOBAL/STANDARD BLOCKS AND SITUATIONS --------------- */

  // Generate an array of classes to omit from the global .wp-block-singular animation below
  const blockExclusions = ['.accordion-container', '.color-block-cta-columns', '.image-cta-columns', '.testimonial-block'];

  // global basic content blocks
  document.querySelectorAll(`.wp-block-singular:not(${blockExclusions.join(', ')})`).forEach(function(el) {
    el.querySelectorAll(':scope > .wp-block-group__inner-container').forEach(function(inner) {
      gsap.effects.fadeIn(inner);
      gsap.effects.slideUp(inner);
    });
  });

  // accordions
  document.querySelectorAll('.wp-block-singular.accordion-container').forEach(function(el) {
    gsap.effects.staggerFade(el.querySelectorAll('.accordion-item'), { duration: 0.5, stagger: 0.2 });
  });

  // article items
  gsap.effects.staggerFade(document.querySelectorAll('article.item'));

  // footer
  document.querySelectorAll('#footer').forEach(function(el) {
    gsap.effects.staggerFade(el.querySelectorAll(':scope > .wrap'));
  });

  // rich banner
  document.querySelectorAll('.banner-rich').forEach(function(el) {
    gsap.effects.staggerFadeSlide(el.querySelectorAll('.content-wrap > *'));
  });

  // search results
  document.querySelectorAll('#search-results').forEach(function(el) {
    gsap.effects.staggerFade(el.querySelectorAll('.search-result'));
  });

  // simple banner
  document.querySelectorAll('.banner').forEach(function(el) {
    gsap.effects.staggerFadeSlide(el.querySelectorAll('.content > *'));
  });


  /* DEFINE CUSTOM/UNIQUE BLOCKS AND SITUATIONS ----------------- */

  // color block cta columns
  document.querySelectorAll('.wp-block-singular.color-block-cta-columns').forEach(function(el) {
    gsap.effects.staggerFade(el.querySelectorAll('.wp-block-columns .wp-block-column'));
  });

  // image cta columns
  document.querySelectorAll('.wp-block-singular.image-cta-columns').forEach(function(el) {
    gsap.effects.staggerFade(el.querySelectorAll('.wp-block-columns .wp-block-column'));
  });

  // team members grid
  document.querySelectorAll('.team-members-block').forEach(function(el) {
    gsap.effects.staggerFade(el.querySelectorAll('.team-member'));
  });

  // testimonials block
  document.querySelectorAll('.wp-block-singular.testimonial-block').forEach(function(el) {
    gsap.effects.staggerFadeSlide(el.querySelectorAll('.testimonial-section'));
  });

});
