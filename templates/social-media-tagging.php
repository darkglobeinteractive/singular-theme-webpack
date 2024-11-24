<?php
// Create the URL and title fields
$og_url = get_permalink( $gv['queried_object']->ID );

if ( is_object( $gv['queried_object'] ) && get_field ( 'custom_page_title', $gv['queried_object']->ID ) ) {
  $og_title = get_field ( 'custom_page_title', $gv['queried_object']->ID ).' | '.get_bloginfo( 'name' );
} elseif ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) || is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) {
  $og_title = get_the_title( $gv['queried_object']->ID );
} else {
  $og_title = get_the_title( $gv['queried_object']->ID ).' | '.get_bloginfo( 'name' );
};

// Create default images
$og_image = get_template_directory_uri().'/img/default-blog-thumbnail.jpg';
$og_image_alt = get_bloginfo( 'name' );

// If the post has a thumbnail, customize the image
if ( has_post_thumbnail( $gv['queried_object']->ID ) ) {
  $og_image = get_the_post_thumbnail_url( $gv['queried_object']->ID, 'full' );
  $og_image_id = get_post_thumbnail_id( $gv['queried_object']->ID );
  $og_image_alt = ( get_post_meta ( $og_image_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $gv['queried_object']->ID ) );
}

// Generate an excerpt from the excerpt field or the page content
$raw_excerpt = get_the_excerpt( $gv['queried_object']->ID );

// Encode and remove certain characters
$encoded_excerpt = str_replace( array( "\r", "\n" ), '', strip_tags( str_replace( '"', '&quot;', $raw_excerpt ) ) );

// If the description is over 200 characters long, trim it and add an ellipse
$og_description = ( strlen( $encoded_excerpt ) > 200 ? substr( $encoded_excerpt, 0, 197 ).'...' : $encoded_excerpt );
?>

<meta name="description" content="<?php echo $og_description; ?>" />

<meta property="og:site_name" content="60bpm" />
<meta property="og:title" content="<?php echo $og_title; ?>" />
<meta property="og:description" content="<?php echo $og_description; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<meta property="og:image" content="<?php echo $og_image; ?>" />
<meta property="og:image:alt" content="<?php echo $og_image_alt; ?>" />

<meta name="twitter:title" content="<?php echo $og_title; ?>" />
<meta name="twitter:description" content="<?php echo $og_description; ?>" />
<meta name="twitter:image" content="<?php echo $og_image; ?>" />
<meta name="twitter:image:alt" content="<?php echo $og_image_alt; ?>" />
<meta name="twitter:card" content="summary_large_image" />
