<?php
// Content with no [ is returned untouched.
add_shortcode( 'greet', fn() => 'Hello' );
return do_shortcode( 'plain text' );
