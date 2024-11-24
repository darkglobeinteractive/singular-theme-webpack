<?php
function singular_register_bps_custom_list() {

  register_block_pattern(
    'singular-plugin/custom-list',
    array(
      'title'       => 'Custom Bulleted List',
      'categories'  => array( 'singular-all', 'singular-elements' ),
      'keywords'    => array( 'list' ),
      'description' => 'Creates an unordered list with custom bullets.',
      'content'     => "<!-- wp:list {\"className\":\"custom-list\"} -->
      <ul class=\"custom-list\"><!-- wp:list-item -->
      <li>Smaller text style that uses a custom css class.<br></li>
      <!-- /wp:list-item -->
      
      <!-- wp:list-item -->
      <li>Enim ad minim veniam quis nostrud exercitation.<br></li>
      <!-- /wp:list-item -->
      
      <!-- wp:list-item -->
      <li>Ullamco laboris nisi ut aliquip ex ea commodo consequat.<br></li>
      <!-- /wp:list-item -->
      
      <!-- wp:list-item -->
      <li>Duis aute irure dolor in reprehenderit in voluptate velit.</li>
      <!-- /wp:list-item --></ul>
      <!-- /wp:list -->"
    )
  );

}
add_action( 'init', 'singular_register_bps_custom_list' );
?>