<?php
// Declare block level variables
$classes_array = array( 'linkable-image-background' );

// Handle the image
$image_id = ( get_field( 'lib_image' ) ?: get_field( 'default_image_background', 'option' ) );
$image_position = ( get_field( 'lib_image_position' ) ?: 'center center' );
$image_styles_array = array( 'object-position: '.$image_position );
$image_styles = implode( '; ', $image_styles_array );
$image_object = wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'image', 'fetchpriority' => 'low', 'style' => $image_styles ) );

// Handle link variables
$link_check = ( get_field( 'lib_link_check' ) == 'none' ? false : get_field( 'lib_link_check' ) );
$link = ( get_field( 'lib_link' ) ?: '' );
$play_button = ( get_field( 'lib_play_button' ) ?: false );

// If link check is positive and there's a link
if ( $link_check && $link ) {  

  // Handle link variables
  $href = $link['url'];
  $target = ( $link['target'] ? ' target="'.$link['target'].'"' : '' );

  // Check for modal option
  if ( $link_check == 'modal' ) {
    $classes_array[] = 'modal';
  }

  // Check for play button option
  if ( $play_button ) {
    $classes_array[] = 'play-button';
  };
  
} else {
  $href = '';
  $target = '';
}

// Handle styles and classes
$block_classes = singular_attribute_builder( $classes_array, 'class' );
?>

<div<?php echo $block_classes; ?>>
  <?php if ( !$link_check || is_admin() ): ?>
    <span class="image-wrap">
      <?php if ( $play_button ): ?>
        <span class="admin-play-button"></span>
      <?php endif; ?>
      <?php echo $image_object; ?>
    </span>
  <?php elseif ( $link_check == 'modal' ): ?>
    <a href="<?php echo $href; ?>" class="image-wrap modaal-video">
      <span class="visually-hidden">Launch Modal Window</span>
      <?php if ( $play_button ): ?>
        <?php include( locate_template( 'svg/play-button.php', false, false ) ); ?>       
      <?php endif; ?>
      <?php echo $image_object; ?>
    </a>
  <?php elseif ( $link_check == 'standard' ): ?>
    <a href="<?php echo $href; ?>" class="image-wrap"<?php echo $target; ?>>
      <span class="visually-hidden">Goto Page</span>
      <?php if ( $play_button ): ?>
        <?php include( locate_template( 'svg/play-button.php', false, false ) ); ?>       
      <?php endif; ?>
      <?php echo $image_object; ?>
    </a>
  <?php endif; ?>
</div>