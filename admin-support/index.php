<?php
/* CREATE ADMIN MENU STRUCTURE ---------------------------------- */
function singular_support_menu() {
	add_menu_page( 
    'Site Support', // Page title
    'Site Support', // Title in menu bar
    'manage_options', // Capability required to access menu
    'sts-support', // Menu slug
    'singular_support_home', // Function handling content of page
    'dashicons-info', // Icon to use in admin sidebar
    100
  );
  add_submenu_page(
    'sts-support',
    'Site Support',
    'Home',
    'manage_options',
    'sts-support'
  );
  add_submenu_page(
    'sts-support',
    'Webpack Theme Configuration',
    'Webpack Config',
    'manage_options',
    'sts-webpack',
    'singular_support_webpack'
  );
  // add_submenu_page(
  //   'sts-support',
  //   'Theme Technical Notes',
  //   'Technical Notes',
  //   'manage_options',
  //   'sts-tech-notes',
  //   'singular_support_technical_notes'
  // );
  // add_submenu_page(
  //   'sts-support',
  //   'Site Support Sub-Page',
  //   'Site Support Sub-Page',
  //   'manage_options',
  //   'sts-sub-page',
  //   'singular_support_sub_page'
  // );
}
add_action( 'admin_menu', 'singular_support_menu' );


/* CREATE PAGE CONTENT ------------------------------------------ */
function singular_support_home() { 
  include( 'pages/home.php' );
} 
function singular_support_webpack() {
  include( 'pages/webpack.php' );
}
function singular_support_technical_notes() {
  include( 'pages/technical-notes.php' );
}
function singular_support_sub_page() {
  include( 'pages/sub-page.php' );
} 
?>