<?php
// A term's archive URL: through the taxonomy's permalink structure when it has one (with parents for hierarchical ones), else a query string as here with plain permalinks; term_link and the taxonomy's own link filters apply.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( get_term_link( $local['term_id'], 'category' ), get_term_link( 'alpha', 'post_tag' ), get_term_link( 999, 'category' )->get_error_code() );
