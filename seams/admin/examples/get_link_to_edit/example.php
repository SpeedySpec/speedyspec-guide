<?php
// A link with its fields escaped for the edit form.
$id = wp_insert_link( array( 'link_url' => 'https://example.org/', 'link_name' => 'Tea & co' ) );
return get_link_to_edit( $id )->link_name;
