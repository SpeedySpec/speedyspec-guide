<?php
// The blocks controller serves synced patterns (wp_block posts) at /wp/v2/blocks: a posts controller whose patterns are readable only by users who can edit them, with the title and content always raw.
[ $status, $block ] = guide_rest( 'POST', '/wp/v2/blocks', array( 'title' => 'Signature', 'content' => '<!-- wp:paragraph --><p>Cheers</p><!-- /wp:paragraph -->', 'status' => 'publish' ) );
wp_set_current_user( 0 );
return array( $status, $block['content']['raw'], array_keys( $block['title'] ), guide_rest( 'GET', "/wp/v2/blocks/{$block['id']}" )[0] );
