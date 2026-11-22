<?php
// Sets a post's terms in a taxonomy, by names or IDs (IDs for hierarchical taxonomies), replacing or appending; the term taxonomy IDs.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$terms = wp_set_post_terms( $id, array( 'one', 'two' ), 'post_tag' );
return array( count( $terms ), wp_get_post_terms( $id, 'post_tag', array( 'fields' => 'names' ) ) );
