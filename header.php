<?php
// Grab global variables from custom function.php function
$gv = singular_global_vars();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php
		if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) || is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) {
			wp_title();
		} elseif ( $gv['qoc'] && get_field ( 'custom_page_title', $gv['qid']) ) {
			echo get_field ( 'custom_page_title', $gv['qid'] ).' | ';
			bloginfo();
		} else {
			wp_title( '|', true, 'right' );
			bloginfo();
		};
		?></title>
		<?php wp_head(); ?>
		<?php include( locate_template( 'inc/analytics-head.php', false, false ) ); ?>
	</head>
	<body <?php
	$additional_classes = [];
	body_class( $additional_classes ); ?>>
		<a href="#main" class="skip-main">Skip to Main Content</a>
		<?php include( locate_template( 'inc/analytics-body.php', false, false ) ); ?>
    <div id="page">
      <header id="header">
				<div class="wrap">
	        <?php include( locate_template( 'templates/logo.php', false, false ) ); ?>
	        <?php
					wp_nav_menu( array(
						'theme_location' => 'main-menu-nav',
						'menu_class' => 'menu',
						'container' => 'nav',
	          'container_id' => 'navigation'
					) );
					?>
					<button id="mm-trigger" aria-label="Mobile Menu Toggle">
						<span class="trigger-title">Mobile Menu</span>
						<span class="trigger-wrapper">
							<span class="trigger-container">
								<span></span>
								<span></span>
								<span></span>
								<span></span>
							</span>
						</span>
					</button>
				</div>
      </header>
			<?php if ( !is_search() && get_field( 'rich_banner_add', $gv['qid'] ) == 'Yes' ): ?>
				<?php include( locate_template( 'templates/banner-rich.php', false, false ) ); ?>
			<?php else: ?>
				<?php include( locate_template( 'templates/banner-simple.php', false, false ) ); ?>
			<?php endif; ?>
      <div id="main" role="main">
				<div id="main-wrap">
