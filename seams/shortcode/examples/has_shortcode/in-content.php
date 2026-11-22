<?php
// Says whether content uses a registered shortcode, including inside another shortcode's content.
add_shortcode( 'box', fn( $a, $c ) => $c );
add_shortcode( 'greet', fn() => 'Hello' );
return array( has_shortcode( '[box][greet][/box]', 'greet' ), has_shortcode( 'no tags', 'greet' ), has_shortcode( '[unregistered]', 'unregistered' ) );
