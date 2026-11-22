<?php
// Turns the Links screen off on upgrade when the site has no links.
global $wp_current_db_version;
$wp_current_db_version = 21000;
maybe_disable_link_manager();
return get_option( 'link_manager_enabled' );
