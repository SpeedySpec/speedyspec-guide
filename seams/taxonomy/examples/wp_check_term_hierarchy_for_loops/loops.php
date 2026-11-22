<?php
// On wp_update_term_parent: a parent that would put the term in a loop (here News under its own child Local) is refused with 0; a loop elsewhere in the ancestry is broken by setting its members' parents to 0. A parent without a loop is kept.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$extra = wp_insert_term( 'Extra', 'category' )['term_id'];
return array( wp_check_term_hierarchy_for_loops( $local['term_id'], $news['term_id'], 'category' ), wp_check_term_hierarchy_for_loops( $extra, $local['term_id'], 'category' ) == $extra, wp_check_term_hierarchy_for_loops( 0, $local['term_id'], 'category' ) );
