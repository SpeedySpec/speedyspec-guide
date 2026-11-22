<?php
// Whether switch_to_blog() is in effect.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
switch_to_blog( $site );
$in = ms_is_switched();
restore_current_blog();
return array( $in, ms_is_switched() );
