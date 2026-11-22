<?php
// Runs the database upgrade when the stored database version is older than this WordPress's, then fires wp_upgrade.
wp_upgrade();
return did_action( 'wp_upgrade' );
