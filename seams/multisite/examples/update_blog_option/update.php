<?php
// Sets a site's option.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
update_blog_option( $site, 'blogname', 'Renamed' );
return get_blog_option( $site, 'blogname' );
