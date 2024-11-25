<?php
/* REMOVE CORE BLOCK PATTERNS ----------------------------------- */
remove_theme_support( 'core-block-patterns' );


/* REGISTER THE PATTERN CATEGORIES ------------------------------ */
function singular_bps_register_categories() {

  register_block_pattern_category(
    'singular-all',
    array(
      'label' => '[CLIENT] Patterns'
    )
  );

}
add_action( 'init', 'singular_bps_register_categories' );
?>