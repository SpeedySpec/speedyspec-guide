<?php
// An enclosing shortcode gets its content as the second argument, and its tag as the third.
add_shortcode( 'box', fn( $atts, $content, $tag ) => "<div class=\"$tag\">$content</div>" );
return do_shortcode( '[box]inside[/box]' );
