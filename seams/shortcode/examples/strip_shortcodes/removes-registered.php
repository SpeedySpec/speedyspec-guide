<?php
// Removes registered shortcodes, with their content when enclosing, and leaves others.
add_shortcode( 'box', fn( $a, $c ) => $c );
return strip_shortcodes( 'a [box]inside[/box] b [unregistered] c' );
