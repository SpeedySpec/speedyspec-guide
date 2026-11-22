<?php
// A year archive's URL, the current year when false; filtered by year_link.
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return get_year_link( 2026 );
