<?php
// A post's embed URL: /embed/ after its permalink, or ?embed=true with plain permalinks; post_embed_url filters it.
$post = guide_post();
add_filter( 'post_embed_url', fn( $url, $post ) => $url . '&guide=1', 10, 2 );
return array( get_post_embed_url( $post ), get_post_embed_url( 999 ) );
