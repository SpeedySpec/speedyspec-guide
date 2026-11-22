<?php
// Lets a request for a site through, or stops it: deleted sites (410), inactive sites and archived or spam sites, each with a drop-in page when there is one; super admins always pass, and ms_site_check can answer.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
switch_to_blog( $site );
wp_update_site( $site, array( 'archived' => 1 ) );
$super = ms_site_check();
wp_set_current_user( 0 );
add_filter( 'wp_die_handler', fn() => function ( $message, $title = '', $args = array() ) { throw new RuntimeException( wp_strip_all_tags( is_wp_error( $message ) ? $message->get_error_message() : $message ) ); } );
try { ms_site_check(); } catch ( RuntimeException $e ) { return array( $super, $e->getMessage() ); }
