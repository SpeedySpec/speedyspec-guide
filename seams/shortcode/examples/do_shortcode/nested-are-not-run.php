<?php
// Shortcodes inside an enclosing shortcode's content run only if its callback calls do_shortcode() on it.
add_shortcode( 'raw', fn( $a, $c ) => $c );
add_shortcode( 'run', fn( $a, $c ) => do_shortcode( $c ) );
add_shortcode( 'greet', fn() => 'Hello' );
return array( do_shortcode( '[raw][greet][/raw]' ), do_shortcode( '[run][greet][/run]' ) );
