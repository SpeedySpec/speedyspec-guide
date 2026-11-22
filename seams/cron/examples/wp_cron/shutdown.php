<?php
// Arranges for due events to be spawned at shutdown (or at wp_loaded with ALTERNATE_WP_CRON).
wp_cron();
return has_action( 'shutdown', '_wp_cron' );
