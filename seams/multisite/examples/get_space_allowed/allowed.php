<?php
// The megabytes of uploads a site may use: its blog_upload_space option, else the network's, else 100; get_space_allowed filters it.
$default = get_space_allowed();
update_site_option( 'blog_upload_space', 50 );
$network = get_space_allowed();
update_option( 'blog_upload_space', 5 );
return array( $default, $network, get_space_allowed() );
