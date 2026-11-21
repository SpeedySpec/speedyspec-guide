<?php
// An array is stored serialized and comes back as an array.
add_option( 'guide_list', array( 'a', 'b' ) );
wp_cache_flush();
return get_option( 'guide_list' );
