<?php
// Sets up a new site: its tables, options (title, URL, admin email, language, public), the default content and the admin user's role; an error when it is already set up.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/fresh/' ) );
return array( wp_is_site_initialized( $site ), wp_initialize_site( $site )->get_error_code() );
