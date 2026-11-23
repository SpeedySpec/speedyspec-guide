<?php
// Ajax handler that deletes a link from the Links list, answering 1 on success.
update_option( 'link_manager_enabled', 1 );
$id = wp_insert_link( array( 'link_name' => 'Example', 'link_url' => 'https://example.org/' ) );
return array( guide_ajax( 'wp_ajax_delete_link', array( 'id' => $id ), "delete-bookmark_$id" ), get_bookmark( $id ) === null );
