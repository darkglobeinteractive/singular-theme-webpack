jQuery(document).ready(function($) {
  
  /* https://kenwheeler.github.io/slick/ */
  /* https://accessible360.github.io/accessible-slick/ */
  /* Note: If autoplay is set to true, a play/pause button is added by default for accessibility reasons. You can hide this by setting useAutoplayToggleButton to false, but this creates an accessibility issue in itself. */

  /* See /blocks/blocks.js for examples used with the multi-slider block which contains some more advanced functionality */
  

  /* STANDARD EXAMPLE ------------------------------------------- */
  /* Includes responsive breakpoints and custom SVG arrows */
  $('.slick-slider').slick({
    arrows: true,
    dots: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    speed: 5000,
    nextArrow: `<button class="svg-icon arrow-button arrow-button-right slick-next">
    <svg data-name="Arrow Button Right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 66 66" role="img" aria-label="Arrow Right Icon">
    <title>Arrow Button Left</title>
    <path class="arrow" d="M30.03,19.8c-.5-.48-1.15-.72-1.81-.72s-1.3.24-1.8.71c-1,.95-1,2.5,0,3.45l10.44,10.07-10.44,10.07c-.99.96-.99,2.5,0,3.45s2.61.94,3.61,0l14.01-13.51s-14.01-13.51-14.01-13.51Z"/>
    <path class="ring" d="M33,66C14.81,66,0,51.2,0,33S14.8,0,33,0s33,14.8,33,33-14.8,33-33,33ZM33,2.48C16.17,2.48,2.48,16.17,2.48,33s13.69,30.52,30.52,30.52,30.52-13.69,30.52-30.52S49.83,2.48,33,2.48Z"/>
    </svg>
    </button>`,
    prevArrow: `<button class="svg-icon arrow-button arrow-button-left slick-prev">
    <svg data-name="Arrow Button Left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 66 66" role="img" aria-label="Arrow Left Icon">
    <title>Arrow Button Left</title>
    <path class="arrow" d="M39.45,43.39l-10.44-10.07,10.44-10.07c.99-.96.99-2.5,0-3.45s-2.61-.94-3.61,0l-14.01,13.51,14.01,13.51c.5.48,1.15.72,1.81.72s1.3-.24,1.8-.71c1-.95,1-2.5,0-3.45Z"/>
    <path class="ring" d="M33,66C14.81,66,0,51.2,0,33S14.8,0,33,0s33,14.8,33,33-14.8,33-33,33ZM33,2.49C16.17,2.49,2.48,16.18,2.48,33.01s13.69,30.52,30.52,30.52,30.52-13.69,30.52-30.52S49.83,2.49,33,2.49Z"/>
    </svg>
    </button>`,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 600,
        settings: {
          arrows: false,
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });


  /* CENTERMODE EXAMPLE ----------------------------------------- */
  /* Notes: Slides to show should always be odd and centerPadding is how much of the prev/next slides are shown */
  $('.slick-slider').slick({
    arrows: true,
    dots: false,
    infinite: true,
    centerMode: true,
    centerPadding: '200px',
    slidesToShow: 1
  });

  /* CSS: To make the center slide taller than the surrounding ones */
  /*
  .slick-slide {
    transform: scale(0.9);
  }
  .slick-slide.slick-center {
    transform: scale(1);
  }
  */


  /* PARTIAL RIGHT-ALIGNED SLIDE -------------------------------- */
  /* Notes: This will show 150px of a partial slide off to the right */
  $('.slick-slider').slick({
    arrows: false,
    dots: true,
    infinite: false,
    centerMode: false,
    slidesToShow: 3
  });
  
  /* CSS: Note the 150px padding on the right is what reveals the partial next slide */
  /*
  .slick-list {
    padding: 0 150px 0 0 !important;
  }
  */

});