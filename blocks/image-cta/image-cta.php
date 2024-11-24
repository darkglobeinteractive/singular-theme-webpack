<?php
// Declare block level variables
$classes_array = array( 'image-cta' );
$styles_array = array();

// Handle the image
$image_src = ( get_field( 'image_cta_img' ) ? get_field( 'image_cta_img' )['sizes']['large'] : get_template_directory_uri().'/img/placeholder-image.png' );

// Handle heading and text
$heading = ( get_field( 'image_cta_heading' ) ?: '' );
$text = ( get_field( 'image_cta_text' ) ?: '' );

// Handle link field
$link = get_field( 'image_cta_link' );
if ( $link ) {
  $href = $link['url'];
  $target = ( $link['target'] ? ' target="'.$link['target'].'"' : '' );
} else {
  $href = '#';
  $target = '';
}

// Handle styles and classes
$block_classes = ' class="'.implode( ' ', $classes_array ).'"';
$block_styles = ' style="'.implode( '; ', $styles_array ).'"';
?>

<?php if ( is_admin() || !$link ): ?>
  <span<?php echo $block_classes; ?>>
<?php else: ?>
  <a href="<?php echo $href; ?>"<?php echo $block_classes; ?><?php echo $block_styles; ?><?php echo $target; ?>>
<?php endif; ?>
  <span class="image-wrap">
    <span class="image" style="background-image: url('<?php echo $image_src; ?>')"></span>
  </span>
  <span class="content">
    <?php if ( $heading ): ?>
      <span class="title"><?php echo $heading; ?></span>
    <?php endif; ?>
    <?php if ( $text ): ?>
      <span class="text"><?php echo $text; ?></span>
    <?php endif; ?>
  </span>
<?php if ( is_admin() || !$link ): ?>
  </span>
<?php else: ?>
  </a>
<?php endif; ?>