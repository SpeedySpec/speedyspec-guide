<?php
// Deletes a site's option.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_blog_option( $site, 'guide', 'x' );
delete_blog_option( $site, 'guide' );
return get_blog_option( $site, 'guide' );
