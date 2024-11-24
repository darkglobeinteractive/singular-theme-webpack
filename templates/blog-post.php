<?php
$permalink = get_permalink();
if ( has_post_thumbnail() ) {
  $post_thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
  $post_thumbnail_id = get_post_thumbnail_id();
  $post_thumbnail_alt = ( get_post_meta ( $post_thumbnail_id, '_wp_attachment_image_alt', true ) ?: 'Thumbnail image for: '.get_the_title() );
} else {
  $post_thumbnail = get_template_directory_uri().'/img/default-blog-thumbnail.jpg';
  $post_thumbnail_alt = 'Thumbnail image for: '.get_the_title();
}

$blurb = ( has_excerpt() ? get_the_excerpt() : substr( get_the_excerpt(), 0, 250 ).'[...]' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php if ( !is_admin() ): ?>
    <?php edit_post_link( 'Edit', '<div class="edit-link">', '</div>', get_the_ID() ); ?>
  <?php endif; ?>

  <div class="thumbnail">
    <?php if ( !is_admin() ): ?>
      <a href="<?php echo $permalink; ?>">
    <?php endif; ?>
    <img src="<?php echo $post_thumbnail; ?>" alt="<?php echo $post_thumbnail_alt; ?>" />
    <?php if ( !is_admin() ): ?>
      </a>
    <?php endif; ?>
  </div>

  <div class="content">

    <h2>
      <?php if ( !is_admin() ): ?>
        <a href="<?php echo $permalink; ?>">
      <?php endif; ?>
      <?php echo get_the_title(); ?>
      <?php if ( !is_admin() ): ?>
        </a>
      <?php endif; ?>
    </h2>

    <?php
    $categories = get_the_category();
    if (!empty($categories)) {
      echo '<div class="blog-taxonomy categories"><strong>Categories:</strong> ';
      foreach($categories as $category) {
        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
      }
      echo '</div>';
    }
    ?>

    <?php
    $tags = get_the_tags();
    if (!empty($tags)) {
      echo '<div class="blog-taxonomy tags"><strong>Tags:</strong> ';
      foreach($tags as $tag) {
        echo '<a href="' . esc_url(get_category_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
      }
      echo '</div>';
    }
    ?>

    <div class="blurb">
      <?php echo get_the_excerpt(); ?>
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
