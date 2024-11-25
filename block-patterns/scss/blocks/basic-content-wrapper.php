<?php
function singular_register_bps_basic_content_wrapper() {

  register_block_pattern(
    'singular-plugin/base-wrapper',
    array(
      'title'       => 'Basic Content Wrapper',
      'categories'  => array( 'singular-all', 'singular-blocks' ),
      'keywords'    => array( 'wrapper' ),
      'description' => 'A blank block including the required padding and margins.',
      'content'     => "<!-- wp:group -->
      <div class=\"wp-block-group wp-block-singular\"></div>
      <!-- /wp:group -->"
    )
  );

}
add_action( 'init', 'singular_register_bps_basic_content_wrapper' );
?>