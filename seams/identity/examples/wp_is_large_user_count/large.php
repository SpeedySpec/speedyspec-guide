<?php
// Whether the site has over 10,000 users, the point where user lists stop counting; wp_is_large_user_count filters it.
add_filter( 'wp_is_large_user_count', fn( $large, $count ) => $count > 0, 10, 2 );
return wp_is_large_user_count();
