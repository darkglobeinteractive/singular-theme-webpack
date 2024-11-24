<?php 
$gi_social_media = [
  ...( get_field( 'social_media_facebook', 'option' ) ? ['facebook' => get_field( 'social_media_facebook', 'option' )] : [] ),
  ...( get_field( 'social_media_instagram', 'option' ) ? ['instagram' => get_field( 'social_media_instagram', 'option' )] : [] ),
  ...( get_field( 'social_media_linkedin', 'option' ) ? ['linkedin' => get_field( 'social_media_linkedin', 'option' )] : [] ),
  ...( get_field( 'social_media_twitter', 'option' ) ? ['twitter' => get_field( 'social_media_twitter', 'option' )] : [] ),
  ...( get_field( 'social_media_youtube', 'option' ) ? ['youtube' => get_field( 'social_media_youtube', 'option' )] : [] ),
];
?>
<?php if ( count( $gi_social_media ) > 0 ): ?>
  <ul class="social-media">
    <?php if ( array_key_exists( 'facebook', $gi_social_media ) ): ?>
      <li class="icon facebook">
        <a href="<?php echo $gi_social_media['facebook']; ?>" target="_blank" rel="noopener" aria-label="Facebook Link">
          <span class="label">Facebook</span>
          <?php include( locate_template( 'svg/social-media-facebook.php', false, false ) ); ?>
        </a>
      </li>
    <?php endif; ?>
    <?php if ( array_key_exists( 'instagram', $gi_social_media ) ): ?>
      <li class="icon instagram">
        <a href="<?php echo $gi_social_media['instagram']; ?>" target="_blank" rel="noopener" aria-label="Instagram Link">
          <span class="label">Instagram</span>
          <?php include( locate_template( 'svg/social-media-instagram.php', false, false ) ); ?>
        </a>
      </li>
    <?php endif; ?>
    <?php if ( array_key_exists( 'linkedin', $gi_social_media ) ): ?>
      <li class="icon linkedin">
        <a href="<?php echo $gi_social_media['linkedin']; ?>" target="_blank" rel="noopener" aria-label="LinkedIn Link">
          <span class="label">LinkedIn</span>
          <?php include( locate_template( 'svg/social-media-linkedin.php', false, false ) ); ?>
        </a>
      </li>
    <?php endif; ?>
    <?php if ( array_key_exists( 'twitter', $gi_social_media ) ): ?>
      <li class="icon twitter">
        <a href="<?php echo $gi_social_media['twitter']; ?>" target="_blank" rel="noopener" aria-label="Twitter Link">
          <span class="label">Twitter</span>
          <?php include( locate_template( 'svg/social-media-twitter.php', false, false ) ); ?>
        </a>
      </li>
    <?php endif; ?>
    <?php if ( array_key_exists( 'youtube', $gi_social_media ) ): ?>
      <li class="icon youtube">
        <a href="<?php echo $gi_social_media['youtube']; ?>" target="_blank" rel="noopener" aria-label="YouTube Link">
          <span class="label">YouTube</span>
          <?php include( locate_template( 'svg/social-media-youtube.php', false, false ) ); ?>
        </a>
      </li>
    <?php endif; ?>
  </ul>
<?php endif; ?>