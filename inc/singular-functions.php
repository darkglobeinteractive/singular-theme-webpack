<?php
// ASSEMBLE LINK: Receives a link field and returns the assembled element
// $link_object: The link field which contains the url, title and target variables
// $default_title: In case the title isn't set by the link field
// $add_id, $add_class: Optional attributes
function singular_assemble_link( $link_object, $add_class = false, $add_id = false, $default_title = 'Learn More' ) {

  // Set the three variables from the link object
  $url = $link_object['url'];
  $title = ( $link_object['title'] ?: $default_title );
  $target = ( $link_object['target'] ? ' target="'.$link_object['target'].'"' : '' );

  // Create the id and/or class attributes
  $id = ( $add_id ? ' id="'.$add_id.'"' : '' );
  $class = ( $add_class ? ' class="'.$add_class.'"' : '' );

  return '<a href="'.$url.'"'.$id.$class.$target.'>'.$title.'</a>';

}


// COLOR PALETTE CLASS: Returns the appropriate color palette class from a hex
// $hex: The hex color
// $type: Should be either 'background' or 'text'
function singular_color_palette_class( $hex, $type ) {

  // Set palette name variable
  $palette_name = '';

  switch ( $hex ) {
    case '#0000ff':
      $palette_name = 'brand-primary';
      break;
    case '#ff0000':
      $palette_name = 'brand-secondary';
      break;
    case '#000000':
      $palette_name = 'black';
      break;
    case '#ffffff';
      $palette_name = 'white';
      break;
    default:
      $palette_name = '';
  }

  if ( $palette_name ) {
    if ( $type == 'text' ) {
      return 'has-'.$palette_name.'-color';
    } else {
      return 'has-'.$palette_name.'-background-color';
    }  
  } else {
    return '';
  }

}


// ATTRIBUTE BUILDER: Builds an element's attribute from an array
// $attr_array: An array of items for the attribute
// $attr: The attribute we're building
function singular_attribute_builder( $attr_array, $attr ) {

  if ( !is_array( $attr_array ) || !$attr ) {
    return '';
  } else {

    // Handle different attributes
    if ( $attr == 'class' ) {
      return ' class="'.implode( ' ', $attr_array ).'"';
    } elseif ( $attr == 'style' ) {
      return ' style="'.implode( '; ', $attr_array ).'"';
    } else {
      return ' '.$attr.'="'.implode( ' ', $attr_array ).'"';
    }

  }

}


// CUSTOM DEBUGGING: Generates an element describing a field for debugging purposes
// $field: The raw field data
// $field_type: The type of field (e.g. text, array, etc.)
// $title: The title to display for each section in the debugging block
// $bg_color: Overrides the background color of the block
// $test: By default, the block will be generated. This allows you to use a test on the front-end (e.g. $_GET['debug'])
// Example: singular_debug( get_field( 'custom_field' ), 'text', 'Custom Field', '#ff0000', isset( $_GET['debug'] ) )
function singular_debug( $field, $field_type, $title, $bg_color = '#fff', $test = true ) {

  // Check the test variable before proceeding
  if ( $test ) {

    // Instantiate the return value
    $return_value = '';

    // Test for field type and handle field appropriately
    if ( $field_type == 'text' ) {
      $return_value = $field;
    } elseif ( $field_type == 'array' ) {
      foreach( $field as $key=>$value ) {
        if ( gettype( $value ) == 'string' || gettype( $value ) == 'integer' ) {
          $return_value .= $key.': '.$value.'<br />';
        } elseif ( gettype( $value ) == 'boolean' ) {
          $return_value .= $key.': '.( $value ? 'true' : 'false' ).'<br />';
        } else {
          $return_value .= $key.': [['.gettype( $value ).']]<br />';
        }
      }
    }

    // Generate the final debug block to return
    return '<div class="debug" style="background-color: '.$bg_color.'">
      <div class="debug-section">
        <div class="debug-title">'.$title.'</div>
        <div class="debug-value">'.$return_value.'</div>
      </div>
    </div>';

  // If test is false, return an empty string
  } else {
    return '';
  }

}


// FEED READER: Accept an RSS Feed URL and return an HTML block of articles
// $feed_url: The RSS Feed URL (string, required)
// $article_limit: The maximum number of articles you want to include (number, optional)
function singular_feed_reader( $feed_url, $article_limit = false ) {

  // Read the file into a string
  $content = file_get_contents( $feed_url );

  // Convert the string into an XML object
  $x = new SimpleXmlElement( $content );

  // Start code block
  $feed_return = '<div class="rss-feed-block">';

  // Set article item count
  $article_item = 1;

  // Add child for each XNL node
  foreach( $x->channel->item as $entry ) {

    // Add the article if 1. an article limit was set and we're still below the limit || 2. no article limit was set
    if ( ( $article_limit && $article_item <= $article_limit ) || !$article_limit ) {

      // Create usable date from pubDate node
      $feed_date = date( 'F j, Y', strtotime( $entry->pubDate ) );

      // Manufacture an image from the description if one is available
      // RegEx Solution: https://stackoverflow.com/a/143455
      // Pull images from the description
      preg_match_all( '/<img[^>]+>/i', $entry->description, $feed_image_array );

      // Try to use what would be the first image in the returned array
      if ( $feed_image_array[0][0] ) {

        // Pull the alt and src attributes from the image
        preg_match_all( '/(alt|src)=("[^"]*")/i', $feed_image_array[0][0], $feed_image_item );

        // Create an image tag -- note the array items include the wrapping quotes in-case you want to use a background image
        $feed_image = '<img src='.$feed_image_item[2][0].' alt='.$feed_image_item[2][1].' />';

      } else {

        // If there is no image in the array, set variable to false -- or you can set the default here
        $feed_image = false;

      }

      // Strip images and tags from the description node
      $feed_description = strip_tags( $entry->description, ['i','em','strong','b'] );

      // Assemble the feed item
      $feed_return .= '<div class="rss-feed-item item-'.$article_item.'">';
      $feed_return .= '<a class="rss-feed-item-link" href="'.$entry->link.'" title="'.$entry->title.'">';
      $feed_return .= '<span class="rss-feed-item-date">'.$feed_date.'</span>';
      $feed_return .= ( $feed_image ? '<span class="rss-feed-item-image">'.$feed_image.'</span>' : '' );
      $feed_return .= '<span class="rss-feed-item-title">'.$entry->title.'</span>';
      $feed_return .= '<span class="rss-feed-item-description">'.$feed_description.'</span>';
      $feed_return .= '</a>';
      $feed_return .= '</div>';

      // Increment the article item count
      $article_item++;

    } else {

      // Stop processing the XML feed if both conditional arguments fail
      break;

    }

  }

  // Close code block
  $feed_return .= '</div>';

  // Return code block
  return $feed_return;

}

// RANDOM ID: Generates a random ID
// $length: The number of characters to use in the ID
// $prefix: An optional prefix to include at the beginning of the string
function singular_random_id( $length = 10, $prefix = '' ) {

  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen( $characters );
  $randomString = '';

  for ( $i = 0; $i < $length; $i++ ) {
    $randomString .= $characters[random_int( 0, $charactersLength - 1 )];
  }

  return $prefix.$randomString;

}


// RETURN PRIMARY CATEGORY: Return the primary category's name for a post
// $cat_array: The array that wp_get_post_categories( $post->ID ) returns
// $pid: The $post->ID
// $default_cat: The default category we want to return (defaults to 1 "Uncategorized")
function singular_return_primary_category( $cat_array, $pid, $default_cat = 1 ) {

  // Set default value
  $return_cat = get_category( $default_cat )->name;

  // If there's only a single item in the arry -or- Yoast SEO is not installed, return the first item in the array
  if ( count( $cat_array ) == 1 || ( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) && !is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) ) {

    $return_cat = ( get_category( $cat_array[0] ) ? get_category( $cat_array[0] )->name : 'Article' );

  } else {

    // Iterate over each item in the array
    foreach ( $cat_array as $r ) {

      // If the ID matches Yoast's primary category, return it
      if ( get_post_meta( $pid, '_yoast_wpseo_primary_category', true ) == $r ) {
        $return_cat = get_category( $r )->name;
      }

    } 

  }

  // Return the category
  return $return_cat;

}


// TIME EXPIRATION: Checks to see if a timestamp 
// $compare_date: The date we're checking against time()
function singular_time_expiration( $compare_date ) {

  // Return whether or not the current time is greater than the expiration time
  return time() > ( strtotime( $compare_date ) + 14400 );

}


// THEME FILEMTIME: This returns the timestamp of a file's modification time within the theme
// $file: Relative path to the theme file
function singular_theme_filemtime( $file ) {
  return filemtime( get_template_directory().$file );
}


// YOUTUBE THUMBNAIL: This returns the thumbnail of a YouTube video
// https://support.advancedcustomfields.com/forums/topic/youtube-thumbnail-object-with-oembed-field/
// https://stackoverflow.com/questions/34763547/youtube-maxresdefault-thumbnails
// $oembed: The oembed code
function singular_youtube_thumbnail( $oembed ) {
  
  // Pull the src attribute from the oembed code
  preg_match('/src="(.+?)"/', $oembed, $matches_url );

  // Just pull the URL from the src attribute
  $src = $matches_url[1];	

  // Do a rough check to confirm that the URL is a youtube embed src
  if ( str_contains( $src, 'you' ) || str_contains( $src, 'tube' ) ) {

    // Pull just the portion containing the ID
    preg_match('/embed(.*?)?feature/', $src, $matches_id );

    // Pull the ID from the previous string
    $id = $matches_id[1];

    // Replace anything before the code with nothing
    $id = str_replace( str_split( '?/' ), '', $id );

    // Return the highest resolution thumbnail image
    return '<img src="http://img.youtube.com/vi/'.$id.'/maxresdefault.jpg">';

  } else {

    return false;

  }

}
?>
