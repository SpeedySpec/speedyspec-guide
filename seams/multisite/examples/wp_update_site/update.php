<?php
// Changes a site's data, validated, and fires wp_update_site with the new and old site; an error for an unknown site.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_update_site( $site, array( 'archived' => 1 ) );
return array( get_site( $site )->archived, wp_update_site( 999, array() )->get_error_code() );
