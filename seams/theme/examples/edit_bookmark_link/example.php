<?php
// Prints a link to edit a link, for users who can manage links (the links manager must be on); filtered by edit_bookmark_link.
$link = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress' ) );
$off = guide_render( fn() => edit_bookmark_link( 'Edit', '', '', $link ) );
update_option( 'link_manager_enabled', 1 );
return array( $off, guide_render( fn() => edit_bookmark_link( 'Edit', '', '', $link ) ) );
