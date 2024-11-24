<?php
/* ENABLE STYLESHEET DROPDOWN ----------------------------------- */
function singular_mce_editor_buttons( $buttons ) {

  array_unshift( $buttons, 'styleselect' );
  return $buttons;

}
add_filter( 'mce_buttons_2', 'singular_mce_editor_buttons' );

/* ADD STYLES TO DROPDOWN --------------------------------------- */
/* See https://stackoverflow.com/q/50918418 for adding these to ACF WYSIWYG fields */
function singular_mce_before_init( $settings ) {

  $style_formats = array(
    array(
      'title' => 'Download Link',
      'selector' => 'a',
      'classes' => 'download'
    ),
    array(
      'title' => 'My Test',
      'selector' => 'p',
      'classes' => 'mytest',
    ),
    array(
      'title' => 'AlertBox',
      'block' => 'div',
      'classes' => 'alert_box',
      'wrapper' => true
    ),
    array(
      'title' => 'Red Uppercase Text',
      'inline' => 'span',
      'styles' => array(
        'color'         => 'red', // or hex value #ff0000
        'fontWeight'    => 'bold',
        'textTransform' => 'uppercase'
      )
    ),
    array(
      'title' => 'Underlined H2',
      'block' => 'h2',
      'classes' => 'underline',
      'wrapper' => false
    )
  );

  $settings['style_formats'] = json_encode( $style_formats );

  return $settings;
}
add_filter( 'tiny_mce_before_init', 'singular_mce_before_init' );
?>
