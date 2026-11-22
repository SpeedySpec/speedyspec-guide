<?php
// A post's terms in a taxonomy, post_tag by default, through wp_get_object_terms().
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_set_post_terms( $id, 'green', 'post_tag' );
return wp_get_post_terms( $id, 'post_tag', array( 'fields' => 'slugs' ) );
