<?php
// Keeps a site's blog_public option in step with its public flag.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_update_site( $site, array( 'public' => 0 ) );
return get_blog_option( $site, 'blog_public' );
