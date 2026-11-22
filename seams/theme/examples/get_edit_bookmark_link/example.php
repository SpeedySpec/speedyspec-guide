<?php
// A link's edit screen URL, for users who can manage links, which needs the links manager turned on (link_manager_enabled); filtered by get_edit_bookmark_link.
$link = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress' ) );
$off = get_edit_bookmark_link( $link );
update_option( 'link_manager_enabled', 1 );
return array( $off, get_edit_bookmark_link( $link ) );
