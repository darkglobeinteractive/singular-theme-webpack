<?php
// Declare block level variables
$classes_array = array( 'color-block-cta' );
$styles_array = array();

// Handle background color
if ( get_field( 'color_block_cta_bg' ) ) {
  $bgcolor_hex = get_field( 'color_block_cta_bg' );
  $styles_array[] = 'background-color: '.$bgcolor_hex;
  $classes_array[] = singular_color_palette_class( $bgcolor_hex, 'background' );
} else {
  $bgcolor_hex = '#ffffff';
}

// Handle heading and text
$heading = ( get_field( 'color_block_cta_heading' ) ?: '' );
$text = ( get_field( 'color_block_cta_text' ) ?: '' );

// Handle link field
$link = get_field( 'color_block_cta_link' );
if ( $link ) {
  $href = $link['url'];
  $target = ( $link['target'] ? ' target="'.$link['target'].'"' : '' );
} else {
  $href = '';
  $target = '';
}

// Create special class string
$unique_class = 'aic-'.md5( $heading.$text.$href.$target );
$classes_array[] = $unique_class;

// Handle styles and classes
$block_classes = ' class="'.implode( ' ', $classes_array ).'"';
$block_styles = ' style="'.implode( '; ', $styles_array ).'"';
?>
<style>
  .<?php echo $unique_class; ?>:hover .svg-icon.arrow-in-circle svg > .wrap .circle circle {
    fill: var(--black);
  }
  .<?php echo $unique_class; ?>:hover .svg-icon.arrow-in-circle svg > .wrap .arrow {
    fill: <?php echo $bgcolor_hex; ?>;
  }
</style>

<?php if ( is_admin() || !$link ): ?>
  <span<?php echo $block_classes; ?><?php echo $block_styles; ?>>
<?php else: ?>
  <a href="<?php echo $href; ?>"<?php echo $block_classes; ?><?php echo $block_styles; ?><?php echo $target; ?>>
<?php endif; ?>
  <span class="wrap">
    <?php if ( $heading ): ?>
      <span class="title"><?php echo $heading; ?></span>
    <?php endif; ?>
    <?php if ( $text ): ?>
      <span class="text"><?php echo $text; ?></span>
    <?php endif; ?>
  </span>
  <?php if ( !is_admin() ): ?>
    <?php include( locate_template( 'svg/arrow-in-circle.php', false, false ) ); ?>
  <?php else: ?>
    <img src="<?php echo get_template_directory_uri().'/img/static-icons/arrow-in-circle.png'; ?>" class="svg-arrow-in-circle" />
  <?php endif; ?>
<?php if ( is_admin() || !$link ): ?>
  </span>
<?php else: ?>
  </a>
<?php endif; ?>