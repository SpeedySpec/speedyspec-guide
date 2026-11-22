<?php
// The types, statuses and taxonomies controllers describe the registered post types, post statuses and taxonomies shown in REST, at /wp/v2/types, /wp/v2/statuses and /wp/v2/taxonomies.
$types = guide_rest( 'GET', '/wp/v2/types' )[1];
$statuses = guide_rest( 'GET', '/wp/v2/statuses' )[1];
$tax = guide_rest( 'GET', '/wp/v2/taxonomies/category' )[1];
wp_set_current_user( 0 );
return array( array_slice( array_keys( $types ), 0, 3 ), $types['post']['rest_base'], array_keys( $statuses ), $tax['types'], array_keys( guide_rest( 'GET', '/wp/v2/statuses' )[1] ) );
