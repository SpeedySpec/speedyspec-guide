<?php
// apply_shortcodes() is do_shortcode() under a clearer name.
add_shortcode( 'greet', fn() => 'Hello' );
return apply_shortcodes( '[greet]' );
