<?php
// A post's embed URL: /embed/ after its permalink, or ?embed=true with plain permalinks; post_embed_url filters it.
$post = guide_post();
function guide_add_embed_url_query( $url, $post ) {
	return $url . '&guide=1';
}
add_filter( 'post_embed_url', 'guide_add_embed_url_query', 10, 2 );
return array( get_post_embed_url( $post ), get_post_embed_url( 999 ) );
