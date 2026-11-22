<?php
// The posts controller serves each post type shown in REST at its rest_base (posts, pages, a custom type's): listing with query arguments, reading, creating, updating and deleting posts, with their terms, meta, featured media and template.
$cat = wp_insert_term( 'News', 'category' )['term_id'];
[ $status, $post ] = guide_rest( 'POST', '/wp/v2/posts', array( 'title' => 'Hello REST', 'content' => 'Body', 'status' => 'publish', 'categories' => array( $cat ) ) );
$list = guide_rest( 'GET', '/wp/v2/posts', array( 'categories' => $cat, '_fields' => 'id,title' ) )[1];
[ $deleted ] = guide_rest( 'DELETE', "/wp/v2/posts/{$post['id']}" );
return array( $status, $post['title']['raw'], $post['categories'] === array( $cat ), count( $list ), $deleted, get_post_status( $post['id'] ) );
