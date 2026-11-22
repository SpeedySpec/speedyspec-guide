<?php
// Whether WordPress is installing (WP_INSTALLING); given a value, sets it and gives the old one.
$was = wp_installing( true );
$now = wp_installing();
wp_installing( $was );
return array( $was, $now );
