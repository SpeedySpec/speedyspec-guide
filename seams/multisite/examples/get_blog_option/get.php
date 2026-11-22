<?php
// An option of another site, switching to it to read; the current site's is read directly.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_blog_option( $site, 'blogname' ), get_blog_option( $site, 'nope', 'default' ) );
