<?php
// Prints the <html> element's class attribute from twentytwentyone_html_classes; nothing when there are none.
guide_theme( 'twentytwentyone' );
$none = guide_render( 'twentytwentyone_the_html_classes' );
add_filter( 'twentytwentyone_html_classes', fn( $c ) => trim( $c . ' extra' ) );
return array( $none, guide_render( 'twentytwentyone_the_html_classes' ) );
