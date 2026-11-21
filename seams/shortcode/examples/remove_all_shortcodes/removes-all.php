<?php
// Empties $shortcode_tags.
add_shortcode( 'a', fn() => 'A' );
add_shortcode( 'b', fn() => 'B' );
remove_all_shortcodes();
return $GLOBALS['shortcode_tags'];
