<?php
// Declare block level variables
$classes_array = array( 'linkable-image-background' );
$image_styles_array = array();

// Handle the image
$image_src = ( get_field( 'lib_image' ) ? get_field( 'lib_image' )['sizes']['large'] : get_template_directory_uri().'/img/placeholder-image.png' );
$image_position = ( get_field( 'lib_image_position' ) ?: 'center center' );
$image_styles_array[] = 'background-image: url(\''.$image_src.'\')';
$image_styles_array[] = 'background-position: '.$image_position;
$image_styles = ' style="'.implode( '; ', $image_styles_array ).'"';

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
$block_classes = ' class="'.implode( ' ', $classes_array ).'"';
?>

<div<?php echo $block_classes; ?>>
  <?php if ( !$link_check || is_admin() ): ?>
    <span class="image"<?php echo $image_styles; ?>>
      <?php if ( $play_button ): ?>
        <span class="admin-play-button"></span>
      <?php endif; ?>
    </span>
  <?php elseif ( $link_check == 'modal' ): ?>
    <a href="<?php echo $href; ?>" class="image modaal-video"<?php echo $image_styles; ?>>
      <span class="visually-hidden">Launch Modal Window</span>
      <?php if ( $play_button ): ?>
        <?php include( locate_template( 'svg/play-button.php', false, false ) ); ?>       
      <?php endif; ?>
    </a>
  <?php elseif ( $link_check == 'standard' ): ?>
    <a href="<?php echo $href; ?>" class="image"<?php echo $image_styles; ?><?php echo $target; ?>>
      <span class="visually-hidden">Goto Page</span>
      <?php if ( $play_button ): ?>
        <?php include( locate_template( 'svg/play-button.php', false, false ) ); ?>       
      <?php endif; ?>
    </a>
  <?php endif; ?>
</div>