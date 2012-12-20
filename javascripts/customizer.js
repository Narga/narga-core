( function( $ ) {
  var api = wp.customize;

  //Refresh frame to view post grid layouts
  wp.customize( 'posts_grid_layout', function( value ) {
    value.bind( function( newval ) {
      $('article').css('columns', newval );
    } );
  } );

  //Refresh frame when change to excerpt
  wp.customize( 'posts_excerpt', function( value ) {
    value.bind( function( newval ) {
      $('article').css('columns', newval );
    } );
  } );

} )( jQuery );
