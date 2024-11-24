<?php
// Reference:
// https://developer.wordpress.org/reference/hooks/manage_posts_columns/
// https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
// https://awhitepixel.com/modify-add-custom-columns-post-list-wordpress-admin/
// Customize the ViewPoints posts listing
function singular_team_member_posts_columns( $columns ) {
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => 'Name',
    'special_designations' => 'Special Designations',
    'date' => 'Date',
  );
  return $columns;
}
function singular_team_member_custom_columns( $column ) {
  global $post;
  if ( $column == 'special_designations' ) {
    $tsd = get_field_object( 'team_special_designations', $post->ID );
    if ( $tsd['value'] ) {
      $designations = '';
      foreach( $tsd['value'] as $val ) {
        if ( $designations != '' ) {
          $designations .= '<br />';
        }
        $designations .= $val['label'];
      }
      echo $designations;
    }
  } else {
    echo '';
  }
}
add_action( 'manage_team-member_posts_custom_column', 'singular_team_member_custom_columns' );
add_filter( 'manage_team-member_posts_columns', 'singular_team_member_posts_columns' );
?>