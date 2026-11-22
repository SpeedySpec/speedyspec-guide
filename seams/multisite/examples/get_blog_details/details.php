<?php
// A site's details by ID, name or domain and path, with blogname, siteurl, post_count and home unless only the basics are asked for; cached.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$details = get_blog_details( $site );
return array( $details->blogname, $details->siteurl, get_blog_details( array( 'domain' => 'example.org', 'path' => '/second/' ) )->blog_id, get_blog_details( 999 ) );
