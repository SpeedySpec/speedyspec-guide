<?php
// Goes back to the site before the last switch_to_blog(); false when nothing was switched.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
switch_to_blog( $site );
$back = restore_current_blog();
return array( $back, get_current_blog_id(), restore_current_blog() );
