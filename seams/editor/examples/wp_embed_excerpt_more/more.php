<?php
// In a post's embed view, the excerpt ends with a Continue reading link; elsewhere the text is kept.
$post = guide_post();
guide_view( $post );
$normal = wp_embed_excerpt_more( '[...]' );
guide_view( $post, array( 'embed' => true ) );
return array( $normal, wp_embed_excerpt_more( '[...]' ) );
