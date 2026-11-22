<?php
// Deletes a post's _oembed_ meta, so its embeds are fetched again.
$post = guide_post();
add_post_meta( $post, '_oembed_abc', '<iframe></iframe>' );
add_post_meta( $post, '_oembed_time_abc', 1 );
add_post_meta( $post, 'other', 'kept' );
$GLOBALS['wp_embed']->delete_oembed_caches( $post );
return get_post_custom_keys( $post );
