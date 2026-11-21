<?php
// do_shortcode_tag filters the callback's output.
add_shortcode( 'greet', fn() => 'Hello' );
add_filter( 'do_shortcode_tag', fn( $output ) => "<b>$output</b>" );
return do_shortcode( '[greet]' );
