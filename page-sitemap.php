<!-- page-sitemap.php // Site Map -->
<?php get_header(); ?>

<div id="content">
  <div class="wp-block-group wp-block-singular">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">

      <div class="sitemap-listing">
        <ul>
            <?php
                $arg_pages = array(
                  'exclude' => '69',
                  'title_li' => '',
                  // 'sort_column' => 'post_title,menu_order'
                );
                wp_list_pages( $arg_pages );
            ?>
        </ul>
      </div>

    </div>
  </div>
</div>

<?php get_footer(); ?>
