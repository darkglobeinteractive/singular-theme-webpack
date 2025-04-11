<!-- category.php // Posts Category Archive List -->
<?php get_header(); ?>

<div id="content">
  <div class="wp-block-group wp-block-singular">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">

      <?php if ( have_posts() ) : ?>

        <div class="post-list">

        <?php while ( have_posts() ) : the_post(); ?>
          <?php
          $permalink = get_permalink();
          $post_thumbnail = get_the_post_thumbnail_url( get_the_ID(), '');
          ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if ( $post_thumbnail ): ?>
              <?php
              // Create alt text for thumbnail
              $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
              $post_thumbnail_alt = ( get_post_meta ( $post_thumbnail_id, '_wp_attachment_image_alt', true ) ?: 'Thumbnail image for: '.get_the_title() );
              ?>
              <div class="thumbnail"><a href="<?php echo $permalink; ?>"><img src="<?php echo $post_thumbnail; ?>" alt="<?php echo $post_thumbnail_alt; ?>" /></a></div>
            <?php endif; ?>

            <div class="content">

              <h2><a href="<?php echo $permalink; ?>"><?php echo get_the_title(); ?></a></h2>

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

              <div class="btn-wrap"><a href="<?php echo $permalink; ?>" class="btn">Read More</a></div>

            </div>

          </article>
        <?php endwhile; ?>

        </div>

        <?php include( locate_template( 'templates/pagination.php', false, false ) ); ?>

      <?php else: ?>
        <p>We cannot find the content you are looking for. Please, try again.</p>
      <?php endif; ?>

    </div>
  </div>
</div>

<?php get_footer(); ?>
