<?php
// Deletes a site: wp_validate_site_deletion can refuse it with errors, wp_uninitialize_site drops its tables and files, then its row and meta go and wp_delete_site fires. Gives the deleted site, or an error for an unknown one.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$deleted = wp_delete_site( $site );
return array( $deleted->path, get_site( $site ), wp_delete_site( 999 )->get_error_code() );
