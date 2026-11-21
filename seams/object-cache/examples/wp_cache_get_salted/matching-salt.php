<?php
// A salted value reads back only with the same salt.
wp_cache_set_salted( 'k', 'v', 'posts', 'salt-1' );
return array( wp_cache_get_salted( 'k', 'posts', 'salt-1' ), wp_cache_get_salted( 'k', 'posts', 'salt-2' ) );
