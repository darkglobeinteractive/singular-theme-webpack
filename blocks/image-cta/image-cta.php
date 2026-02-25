<?php
// Declare block level variables
$classes_array = array( 'image-cta' );
$styles_array = array();

// Handle the image
$image_id = ( get_field( 'image_cta_img' ) ?: get_field( 'default_image_post', 'option' ) );

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
$block_classes = singular_attribute_builder( $classes_array, 'class' );
$block_styles = singular_attribute_builder( $styles_array, 'style' );
?>

<?php if ( is_admin() || !$link ): ?>
  <span<?php echo $block_classes; ?>>
<?php else: ?>
  <a href="<?php echo $href; ?>"<?php echo $block_classes; ?><?php echo $block_styles; ?><?php echo $target; ?>>
<?php endif; ?>
  <span class="image-wrap">
    <?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'image', 'fetchpriority' => 'low' ) ); ?>
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