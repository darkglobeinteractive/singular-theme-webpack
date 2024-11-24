<?php
// https://www.wpbeginner.com/wp-tutorials/how-to-completely-disable-comments-in-wordpress/
function singular_remove_comments_admin_init() {

  // Redirect any user trying to access comments page
  global $pagenow;
  if ( $pagenow === 'edit-comments.php' ) {
    wp_safe_redirect( admin_url() );
    exit;
  }

  // Remove comments metabox from dashboard
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

  // Disable support for comments and trackbacks in post types
  foreach ( get_post_types() as $post_type ) {
    if ( post_type_supports( $post_type, 'comments' ) ) {
      remove_post_type_support( $post_type, 'comments' );
      remove_post_type_support( $post_type, 'trackbacks' );
    }
  }

}
add_action( 'admin_init', 'singular_remove_comments_admin_init' );
 
// Close comments on the front-end
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
 
// Hide existing comments
add_filter( 'comments_array', '__return_empty_array', 10, 2 );
 
// Remove comments page in menu
function singular_remove_comments_admin_menu() {
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'singular_remove_comments_admin_menu' );
 
// Remove comments links from admin bar
function singular_remove_comments_init() {
  if ( is_admin_bar_showing() ) {
    remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
  }
}
add_action( 'init', 'singular_remove_comments_init' );

// https://www.isitwp.com/remove-comments-link-from-admin-bar/
// Remove comments icon from top admin bar
function singular_remove_comments_admin_bar() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'singular_remove_comments_admin_bar' );
?>