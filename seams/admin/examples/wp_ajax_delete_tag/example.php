<?php
// Ajax handler that deletes a term from its list table row, answering 1 on success.
$term = wp_insert_term( 'oolong', 'post_tag' );
$id = $term['term_id'];
$sent = guide_ajax( 'wp_ajax_delete_tag', array( 'tag_ID' => $id, 'taxonomy' => 'post_tag' ), "delete-tag_$id" );
return array( $sent, term_exists( 'oolong', 'post_tag' ) );
