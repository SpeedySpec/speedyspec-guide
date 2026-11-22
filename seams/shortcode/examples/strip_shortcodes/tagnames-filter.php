<?php
// strip_shortcodes_tagnames chooses which registered tags are stripped.
add_shortcode( 'a', fn() => 'A' );
add_shortcode( 'b', fn() => 'B' );
add_filter( 'strip_shortcodes_tagnames', fn() => array( 'a' ) );
return strip_shortcodes( '[a] [b]' );
