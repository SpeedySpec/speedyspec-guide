<?php
// Stores several values with one salt.
wp_cache_set_multiple_salted( array( 'a' => 1, 'b' => 2 ), 'posts', 's' );
return wp_cache_get_multiple_salted( array( 'a', 'b' ), 'posts', 's' );
