<?php
// Creates the multisite tables, for turning a site into a network.
install_network();
global $wpdb;
return $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->base_prefix}blogs'" ) !== null;
