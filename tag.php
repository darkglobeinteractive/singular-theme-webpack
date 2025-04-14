<!-- category.php // Posts Category Archive List -->
<?php get_header(); ?>

<div id="content">
  <div class="wp-block-group wp-block-singular">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">

      <?php if ( have_posts() ) : ?>

        <div class="post-list">

        <?php while ( have_posts() ) : the_post(); ?>
          <?php include( locate_template( 'templates/post-item.php', false, false ) ); ?>
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
