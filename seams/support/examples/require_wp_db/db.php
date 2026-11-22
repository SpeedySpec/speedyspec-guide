<?php
// Loads the database class and makes $wpdb from the DB_ constants, unless a db.php drop-in already made it.
require_wp_db();
return get_class( $GLOBALS['wpdb'] );
