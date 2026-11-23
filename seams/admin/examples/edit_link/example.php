<?php
// Creates or updates a link from the link form's submitted fields; gives its ID.
update_option( 'link_manager_enabled', 1 );
$id = wp_insert_link( array( 'link_url' => 'https://example.org/', 'link_name' => 'Example' ) );
$_POST = array( 'link_url' => 'https://example.org/', 'link_name' => 'Example site' );
edit_link( $id );
return get_bookmark( $id )->link_name;
