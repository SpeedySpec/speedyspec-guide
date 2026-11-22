<?php
// A field of a site's row, such as public or archived; null for an unknown site.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_blog_status( $site, 'public' ), get_blog_status( 999, 'public' ) );
