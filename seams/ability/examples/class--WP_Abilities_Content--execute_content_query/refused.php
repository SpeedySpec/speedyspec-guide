<?php
// Filters that can't be honoured are refused before any query, so the query never widens. (WordPress hooks sanitize_title_with_dashes() to sanitize_title by default.)
add_filter( 'sanitize_title', 'sanitize_title_with_dashes', 10, 3 );
guide_core_abilities();
$content = new WP_Abilities_Content();
$calls = array(
	array( 'where' => 'x' ),
	array( 'where' => array( 'type' => 'nope' ) ),
	array( 'where' => array( 'type' => 'guide_note', 'parent' => 1 ) ),
	array( 'where' => array( 'type' => 'guide_note', 'author' => array( 'id' => 1 ) ) ),
	array( 'where' => array( 'type' => 'guide_note', 'ids' => array( 0, 1.5 ) ) ),
	array( 'where' => array( 'type' => 'guide_note', 'slugs' => '!!!' ) ),
	array( 'where' => array( 'type' => 'guide_note', 'status' => array( 'trash' ) ) ),
);
return array_map( fn( $input ) => guide_private( $content, 'execute_content_query', $input )->get_error_message(), $calls );
