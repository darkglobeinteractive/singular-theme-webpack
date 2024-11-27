<?php
/* INCLUDES ----------------------------------------------------- */
/* Un-comment the ones you'd like to use, each contains examples */
include( 'admin-support/index.php' );
// include( 'inc/remove-comments.php' );
// include( 'inc/wysiwyg-customizations.php' );
// include( 'inc/shortcodes.php' );
// include( 'inc/custom-post-columns' );
include( 'inc/singular-functions.php' );
include( 'block-patterns/block-patterns.php' );
include( 'blocks/blocks.php' );


/* ENABLE THEME SUPPORT ----------------------------------------- */
/* https://developer.wordpress.org/reference/functions/add_theme_support/ */
function singular_setup_theme_supported_features() {
  add_theme_support( 'menus' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'responsive-embeds' );
  add_theme_support( 'wp-block-styles' );
  add_image_size( 'banner-bg', 2560, 0, false );

  // Register navigation menus
  register_nav_menus( array(
    'main-menu-nav' => 'Main Menu Navigation'
  ) );

  // https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#block-color-palettes
  add_theme_support( 'editor-color-palette', array(
    array(
      'name'  => 'Primary',
      'slug'  => 'primary',
      'color' => '#0000ff'
    ),
    array(
      'name'  => 'Secondary',
      'slug'  => 'secondary',
      'color' => '#ff0000'
    ),
    array(
      'name'  => 'Black',
      'slug'  => 'black',
      'color' => '#000000'
    ),
    array(
      'name'  => 'White',
      'slug'  => 'white',
      'color' => '#ffffff'
    )
  ) );

  // https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#block-gradient-presets
  add_theme_support( 'editor-gradient-presets', array(
    array(
      'name'      => 'Left-to-Right: Light Green to Dark Green',
      'gradient'  => 'linear-gradient(90deg, rgba(104,189,73,1) 0%, rgba(0,111,81,1) 100%)',
      'slug'      => 'left-to-right-light-to-dark-green'
    ),
    array(
      'name'      => 'Angled: Light Green to Dark Green',
      'gradient'  => 'linear-gradient(132deg, rgba(104,189,73,1) 0%, rgba(0,111,81,1) 100%)',
      'slug'      => 'angled-light-to-dark-green'
    )
  ) );

}
add_action( 'after_setup_theme', 'singular_setup_theme_supported_features' );

/* ADD BANNER BG TO SRCSET -------------------------------------- */
function singular_banner_bg_max( $max_width, $size_array ) {
  return 2560;
}
add_filter( 'max_srcset_image_width', 'singular_banner_bg_max', 10, 2 );

/* FIX HEADER BUMP ---------------------------------------------- */
/* WordPress core adds top margin to html element by default -- incompatible with mmenu mobile menu library */
function singular_remove_admin_login_header() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'singular_remove_admin_login_header' );

/* GOOGLE FONTS ------------------------------------------------- */
function singular_add_google_fonts() {
  echo '<link rel="preconnect" href="//fonts.googleapis.com">
  <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
  <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="preload" as="style">
  <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">';
}
add_action( 'wp_head', 'singular_add_google_fonts' );

/* PUBLIC STYLES + SCRIPTS -------------------------------------- */
function singular_public_styles_scripts() {
  
  /* styles */
  // wp_enqueue_style( 'custom-fontastic-icons', 'https://file.myfontastic.com/U9FqFSWAktJNmqp9Dd93ZG/icons.css', false );
  // wp_enqueue_style( 'local-fontastic-icons', get_template_directory_uri().'/fonts/styles.css' );
  // wp_enqueue_style( 'custom-fonts-css', get_template_directory_uri().'/fonts/style.css', array(), singular_theme_filemtime('/fonts/style.css' ) );
  wp_enqueue_style( 'public-css', get_template_directory_uri().'/assets/public.css', array(), singular_theme_filemtime('/assets/public.css' ) );

  /* scripts */
  // wp_enqueue_script( 'gsap-js', get_template_directory_uri().'/libs/gsap/minified/gsap.min.js', array( 'jquery' ) );
  // wp_enqueue_script( 'gsap-scrolltrigger-js', get_template_directory_uri().'/libs/gsap/minified/ScrollTrigger.min.js', array( 'jquery' ) );
  // wp_enqueue_script( 'animations-js', get_template_directory_uri().'/js/animations.js', array( 'gsap-js', 'gsap-scrolltrigger-js' ), singular_theme_filemtime('/js/animations.js' ) );
  wp_enqueue_script( 'modaal-js', get_template_directory_uri().'/libs/modaal/dist/js/modaal.js', array( 'jquery' ) );
  wp_enqueue_script( 'slickjs-js', get_template_directory_uri().'/libs/accessible-slick/slick/slick.min.js', array( 'jquery' ) );
  wp_enqueue_script( 'mmenu-js', get_template_directory_uri().'/libs/mmenu/dist/mmenu.js', array( 'jquery' ) );
  wp_enqueue_script( 'public-js', get_template_directory_uri().'/assets/public.min.js', array( 'jquery', 'modaal-js', 'slickjs-js', 'mmenu-js' ), singular_theme_filemtime('/assets/public.min.js' ) );

}
add_action( 'wp_enqueue_scripts', 'singular_public_styles_scripts' );


/* ADMIN STYLES + SCRIPTS --------------------------------------- */
function singular_admin_styles() {
  wp_enqueue_style( 'admin-css', get_template_directory_uri().'/assets/admin.css', array(), singular_theme_filemtime('/assets/admin.css' ) );
  wp_enqueue_script( 'admin-js', get_template_directory_uri().'/assets/admin.min.js', array( 'jquery' ), singular_theme_filemtime('/assets/admin.min.js' ) );
}
add_action( 'admin_enqueue_scripts', 'singular_admin_styles' );


/* LOGIN PAGE UPDATES ------------------------------------------- */
function singular_login_css() {
  wp_enqueue_style( 'login-css', get_template_directory_uri() . '/css/login.css', array(), singular_theme_filemtime('/css/login.css' ) );
}
add_action( 'login_enqueue_scripts', 'singular_login_css' );

function singular_login_url() {
  return '/';
}
add_filter( 'login_headerurl', 'singular_login_url' );


/* GLOBALLY SHARED VARIABLES ------------------------------------ */
function singular_global_vars() {
  static $global_vars = NULL;
  if ( empty( $global_vars ) ) {
    $global_vars = array( 'queried_object' => get_queried_object() );
    $global_vars['qoc'] = ( is_object( $global_vars['queried_object'] ) ? true : false );
    $global_vars['qid'] = ( is_object( $global_vars['queried_object'] ) ? $global_vars['queried_object']->ID : false );
  }
  return $global_vars;
}
add_action( 'template_redirect', 'singular_global_vars' );


/* WP CORE CUSTOM FIELDS ---------------------------------------- */
/* Un-comment the following line if you need to use WordPress core "Custom Fields" */
/* The "Advanced Custom Themes" plugin hides the option by default */
// add_filter('acf/settings/remove_wp_meta_box', '__return_false');

?>
