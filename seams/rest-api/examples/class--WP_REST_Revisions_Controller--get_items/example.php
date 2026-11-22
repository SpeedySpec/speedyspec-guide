<?php
// The revisions controller: a post's revisions at /<rest_base>/<parent>/revisions, for post types that support revisions; listed and read; deleting needs force and the delete_post capability on the revision itself, which map_meta_cap() refuses for revisions, so even administrators can't unless a plugin grants it.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v3', 'post_content' => 'three' ) );
$revisions = guide_rest( 'GET', "/wp/v2/posts/$id/revisions" )[1];
$hard = guide_rest( 'DELETE', "/wp/v2/posts/$id/revisions/{$revisions[1]['id']}", array( 'force' => true ) );
return array( array_map( fn( $r ) => $r['title']['rendered'], $revisions ), $revisions[0]['parent'] === $id, $hard[0], $hard[1]['code'] );
