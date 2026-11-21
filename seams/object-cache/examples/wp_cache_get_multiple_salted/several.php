<?php
// Reads several salted values; a key with another salt, or none, is false.
wp_cache_set_salted( 'a', 1, 'posts', 's' );
wp_cache_set_salted( 'b', 2, 'posts', 'other' );
return wp_cache_get_multiple_salted( array( 'a', 'b', 'c' ), 'posts', 's' );
