<?php
// Adds an option to a site.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_blog_option( $site, 'guide', 'x' );
return get_blog_option( $site, 'guide' );
