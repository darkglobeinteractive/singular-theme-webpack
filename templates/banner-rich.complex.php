<?php
// Grab global variables from custom function.php function
$gv = singular_global_vars();

// Create arrays for banner classes and styles
$classes_array = array( 'banner-rich', 'has-black-background-color', 'has-background' );
$styles_array = array();
$btn_array = array( 'btn' );

// Handle banner and button classes based-on type of banner, defaulting to 'full'
$rich_banner_type = ( get_field( 'rich_banner_type', $gv['qid'] ) ?: 'full' );

// Set banner mask to 'false' by default
$rich_banner_mask = false;

// Full width banners have background images on the banner element and transparent buttons
if ( $rich_banner_type == 'full' ) {

  // Add full class to array
  $classes_array[] = 'full';

  // Determine the full background type, defaulting to a static image
  $rich_banner_background_type = ( get_field( 'rich_banner_background_type', $gv['qid'] ) ?: 'static-image' );

  // Add full background type to classes array
  $classes_array[] = $rich_banner_background_type;

  // Check for background video files and placement
  if ( $rich_banner_background_type == 'video' ) {

    // Check for videos
    $rich_banner_videos = ( have_rows( 'rich_banner_videos', $gv['qid'] ) ? true : false );

    // Set video background position
    $rich_banner_videos_horizontal = ( get_field( 'rich_banner_videos_horizontal', $gv['qid'] ) ?: 'horizontal-center' );
    $rich_banner_videos_vertical = ( get_field( 'rich_banner_videos_vertical', $gv['qid'] ) ?: 'vertical-center' );
    $rich_banner_videos_background_position = $rich_banner_videos_horizontal.' '.$rich_banner_videos_vertical;

  }

  // Set banner mask
  $rich_banner_mask = ( get_field( 'rich_banner_mask', $gv['qid'] ) == 'Yes' ? true : false );

} else {

  // Other wise it's an 'image-aligned' banner and either 'image-left' or 'image-right'
  array_push( $classes_array, 'image-aligned', $rich_banner_type );

}

// Handle banner image
$rich_banner_image = ( get_field( 'rich_banner_image', $gv['qid'] ) ?: false );
if ( $rich_banner_image ) {
  $styles_array[] = 'background-image: url('.$rich_banner_image['sizes']['banner-bg'].')';
}

// Handle static image background position, defaulting to 'center center'
$rich_banner_background_position = ( get_field( 'rich_banner_background_position', $gv['qid'] ) ?: 'center center' );

// Add static image background position to the styles array
$styles_array[] = 'background-position: '.$rich_banner_background_position;

// Create classes and styles code
$block_classes = ' class="'.implode( ' ', $classes_array ).'"';
$block_styles = ' style="'.implode( '; ', $styles_array ).'"';
$btn_classes = implode( ' ', $btn_array );

// Handle banner text and button
$rich_banner_text = ( get_field( 'rich_banner_text', $gv['qid'] ) ?: false );
$rich_banner_button = ( get_field( 'rich_banner_button', $gv['qid'] ) ? singular_assemble_link( get_field( 'rich_banner_button' ), $btn_classes ) : false );
?>
<div id="banner-rich"<?php echo $block_classes; ?><?php echo ( $rich_banner_type == 'full' ? $block_styles : '' ); ?>>
  <div class="wrap">
    <div class="content<?php if ( $rich_banner_type != 'full' ): ?> has-black-background-color<?php endif; ?>">
      <div class="content-wrap">
        <?php echo $rich_banner_text; ?>
        <?php if ( $rich_banner_button ): ?>
          <div class="button-wrap">
            <?php echo $rich_banner_button; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if ( $rich_banner_type != 'full' ): ?>
      <div class="image"<?php echo $block_styles; ?>></div>
    <?php endif; ?>
  </div>
  <?php if ( $rich_banner_type == 'full' && $rich_banner_background_type == 'video' && $rich_banner_videos ): ?>
    <video class="video-bg <?php echo $rich_banner_videos_background_position; ?>" autoplay loop muted width="100%">
      <?php while ( have_rows( 'rich_banner_videos', $gv['qid'] ) ): the_row(); ?>
        <?php 
        // Get url to video file
        $rich_banner_video_url = get_sub_field( 'video_file' )['url'];
        // Determine the extension of the video file
        $rich_banner_video_ext = ( pathinfo( $rich_banner_video_url )['extension'] ?: 'mp4' ); 
        ?>
        <source src="<?php echo $rich_banner_video_url; ?>" type="video/<?php echo $rich_banner_video_ext; ?>" />
      <?php endwhile; ?>
    </video> 
  <?php endif; ?>
  <?php if ( $rich_banner_mask ): ?>
    <div class="mask"></div>
  <?php endif; ?>
</div>