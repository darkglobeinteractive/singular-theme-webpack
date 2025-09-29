<?php
// Create global icon determining if the banner should be shown
$show_alert_banner = false; 

// Create array to contain block classes
$classes_array = array( 'alert-banner' );
$content_styles_array = array();

// Gather variables and apply classes
$alert_banner_check = ( get_field( 'alert_banner_check', 'option' ) == 'none' ? false : get_field( 'alert_banner_check', 'option' ) );

// If alert banner is to be displayed, add class to indicate where it's to be displayed
if ( $alert_banner_check ) {
  $classes_array[] = $alert_banner_check;
}

$alert_banner_content = ( get_field( 'alert_banner_content', 'option' ) ?: false );

// Handle banner background color
$alert_banner_color = ( get_field( 'alert_banner_color', 'option' ) ? strtolower( get_field( 'alert_banner_color', 'option' ) ) : 'black' );
$classes_array[] = 'has-background';
$classes_array[] = 'has-'.$alert_banner_color.'-background-color';

// Handle optional banner icon
$alert_banner_icon = ( get_field( 'alert_banner_icon', 'option' ) ?: 'none' );
if ( $alert_banner_icon != 'none' ) {
  $classes_array[] = 'include-icon';
  $classes_array[] = $alert_banner_icon.'-icon';
} else {
  $classes_array[] = 'no-icon';
}

// Handle expiration date and time
$alert_banner_expiration_check = ( get_field( 'alert_banner_expiration_check', 'option' ) == 'Yes' ? true : false );
$alert_banner_expired = ( get_field( 'alert_banner_expiration', 'option' ) ? singular_time_expiration( get_field( 'alert_banner_expiration', 'option' ) ) : true );

// Handle block classes
$block_classes = ' class="'.implode( ' ', $classes_array ).'"';
$content_styles = ' style="'.implode( ';', $content_styles_array ).'"';

// If the banner check is positive && content exists
if ( $alert_banner_check && $alert_banner_content ) {
  // If the banner should appear everywhere || it should only appear on the hompeage && it is the homepage
  if ( $alert_banner_check == 'all' || ( $alert_banner_check == 'homepage-only' && is_front_page() ) ) {
    // If there's no expiration date || the banner has not expired
    if ( !$alert_banner_expiration_check || !$alert_banner_expired ) {
      $show_alert_banner = true; 
    } 
  } 
}
?>
<?php if ( $show_alert_banner ): ?>
  <div<?php echo $block_classes; ?>>
    <div class="wrap">
      <div class="content"<?php echo $content_styles; ?>><?php echo $alert_banner_content; ?></div>
    </div>
  </div>
<?php endif; ?>

