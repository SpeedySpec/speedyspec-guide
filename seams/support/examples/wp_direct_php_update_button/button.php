<?php
// Prints a button to the host's one-step PHP update, when there is one.
add_filter( 'wp_direct_php_update_url', fn() => 'https://host.example/update' );
return guide_render( 'wp_direct_php_update_button' );
