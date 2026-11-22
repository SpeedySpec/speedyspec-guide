<?php
// A link from the links manager as an object, array or list, by ID; filtered for display or another context.
$link = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress', 'link_rating' => 8 ) );

$bookmark = get_bookmark( $link );
return array( $bookmark->link_name, $bookmark->link_url, get_bookmark( $link, ARRAY_A )['link_rating'] );
