<?php
// A month archive's URL; filtered by month_link.
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return get_month_link( 2026, 3 );
