<?php
// Registers a callback; do_shortcode() replaces the tag with what it returns.
add_shortcode( 'greet', fn( $atts ) => 'Hello, ' . ( $atts['name'] ?? 'you' ) );
return do_shortcode( 'Say: [greet name="Ada"] and [greet]' );
