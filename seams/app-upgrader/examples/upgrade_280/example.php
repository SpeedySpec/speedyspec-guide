<?php
// Runs the changes WordPress 2.8 made to stored data, for a site whose database is older; upgrade_all() calls it by database version.
$before = get_option( 'db_version' );
upgrade_280();
return get_option( 'db_version' ) === $before;
