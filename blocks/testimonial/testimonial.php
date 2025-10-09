<?php
// Declare block level variables
$classes_array = array( 'wp-block-group', 'wp-block-singular', 'testimonial-block' );
$classes_inner_array = array( 'wp-block-group__inner-container', 'is-layout-constrained', 'wp-block-group-is-layout-constrained' );
$styles_array = array();

// Set admin classes
if ( is_admin() ) {
  array_push( $classes_array, 'block-editor-block-list__block', 'wp-block', 'has-child-selected' );
  array_push( $classes_inner_array, 'block-editor-block-list__layout' );
}

// Add classes from block editor's Additional CSS Class(es) field
if ( !empty( $block['className'] ) ) {
  $classes_array = array_merge( $classes_array, explode( ' ', trim( $block['className'] ) ) );
}

// Grab variables
$testimonial_quote = ( get_field( 'testimonial_quote' ) ?: '' );
$testimonial_author = ( get_field( 'testimonial_author' ) ?: '' );
$testimonial_author_title = ( get_field( 'testimonial_author_title' ) ?: '' );

// Handle styles and classes
$block_classes = singular_attribute_builder( $classes_array, 'class' );
$block_classes_inner = singular_attribute_builder( $classes_inner_array, 'class' );
$block_styles = singular_attribute_builder( $styles_array, 'style' );
?>

<div<?php echo $block_classes; ?><?php echo $block_styles; ?>>
  <div<?php echo $block_classes_inner; ?>>
    <div class="content-wrapper">
      <?php if ( $testimonial_quote ): ?>
        <div class="testimonial-quote testimonial-section"><?php echo $testimonial_quote; ?></div>
      <?php endif; ?>
      <?php if ( $testimonial_author ): ?>
        <div class="testimonial-info testimonial-section">
          <span class="testimonial-author"><?php echo $testimonial_author; ?></span>
          <?php if ( $testimonial_author_title ): ?>
            <span class="testimonial-title"><?php echo $testimonial_author_title; ?></span>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>