<?php
// The terms controller serves each taxonomy shown in REST at its rest_base (categories, tags, a custom taxonomy's): terms listed, read, created, updated and deleted (terms have no trash, so deleting needs force), with their parent, description and meta.
[ $status, $term ] = guide_rest( 'POST', '/wp/v2/categories', array( 'name' => 'Guides', 'description' => 'How-tos' ) );
$child = guide_rest( 'POST', '/wp/v2/categories', array( 'name' => 'Basics', 'parent' => $term['id'] ) )[1];
$soft = guide_rest( 'DELETE', "/wp/v2/categories/{$child['id']}" );
$hard = guide_rest( 'DELETE', "/wp/v2/categories/{$child['id']}", array( 'force' => true ) );
return array( $status, $term['slug'], $child['parent'] === $term['id'], $soft[0], $soft[1]['code'], $hard[0], $hard[1]['deleted'] );
