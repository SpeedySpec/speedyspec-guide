<?php
// The block patterns and pattern categories controllers list the registered patterns at /wp/v2/block-patterns/patterns and their categories at /wp/v2/block-patterns/categories, for users who can edit posts.
register_block_pattern_category( 'guide', array( 'label' => 'Guide' ) );
register_block_pattern( 'guide/hello', array( 'title' => 'Hello', 'categories' => array( 'guide' ), 'content' => '<!-- wp:paragraph --><p>Hello</p><!-- /wp:paragraph -->' ) );
$patterns = guide_rest( 'GET', '/wp/v2/block-patterns/patterns' )[1];
$mine = array_values( array_filter( $patterns, fn( $p ) => 'guide/hello' === $p['name'] ) )[0];
$categories = array_column( guide_rest( 'GET', '/wp/v2/block-patterns/categories' )[1], 'name' );
return array( $mine['title'], $mine['categories'], in_array( 'guide', $categories, true ) );
