<?php
// Creates or updates a link from its fields (URL, name, target, visibility, categories and the rest); gives its ID, 0 or an error.
$id = wp_insert_link( array( 'link_url' => 'https://example.org/', 'link_name' => 'Example', 'link_target' => '_blank' ) );
$link = get_bookmark( $id );
return array( $link->link_name, $link->link_target, $link->link_visible );
