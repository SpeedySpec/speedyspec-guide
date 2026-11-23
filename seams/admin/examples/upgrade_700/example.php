<?php
// Runs the changes WordPress 7.0 made to stored data, such as moving users of the fresh admin color scheme to modern, for a site whose database is older; upgrade_all() calls it by database version.
$before = get_option( 'db_version' );
upgrade_700();
return get_option( 'db_version' ) === $before;
