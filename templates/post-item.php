<?php
$pid = get_the_ID(); 
$permalink = get_permalink( $pid );

$blurb = ( has_excerpt( $pid ) ? get_the_excerpt( $pid ) : substr( get_the_excerpt( $pid ), 0, 250 ).'[...]' );
?>
<article id="post-<?php echo $pid; ?>" <?php post_class( 'item' ); ?>>

  <?php if ( !is_admin() ): ?>
    <?php edit_post_link( 'Edit', '<div class="edit-link">', '</div>', $pid ); ?>
  <?php endif; ?>

  <div class="thumbnail">
    <?php if ( !is_admin() ): ?>
      <a href="<?php echo $permalink; ?>">
    <?php endif; ?>

    <?php $thumbnail_array = array( 'class' => 'image', 'fetchpriority' => 'low' ); ?>
    <?php echo ( has_post_thumbnail( $pid ) ? get_the_post_thumbnail( $pid, 'medium_large', $thumbnail_array ) : wp_get_attachment_image( get_field( 'default_image_post', 'option' ), 'medium_large', false, $thumbnail_array ) ); ?>

    <?php if ( !is_admin() ): ?>
      </a>
    <?php endif; ?>
  </div>

  <div class="content">

    <h2>
      <?php if ( !is_admin() ): ?>
        <a href="<?php echo $permalink; ?>">
      <?php endif; ?>
      <?php echo get_the_title( $pid ); ?>
      <?php if ( !is_admin() ): ?>
        </a>
      <?php endif; ?>
    </h2>

    <?php
    $categories = get_the_category( $pid );
    if ( !empty( $categories ) ) {
      echo '<div class="blog-taxonomy categories"><strong>Categories:</strong> ';
      foreach( $categories as $category ) {
        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
      }
      echo '</div>';
    }
    ?>

    <?php
    $tags = get_the_tags( $pid );
    if ( !empty( $tags ) ) {
      echo '<div class="blog-taxonomy tags"><strong>Tags:</strong> ';
      foreach( $tags as $tag ) {
        echo '<a href="' . esc_url( get_category_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
      }
      echo '</div>';
    }
    ?>

    <div class="blurb">
      <?php echo $blurb; ?>
    </div>

    <div class="btn-wrap">
      <?php if ( !is_admin() ): ?>
        <a href="<?php echo $permalink; ?>" class="btn">
      <?php else: ?>
        <span class="btn">
      <?php endif; ?>
      Read More
      <?php if ( !is_admin() ): ?>
        </a>
      <?php else: ?>
        </span>
      <?php endif; ?>
    </div>

  </div>

</article>
