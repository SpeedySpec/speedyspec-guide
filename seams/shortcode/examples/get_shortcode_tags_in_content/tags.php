<?php
// Every registered tag used in content, in order and repeated, including inside enclosing shortcodes.
add_shortcode( 'a', fn() => 'A' );
add_shortcode( 'b', fn( $atts, $content ) => $content );
return get_shortcode_tags_in_content( '[a] text [b x=1][a][/b] [unregistered]' );
