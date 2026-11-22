<?php
// Updates a term's name, slug, description or parent; a slug used by another term or a parent that would make a loop is refused. edit_term, edited_term and related actions fire.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
function guide_report_edited_category( $id ) {
	echo "edited_category\n";
}
add_action( 'edited_category', 'guide_report_edited_category' );
$ok = wp_update_term( $local['term_id'], 'category', array( 'name' => 'Local News', 'description' => 'Near' ) );
$term = get_term( $local['term_id'] );
return array( array_keys( $ok ), $term->name, $term->slug, $term->description, wp_update_term( $local['term_id'], 'category', array( 'slug' => 'news' ) )->get_error_code(), wp_update_term( 999, 'category' )->get_error_code() );
