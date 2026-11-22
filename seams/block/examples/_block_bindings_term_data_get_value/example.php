<?php
// The value of a term field (name, link, description, count) for a block bound to core/term-data, for the term in context.
$term = wp_insert_term( 'Recipes', 'category', array( 'description' => 'Things to cook.' ) );
$block = new WP_Block( parse_blocks( '<!-- wp:paragraph --><p></p><!-- /wp:paragraph -->' )[0] );
$block->context = array( 'termId' => $term['term_id'], 'taxonomy' => 'category' );
return array( _block_bindings_term_data_get_value( array( 'field' => 'name' ), $block ), _block_bindings_term_data_get_value( array( 'field' => 'description' ), $block ) );
