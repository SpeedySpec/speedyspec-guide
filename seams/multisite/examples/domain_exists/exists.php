<?php
// The ID of the site with a domain and path on a network, or null; domain_exists filters it.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( domain_exists( 'example.org', '/second/' ), domain_exists( 'example.org', '/nope/' ) );
