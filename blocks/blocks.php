<?php
// Register the custom block categories
function singular_register_block_category( $cats ) {
  array_unshift( $cats, array(
    'slug' => 'client-blocks',
    'title' => '[CLIENT] Blocks'
  ) );
  return $cats;
}
add_filter( 'block_categories_all', 'singular_register_block_category' );

// Register the actual custom blocks
function singular_register_acf_blocks() {
	register_block_type( __DIR__ .'/color-block-cta' );
  register_block_type( __DIR__ .'/image-cta' );  
  register_block_type( __DIR__ .'/multi-slider' );
  register_block_type( __DIR__ .'/posts-block' );
  register_block_type( __DIR__ .'/testimonial' );  
}
add_action( 'init', 'singular_register_acf_blocks' );
?>