<?php
// Updates a link from its link_id and the fields given.
$id = wp_insert_link( array( 'link_url' => 'https://example.org/', 'link_name' => 'Example' ) );
wp_update_link( array( 'link_id' => $id, 'link_name' => 'Example site' ) );
return get_bookmark( $id )->link_name;
