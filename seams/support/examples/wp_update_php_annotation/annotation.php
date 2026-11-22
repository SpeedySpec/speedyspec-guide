<?php
// Prints (or gives) a note, between the markup given, that the PHP update link comes from the host, when it isn't WordPress.org's.
add_filter( 'wp_update_php_url', fn() => 'https://host.example/php' );
return wp_update_php_annotation( '<p>', '</p>', false );
