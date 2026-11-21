<?php
// After removal the tag is left in the content as written.
add_shortcode( 'greet', fn() => 'Hello' );
remove_shortcode( 'greet' );
return do_shortcode( '[greet]' );
