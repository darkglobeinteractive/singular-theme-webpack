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

// Enqueue styles on front end
function singular_custom_block_styles() {
  wp_enqueue_style( 'color-block-cta-css', get_template_directory_uri().'/blocks/color-block-cta/color-block-cta.css', array(), singular_theme_filemtime( '/blocks/color-block-cta/color-block-cta.css' ) );
  wp_enqueue_style( 'image-cta-css', get_template_directory_uri().'/blocks/image-cta/image-cta.css', array(), singular_theme_filemtime( '/blocks/image-cta/image-cta.css' ) );
  wp_enqueue_style( 'multi-slider-css', get_template_directory_uri().'/blocks/multi-slider/multi-slider.css', array(), singular_theme_filemtime( '/blocks/multi-slider/multi-slider.css' ) );
  wp_enqueue_style( 'testimonial-css', get_template_directory_uri().'/blocks/testimonial/testimonial.css', array(), singular_theme_filemtime( '/blocks/testimonial/testimonial.css' ) );
  wp_enqueue_script( 'custom-blocks-js', get_template_directory_uri().'/blocks/blocks.js', array( 'jquery' ), singular_theme_filemtime('/blocks/blocks.js' ) );
}
add_action( 'wp_enqueue_scripts', 'singular_custom_block_styles' );

// Enqueue styles in admin
function singular_custom_block_admin_styles() {
  wp_enqueue_style( 'color-block-cta-admin-css', get_template_directory_uri().'/blocks/color-block-cta/color-block-cta.css', array(), singular_theme_filemtime( '/blocks/color-block-cta/color-block-cta.css' ) );
  wp_enqueue_style( 'multi-slider-admin-css', get_template_directory_uri().'/blocks/multi-slider/multi-slider.css', array(), singular_theme_filemtime( '/blocks/multi-slider/multi-slider.css' ) );
  wp_enqueue_style( 'image-cta-admin-css', get_template_directory_uri().'/blocks/image-cta/image-cta.css', array(), singular_theme_filemtime( '/blocks/image-cta/image-cta.css' ) );
  wp_enqueue_style( 'testimonial-admin-css', get_template_directory_uri().'/blocks/testimonial/testimonial.css', array(), singular_theme_filemtime( '/blocks/testimonial/testimonial.css' ) );
}
add_action( 'admin_enqueue_scripts', 'singular_custom_block_admin_styles' );
?>