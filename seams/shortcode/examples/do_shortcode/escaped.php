<?php
// A tag in double brackets is printed as a single-bracket tag instead of being run.
add_shortcode( 'greet', fn() => 'Hello' );
return do_shortcode( '[[greet]]' );
