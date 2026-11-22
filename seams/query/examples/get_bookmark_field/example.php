<?php
// One field of a link, sanitized for a context, display by default.
$link = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress', 'link_rating' => 8 ) );

return array( get_bookmark_field( 'link_name', $link ), get_bookmark_field( 'link_url', $link, 'raw' ) );
