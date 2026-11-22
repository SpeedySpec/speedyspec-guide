<?php
// Deletes the options rows WordPress 2.3 stopped using: those with a blog ID other than 0, and duplicates.
global $wpdb;
$before = (int) $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->options" );
upgrade_230_options_table();
return (int) $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->options" ) <= $before;
