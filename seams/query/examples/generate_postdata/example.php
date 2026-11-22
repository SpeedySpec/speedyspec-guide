<?php
// The template globals setup_postdata() would set for a post, without setting them.
$id = wp_insert_post( array( 'post_title' => 'Paged', 'post_status' => 'publish', 'post_content' => 'one<!--nextpage-->two' ) );
$data = generate_postdata( $id );
return array( $data['numpages'], $data['multipage'], $data['pages'] );
