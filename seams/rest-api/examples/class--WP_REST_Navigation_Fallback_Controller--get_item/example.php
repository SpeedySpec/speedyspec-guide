<?php
// The navigation fallback controller gives the Navigation block a menu to show at /wp-block-editor/v1/navigation-fallback: the newest wp_navigation post, else one made from a classic menu or the page list.
$data = guide_rest( 'GET', '/wp-block-editor/v1/navigation-fallback' )[1];
$post = get_post( $data['id'] );
return array( $post->post_type, $post->post_status, guide_rest( 'GET', '/wp-block-editor/v1/navigation-fallback' )[1]['id'] === $data['id'] );
