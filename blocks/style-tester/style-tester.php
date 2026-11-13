<?php
// Declare block level variables
$classes_array = array( 'style-tester-block' );

// Add classes from block editor's Additional CSS Class(es) field
if ( !empty( $block['className'] ) ) {
  $classes_array = array_merge( $classes_array, explode( ' ', trim( $block['className'] ) ) );
}

// Block markup sources (rendered through do_blocks() so they match real block output)
$markup_sections = array(
  'Style Guide' => 'blocks/style-tester/_source/style-guide.html',
  'Basic Content Wrapper' => 'blocks/style-tester/_source/basic-content-wrapper.php',
  'Accordion' => 'blocks/style-tester/_source/accordion.php',
);

// Auto-discover every SVG include in /svg/
$svg_files = glob( get_theme_file_path( 'svg/*.php' ) ) ?: array();

// Optional display size per SVG (keyed by file name without extension)
$svg_sizes = array(
  'close-button' => 'size-48',
  'magnifying-glass' => 'size-40',
);

// Handle styles and classes
$block_classes = singular_attribute_builder( $classes_array, 'class' );
?>

<div<?php echo $block_classes; ?>>

  <?php foreach ( $markup_sections as $label => $path ): ?>
    <?php $file = get_theme_file_path( $path ); ?>
    <div class="style-tester-separator"><span><?php echo esc_html( $label ); ?></span></div>
    <?php if ( file_exists( $file ) ): ?>
      <?php echo do_blocks( file_get_contents( $file ) ); ?>
    <?php else: ?>
      <p class="style-tester-missing">Missing file: <?php echo esc_html( $path ); ?></p>
    <?php endif; ?>
  <?php endforeach; ?>

  <div class="style-tester-separator"><span>SVG Icons</span></div>
  <div class="wp-block-group wp-block-singular">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
      <div class="svg-test-grid">
        <?php foreach ( $svg_files as $svg_file ): ?>
          <?php
          $svg_name = basename( $svg_file, '.php' );
          $size_class = ( $svg_sizes[$svg_name] ?? ( strpos( $svg_name, 'social-media-' ) === 0 ? 'size-40' : '' ) );
          ?>
          <div class="svg-test-item">
            <div class="svg-test-box <?php echo esc_attr( $size_class ); ?>">
              <?php include( $svg_file ); ?>
            </div>
            <div class="svg-test-label"><?php echo esc_html( $svg_name ); ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</div>
