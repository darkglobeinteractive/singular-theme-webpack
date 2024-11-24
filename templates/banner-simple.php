<?php
// Grab global variables from custom function.php function
$gv = singular_global_vars();
$qo = $gv['queried_object'];

// Set default page title
$banner_title = get_the_title();

// Customize page title when necessary
// Check for search results page first because it returns a non-object
if ( is_search() ) {
  $banner_title = 'Search Results';
// Handle 404 Page Not Found
} elseif ( is_404() ) {
  $banner_title = 'Page Not Found';
// Blog category or tag listing pages
} elseif ( is_category() || is_tag() ) {
  $banner_title = 'Blog: '.$qo->name;
// All blog posts have the same title
} elseif ( get_post_type() === 'post' ) {
  $banner_title = 'Blog';
// Override title if Custom Fields custom_page_title exists
} elseif ( get_field( 'custom_page_title', $qo ) ) {
  $banner_title = get_field( 'custom_page_title', $qo );
}

// Build the title element
if ( get_post_type() == 'post' ) {
  $banner_element = '<div class="banner-title">'.$banner_title.'</div>';
} else {
  $banner_element = '<h1 class="banner-title">'.$banner_title.'</h1>';
}
?>
<div id="banner" class="banner" tabindex="-1">
  <div class="wrap">
    <div class="content">
      <?php echo $banner_element; ?>
    </div>
  </div>
</div>
