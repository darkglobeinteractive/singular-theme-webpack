<?php
/* REMOVE CORE BLOCK PATTERNS ----------------------------------- */
remove_theme_support( 'core-block-patterns' );


/* REGISTER THE PATTERN CATEGORIES ------------------------------ */
function singular_bps_register_categories() {

  register_block_pattern_category(
    'singular-all',
    array(
      'label' => '[CLIENT] Patterns'
    )
  );

}
add_action( 'init', 'singular_bps_register_categories' );


/* ENQUEUE SCRIPTS ---------------------------------------------- */
function singular_bps_enqueue_styles() {
  wp_enqueue_style( 'bps-base-css', get_template_directory_uri().'/block-patterns/block-patterns.css', array(), singular_theme_filemtime('/block-patterns/block-patterns.css' ) );
  wp_enqueue_style( 'bps-accordion-css', get_template_directory_uri().'/block-patterns/blocks/accordion.css', array(), singular_theme_filemtime('/block-patterns/blocks/accordion.css' ) );
  wp_enqueue_style( 'bps-basic-content-wrapper-css', get_template_directory_uri().'/block-patterns/blocks/basic-content-wrapper.css', array(), singular_theme_filemtime('/block-patterns/blocks/basic-content-wrapper.css' ) );
  wp_enqueue_style( 'bps-frontend-css', get_template_directory_uri().'/block-patterns/block-patterns-frontend.css', array(), singular_theme_filemtime('/block-patterns/block-patterns-frontend.css' ) );
  wp_enqueue_script( 'bps-base-js', get_template_directory_uri().'/block-patterns/block-patterns.js', array( 'jquery' ), singular_theme_filemtime('/block-patterns/block-patterns.js' ) );
}
add_action( 'wp_enqueue_scripts', 'singular_bps_enqueue_styles' );

function singular_bps_enqueue_admin_styles() {
  wp_enqueue_style( 'bps-base-admin-css', get_template_directory_uri().'/block-patterns/block-patterns.css', array(), singular_theme_filemtime('/block-patterns/block-patterns.css' ) );
  wp_enqueue_style( 'bps-basic-content-wrapper-admin-css', get_template_directory_uri().'/block-patterns/blocks/basic-content-wrapper.css', array(), singular_theme_filemtime('/block-patterns/blocks/basic-content-wrapper.css' ) );
  wp_enqueue_style( 'bps-admin-overrides-css', get_template_directory_uri().'/block-patterns/block-patterns-admin.css', array(), singular_theme_filemtime('/block-patterns/block-patterns-admin.css' ) );
}
add_action( 'admin_enqueue_scripts', 'singular_bps_enqueue_admin_styles' );
?>