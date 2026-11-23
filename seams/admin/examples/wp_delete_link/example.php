<?php
// Deletes a link and its category relationships, firing delete_link and deleted_link.
$id = wp_insert_link( array( 'link_url' => 'https://example.org/', 'link_name' => 'Example' ) );
return array( wp_delete_link( $id ), get_bookmark( $id ) );
