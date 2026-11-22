<?php
// An author's archive URL, by ID or nicename; filtered by author_link.
$plain = get_author_posts_url( 1 );
update_option( 'permalink_structure', '/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( $plain, get_author_posts_url( 1 ) );
