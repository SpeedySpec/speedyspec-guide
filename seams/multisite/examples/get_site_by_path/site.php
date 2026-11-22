<?php
// The site best matching a domain and path: the longest path match, checking www and non-www domains, segments limited by site_by_path_segments_count; pre_get_site_by_path can answer.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_site_by_path( 'example.org', '/second/page/' )->blog_id, get_site_by_path( 'example.org', '/nothing/' )->blog_id, get_site_by_path( 'other.example', '/' ) );
