<?php
function singular_register_bps_accordion() {

  register_block_pattern(
    'singular-plugin/accordion',
    array(
      'title'       => 'Accordion',
      'categories'  => array( 'singular-all', 'singular-blocks' ),
      'keywords'    => array( 'accordion' ),
      'description' => 'Use this pattern to create an accordion section',
      'content'     => "<!-- wp:group {\"className\":\"wp-block-singular accordion-container\",\"layout\":{\"type\":\"constrained\"}} -->
      <div class=\"wp-block-group wp-block-singular accordion-container\"><!-- wp:group {\"className\":\"accordion-item\",\"layout\":{\"type\":\"constrained\"}} -->
      <div class=\"wp-block-group accordion-item\"><!-- wp:group {\"className\":\"accordion-item-title\",\"layout\":{\"type\":\"constrained\"}} -->
      <div class=\"wp-block-group accordion-item-title\"><!-- wp:heading {\"level\":3,\"className\":\"title\"} -->
      <h3 class=\"wp-block-heading title\">ACCORDION ITEM TITLE</h3>
      <!-- /wp:heading --></div>
      <!-- /wp:group -->

      <!-- wp:group {\"className\":\"accordion-item-content\",\"layout\":{\"type\":\"constrained\"}} -->
      <div class=\"wp-block-group accordion-item-content\"><!-- wp:paragraph -->
      <p>Curabitur magna turpis, tincidunt a diam et, dignissim consequat quam. Ut sit amet magna accumsan, malesuada elit eget, blandit ipsum. Praesent sed metus eu sem fringilla scelerisque quis id dui. Sed pulvinar maximus semper. Donec sodales, dolor vel consectetur lobortis, dui elit imperdiet ipsum, nec elementum arcu nulla nec ex. Praesent mi turpis, interdum vel ornare et, egestas quis tellus. Nulla rutrum tincidunt eros a placerat. Donec viverra massa eget odio faucibus, laoreet sollicitudin felis vulputate. Proin tincidunt fermentum sem, eu luctus massa varius et.</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:group --></div>
      <!-- /wp:group --></div>
      <!-- /wp:group -->"
      )
    );
  
  }
  add_action( 'init', 'singular_register_bps_accordion' );
  ?>