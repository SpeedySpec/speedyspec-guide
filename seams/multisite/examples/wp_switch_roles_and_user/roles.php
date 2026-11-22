<?php
// Reloads the roles and the current user's capabilities for the new site after a switch; on switch_blog.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
switch_to_blog( $site );
$caps = wp_get_current_user()->get_site_id();
restore_current_blog();
return $caps;
