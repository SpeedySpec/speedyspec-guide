<?php
// A site's ID by domain and path (0 when none matches), cached in the blog-id-cache group.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_blog_id_from_url( 'example.org', '/second/' ), get_blog_id_from_url( 'example.org', '/nope/' ) );
