<?php
// Declare block level variables
$classes_array = array( 'team-members-block' );
$styles_array = array();

// Set admin class
if ( is_admin() ) {
  $classes_array[] = 'admin-view';
}

// Set variables
$tmb_category = ( get_field( 'tmb_category' ) != 'all' ? get_field( 'tmb_category' ) : false );
$tmb_type = ( get_field( 'tmb_type' ) ? strtolower( get_field( 'tmb_type' ) ) : 'grid' );
$classes_array[] = $tmb_type.'-type';

// Build query
$tmb_args = array(
	'post_type' => 'team-member',
	'posts_per_page' => -1,
	'meta_key' => 'tm_last_name',
	'orderby' => array(
		'meta_value' => 'ASC'
	)
);

if ( $tmb_category ) {
	$tmb_args['meta_query'] = array(
		array(
			'key' => 'tm_type',
			'compare' => 'LIKE',
			'value' => $tmb_category
		)
	);
}

// Run query
$tmb_query = new WP_Query( $tmb_args );

// Handle styles and classes
$block_classes = singular_attribute_builder( $classes_array, 'class' );
$block_styles = singular_attribute_builder( $styles_array, 'style' );
?>

<?php if ( $tmb_query->have_posts() ): ?>
	<div<?php echo $block_classes; ?><?php echo $block_styles; ?>>
		<?php while ( $tmb_query->have_posts() ): $tmb_query->the_post(); ?>
			<?php
			$tmid = get_the_ID();
			$modaal_window_id = 'modal-team-member-modal-'.$tmid;
			$tm_name = get_the_title();
			$tm_title = ( get_field( 'tm_title', $tmid ) ?: '' );
			$tm_type = ( get_field( 'tm_type', $tmid ) ?: '' );
			$tm_board_info = ( get_field( 'tm_board_info', $tmid ) ?: '' );
			$information = ( get_the_content( $tmid ) ? true : false );

			// Handle image
			$image_styles = ( has_post_thumbnail( $tmid ) ? ' style="background-image: url(\''.get_the_post_thumbnail_url( $tmid, 'medium_large' ).'\');"' : '' );
			?>
			<div class="team-member">
				<?php if ( $information && !is_admin() ): ?>
					<a class="wrap" href="#<?php echo $modaal_window_id; ?>">
				<?php else: ?>
					<div class="wrap">
				<?php endif; ?>
				<?php if ( $tmb_type == 'grid' ): ?>
					<span class="image-wrap"><span class="image"<?php echo $image_styles; ?>></span></span>
				<?php endif; ?>
				<?php if ( $tm_name || $tm_title || $tm_board_info ): ?>
					<span class="content">
						<span class="name"><?php echo $tm_name; ?></span>
						<?php if ( $tm_title ): ?>
							<span class="title"><?php echo $tm_title; ?></span>
						<?php endif; ?>
						<?php if ( $tm_board_info ): ?>
							<span class="board-info"><?php echo $tm_board_info; ?></span>
						<?php endif; ?>
					</span>
				<?php endif; ?>
				<?php if ( $information && !is_admin() ): ?>
					</a>
				<?php else: ?>
					</div>
				<?php endif; ?>	
				<?php if ( $information ): ?>
					<div id="<?php echo $modaal_window_id; ?>" class="team-member-modal-container">
						<div class="team-member-modal-content">
							<button class="close-modal" aria-label="Close Modal Window">
								<?php include( locate_template( 'svg/close-button.php', false, false ) ); ?>
							</button>
							<div class="name"><?php echo $tm_name; ?></div>
							<?php if ( $tm_title ): ?>
								<div class="title"><?php echo $tm_title; ?></div>
							<?php endif; ?>
							<div class="information">
								<?php the_content( $tmid ); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>
<?php endif; ?>