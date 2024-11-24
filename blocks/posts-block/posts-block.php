<?php
// Declare block level variables
$classes_array = array( 'wp-block-group', 'wp-block-singular', 'posts-block' );
$classes_inner_array = array( 'wp-block-group__inner-container', 'is-layout-constrained', 'wp-block-group-is-layout-constrained' );
$styles_array = array();

if ( is_admin() ) {
  array_push( $classes_array, 'block-editor-block-list__block', 'wp-block', 'has-child-selected' );
  array_push( $classes_inner_array, 'block-editor-block-list__layout' );
}

// Handle grid variables
$pb_categories = ( get_field( 'pb_categories' ) ?: '' );
$pb_quantity = ( get_field( 'pb_quantity' ) ?: 9 );
$pb_pagination = ( get_field( 'pb_pagination' ) == 'Yes' ? true : false );
$pb_filtering = ( get_field( 'pb_filtering' ) == 'Yes' ? true : false );

// Build query
$pb_args = array(
  'post_type' => 'post'
);

// See if a search for text was made as well
if ( isset( $_GET['filter-text'] ) && $_GET['filter-text'] != '' ) {
  $pb_args['s'] = urldecode( $_GET['filter-text'] ); 
}

// Handle categories
if ( isset( $_GET['filter-category'] ) ) {
  if ( $_GET['filter-category'] != '' ) {
    $pb_args['category__in'] = array( $_GET['filter-category'] ); 
  }
} elseif ( is_array( $pb_categories ) ) {
  $pb_args['category__in'] = $pb_categories;
}

// Handle pagination
if ( $pb_pagination ) {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $pb_args['paged'] = $paged;
  $pb_args['posts_per_page'] = $pb_quantity;
} else {
  $pb_args['no_found_rows'] = true;
  $pb_args['pages'] = false;
  $pb_args['posts_per_page'] = $pb_quantity;
}

// Run query
$pb_query = new WP_Query( $pb_args );

// Handle styles and classes
$block_classes = ' class="'.implode( ' ', $classes_array ).'"';
$block_classes_inner = ' class="'.implode( ' ', $classes_inner_array ).'"';
$block_styles = ' style="'.implode( '; ', $styles_array ).'"';
?>

<div<?php echo $block_classes; ?><?php echo $block_styles; ?>>
  <div<?php echo $block_classes_inner; ?>>    

    <?php if ( $pb_filtering ): ?>
      <form class="post-grid-filtering" action="<?php echo get_permalink(); ?>" method="get">
        <div class="filter-category">
          <label class="visually-hidden" for="filter-category">Filter by Category</label>
          <select id="filter-category" name="filter-category" class="select-css">
            <option value="">Filter by Category</option>
            <?php foreach ( get_terms( array( 'taxonomy' => 'category', 'hide_empty' => true ) ) as $cat ): ?>
              <option value="<?php echo $cat->term_id; ?>"<?php echo ( isset( $_GET['filter-category'] ) && $_GET['filter-category'] == $cat->term_id ? ' selected="selected"' : '' ); ?>><?php echo $cat->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="filter-text">
          <label class="visually-hidden" for="filter-text">Search by keyword...</label>
          <input id="filter-text" type="text" name="filter-text" value="<?php echo ( isset( $_GET['filter-text'] ) && $_GET['filter-text'] != '' ? $_GET['filter-text'] : 'Search by keyword...' ); ?>" />
          <button type="submit">
            <?php include( locate_template( 'svg/magnifying-glass.php', false, false ) ); ?>
          </button>
        </div>
      </form>
    <?php endif; ?>

    <?php if ( $pb_query->have_posts() ): ?>

      <div class="blog-list">

        <?php while ( $pb_query->have_posts() ) : $pb_query->the_post(); ?>
          <?php include( locate_template( 'templates/blog-post.php', false, false ) ); ?>
        <?php endwhile; ?>

      </div>

    <?php else: ?>

      <div class="blog-list empty">
        <p>Not posts were found</p>
      </div>
    <?php endif; ?>

    <?php $GLOBALS['wp_query']->max_num_pages = $pb_query->max_num_pages; ?>
    <?php include( locate_template( 'templates/pagination.php', false, false ) ); ?>

  </div>
</div>