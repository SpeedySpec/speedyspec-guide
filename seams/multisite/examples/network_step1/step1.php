<?php
// Prints the first step of network setup: the choice of subdomains or subdirectories, the network title and admin email; on an existing network it says so instead.
require_once ABSPATH . 'wp-admin/includes/network.php';
$GLOBALS['wpdb']->query( 'SELECT 1' );
return substr( wp_strip_all_tags( guide_render( 'network_step1' ) ), 0, 120 );
