<?php
// A value other than false from pre_do_shortcode_tag replaces the shortcode without running its callback.
add_shortcode( 'greet', function () { echo 'ran '; return 'Hello'; } );
add_filter( 'pre_do_shortcode_tag', fn( $return, $tag ) => 'greet' === $tag ? 'Skipped' : $return, 10, 2 );
return do_shortcode( '[greet]' );
