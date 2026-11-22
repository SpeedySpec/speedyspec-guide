<?php
// For a post type with authors and a hierarchy, the author filter needs an id or a slug, and parent a non-negative integer.
guide_core_abilities();
register_post_type( 'guide_page', array( 'public' => true, 'show_in_abilities' => true, 'hierarchical' => true, 'supports' => array( 'title', 'author' ), 'rewrite' => false, 'query_var' => false ) );
$content = new WP_Abilities_Content();
$calls = array(
	array( 'type' => 'guide_page', 'author' => array() ),
	array( 'type' => 'guide_page', 'author' => array( 'name' => 'x' ) ),
	array( 'type' => 'guide_page', 'author' => array( 'id' => 0 ) ),
	array( 'type' => 'guide_page', 'author' => array( 'slug' => '' ) ),
	array( 'type' => 'guide_page', 'parent' => -1 ),
);
return array_map( fn( $where ) => guide_private( $content, 'execute_content_query', array( 'where' => $where ) )->get_error_message(), $calls );
