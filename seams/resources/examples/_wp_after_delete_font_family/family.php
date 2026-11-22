<?php
// Deletes a font family's font faces after the family is deleted.
$family = wp_insert_post( array( 'post_type' => 'wp_font_family', 'post_title' => 'Inter', 'post_status' => 'publish' ) );
$face = wp_insert_post( array( 'post_type' => 'wp_font_face', 'post_parent' => $family, 'post_status' => 'publish' ) );
wp_delete_post( $family, true );
return get_post( $face );
