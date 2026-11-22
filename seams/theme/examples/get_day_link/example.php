<?php
// A day archive's URL; filtered by day_link.
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return get_day_link( 2026, 3, 15 );
