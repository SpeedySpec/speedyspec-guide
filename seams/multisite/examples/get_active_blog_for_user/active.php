<?php
// The site a user is primarily on: their primary_blog when they still belong to it, else the first of their sites (which becomes primary), else null.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
add_user_to_blog( $site, $grace, 'author' );
return array( get_active_blog_for_user( $grace )->blog_id, (int) get_user_meta( $grace, 'primary_blog', true ) );
