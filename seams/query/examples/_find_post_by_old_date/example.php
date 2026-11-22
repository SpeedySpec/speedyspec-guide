<?php
// The ID of a post of a type whose old date and slug match the queried ones, or 0.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

update_post_meta( $id, '_wp_old_date', '2020-01-01' );
guide_go( '/?name=hello&year=2020' );
return _find_post_by_old_date( 'post' ) === $id;
