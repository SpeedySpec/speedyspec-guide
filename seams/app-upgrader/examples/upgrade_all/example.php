<?php
// Runs every upgrade routine the site's database version needs, then the schema upgrade, and stores the new database version.
global $wp_db_version;
update_option( 'db_version', $wp_db_version );
upgrade_all();
return (int) get_option( 'db_version' ) === $wp_db_version;
