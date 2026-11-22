<?php
// A search's URL, the current search when empty; filtered by search_link.
$plain = get_search_link( 'red apples' );
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( $plain, get_search_link( 'red apples' ) );
