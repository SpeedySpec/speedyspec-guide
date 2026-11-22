<?php
// Runs only the [embed] shortcode over content (before wpautop), leaving other shortcodes for later.
add_shortcode( 'other', fn() => 'OTHER' );
return $GLOBALS['wp_embed']->run_shortcode( '[other] [embed]https://unknown.example/x[/embed]' );
