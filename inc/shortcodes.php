<?php
/* SHORTCODES --------------------------------------------------- */

/* custom shortcode example */
/*
  [appointment_cta heading='true']
*/
function cst_custom_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'heading' => 'true'
  ), $atts );
  $return_value = '<div class="appointment-cta">';
  $return_value .= ( $a['heading'] == 'true' ? '<div class="heading">Take the Next Step to Replace Your Missing Teeth Today!</div>' : '' );
  $return_value .= '<div class="appointment-content"><span class="f-icon-calendar-2"></span><span class="copy">Fill out our <a href="/meet-us/request-appointment/">Appointment Form</a> or call us at 973-538-5338 if you have any questions or to schedule an appointment with <a href="/meet-us/our-doctors/">Dr. Fang</a> today!</span></div>';
  $return_value .= '</div>';
  return $return_value;
}
add_shortcode( 'appointment_cta', 'cst_custom_shortcode' );


/* query-based shortcode example */
/*
  In this example, using id='145' will return a specific post, otherwise it's random
  [testimonial_cta id='145']
*/
function cts_query_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'id' => false
  ), $atts );
  $test_args = array(
    'post_type' => 'testimonials',
    'orderby' => 'rand',
    'posts_per_page' => '1'
  );
  // If the id parameter was set, display a specific testimonial
  if ( $a['id'] ) {
    $test_args['p'] = $a['id'];
  }

  $test_query = new WP_Query( $test_args );

  $return_value = '<div class="testimonial-cta blank">Blank</div>';

  if ( $test_query->have_posts() ) : while ( $test_query->have_posts() ) : $test_query->the_post();

    $testimonial_image = get_field( 'testimonial_author_image' );
    $return_value = '<div class="testimonial-cta';
    $return_value .= ( $testimonial_image ? '' : ' no-image' );
    $return_value .= '">
    <div class="wrap">';
    if ( $testimonial_image ) {
      $return_value .= '<div class="image"><img src="' . $testimonial_image . '" /></div>';
    }
    $return_value .= '<div class="copy">
    <div class="title">';
    $return_value .= get_the_title();
    $return_value .= '</div>
      <div class="blurb">"' . get_the_content() . '"</div>
    </div>
    </div>
    </div>';

  endwhile; endif;

  wp_reset_postdata();

  return $return_value;
}
add_shortcode( 'testimonial_cta', 'cts_query_shortcode' );

?>
