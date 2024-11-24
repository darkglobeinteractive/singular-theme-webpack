jQuery(document).ready(function($) {

  if ( typeof acf !== 'undefined' ) {

    // Set color picker defaults to color palette
    // https://www.advancedcustomfields.com/resources/javascript-api/#filters-color_picker_args
    acf.add_filter('color_picker_args', function( args, $field ){

      // var field_info = $field[0]['dataset'];
      // console.log('Field Key: '+field_info['key']);
      // console.log('Field Name: '+field_info['name']);
      // console.log('Field Type: '+field_info['type']);

      // do something to args
      args.palettes = ['#0000ff', '#ff0000', '#000000', '#ffffff' ];

      // return
      return args;

    });

  }  

});