<?php
// Declare block level variables
$classes_array = array( 'wp-block-group', 'wp-block-singular', 'multi-slider-block' );
$classes_inner_array = array( 'wp-block-group__inner-container', 'is-layout-constrained', 'wp-block-group-is-layout-constrained' );
$styles_array = array();

if ( is_admin() ) {
  array_push( $classes_array, 'block-editor-block-list__block', 'wp-block', 'has-child-selected' );
  array_push( $classes_inner_array, 'block-editor-block-list__layout' );
}

// Add classes from block editor's Additional CSS Class(es) field
if ( !empty( $block['className'] ) ) {
  $classes_array = array_merge( $classes_array, explode( ' ', trim( $block['className'] ) ) );
}

// Determine type of slider we're working with
$image_slider_type = get_field( 'image_slider_type' );
$classes_array[] = $image_slider_type;

// Determine width of the slider
$classes_array[] = ( get_field( 'image_slider_width' ) ?: 'full-width' );

// Determine the image type
$image_slider_image_type = ( get_field( 'image_slider_image_type' ) ?: 'block' );
$classes_array[] = $image_slider_image_type;

// Handle autoplay variables
$autoplay_check = ( get_field( 'image_slider_autoplay' ) == 'Yes' ? true : false );
if ( $autoplay_check ) {
  $autoplay_speed = ( get_field( 'image_slider_autoplay_speed' ) ?: '4000' );
  $transition_speed = ( get_field( 'image_slider_transition_speed' ) ?: '1000' );
  $classes_array[] = 'autoplay-slider';
}

// Handle styles and classes
$block_classes = singular_attribute_builder( $classes_array, 'class' );
$block_classes_inner = singular_attribute_builder( $classes_inner_array, 'class' );
$block_styles = singular_attribute_builder( $styles_array, 'style' );
?>

<?php if ( have_rows( 'image_slider' ) ): ?>
  <?php if ( is_admin() ): ?>
    <div class="admin-multi-slider">
      <?php while ( have_rows( 'image_slider' ) ): the_row(); ?>
        <?php 
        $image_id = ( get_sub_field( 'image' ) ?: get_field( 'default_image_placeholder', 'option' ) );
        echo wp_get_attachment_image( $image_id, 'medium' ); 
        ?>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div<?php echo $block_classes; ?><?php echo ( $autoplay_check ? ' data-autoplay-speed="'.$autoplay_speed.'" data-transition-speed="'.$transition_speed.'"' : '' ); ?>>
      <div<?php echo $block_classes_inner; ?>>
        <div class="multi-slider">
          <div class="wrap">
            <?php if ( get_field( 'image_slider_intro' ) ): ?>
              <div class="slider-intro">
                <?php echo get_field( 'image_slider_intro' ); ?>
              </div>
            <?php endif; ?>
            <div class="slider-nav">
              <button class="slider--prev">
                <?php include( locate_template( 'svg/slider-arrow-left.php', false, false ) ); ?>
              </button>
              <button class="slider--next">
                <?php include( locate_template( 'svg/slider-arrow-right.php', false, false ) ); ?>
              </button>
            </div>
            <div class="slider">
              <div class="wrap">

                <?php while ( have_rows( 'image_slider' ) ): the_row(); ?>

                  <?php 
                  // Handle the image
                  $image_id = ( get_sub_field( 'image' ) ?: get_field( 'default_image_placeholder', 'option' ) );
                  $image_class = ( $image_slider_image_type == 'block' ? 'image-bg' : 'image-element' );
                  $image_object = wp_get_attachment_image( $image_id, 'medium', false, array( 'class' => $image_class ) ); 

                  $link = ( $image_slider_type == 'images' && get_sub_field( 'link' ) ? get_sub_field( 'link' ) : '' );
                  if ( $link ) {
                    $href = $link['url'];
                    $target = ( $link['target'] ? ' target="'.$link['target'].'"' : '' );
                  }
                  $modal_content = ( $image_slider_type == 'modal' && get_sub_field( 'modal_content' ) ? get_sub_field( 'modal_content' ) : '' );
                  if ( $modal_content ) {
                    $modal_id = 'modal-'.md5( $image_id.$modal_content );
                  }
                  $modal_image = ( $image_slider_type == 'modal' && get_sub_field( 'modal_image' ) == 'Yes' ? true : false );
                  ?>

                  <div class="item">

                    <?php if ( $link ): ?>
                      <a href="<?php echo $href; ?>" class="wrap"<?php echo $target; ?>>
                    <?php elseif ( $modal_content ): ?>
                      <a href="#<?php echo $modal_id; ?>" class="wrap modal">
                    <?php else: ?>
                      <div class="wrap">
                    <?php endif; ?>

                      <span class="image-wrap">
                        <?php echo $image_object; ?>
                      </span>

                    <?php if ( $link || $modal_content ): ?>
                      </a>
                    <?php else: ?>
                      </div>
                    <?php endif; ?>

                    <?php if ( $modal_content ): ?>
                      <div class="modal-container" style="display: none;">
                        <div id="<?php echo $modal_id; ?>">
                          <div class="slider-modal-info">
                            <div class="wrap">
                              <?php if ( $modal_image ): ?>
                                <div class="modal-image">
                                  <?php echo $image_object; ?>
                                </div>
                              <?php endif; ?>
                              <div class="modal-content">
                                <div class="wrap">
                                  <?php echo $modal_content; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>

                  </div>

                <?php endwhile; ?>

              </div>
            </div>
          </div>    
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php elseif ( is_admin() ): ?>
  <p>Edit this block to add slides</p>
<?php endif; ?>