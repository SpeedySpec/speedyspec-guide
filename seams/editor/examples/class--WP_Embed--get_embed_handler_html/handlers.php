<?php
// The first registered handler (by priority) whose pattern matches and whose callback doesn't return false; embed_handler_html filters its HTML.
$embed = new WP_Embed();
$embed->register_handler( 'never', '#x#', '__return_false', 1 );
$embed->register_handler( 'x', '#x\.example/(\d+)#', fn( $m ) => "item {$m[1]}", 5 );
add_filter( 'embed_handler_html', fn( $html, $url, $attr ) => "<div>$html</div>", 10, 3 );
return array( $embed->get_embed_handler_html( array(), 'https://x.example/7' ), $embed->get_embed_handler_html( array(), 'https://y.example/' ) );
