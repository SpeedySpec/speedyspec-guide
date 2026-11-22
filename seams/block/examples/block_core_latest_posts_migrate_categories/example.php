<?php
// Hooked to render_block_data: turns an old Latest Posts block's categories string into the newer array of IDs.
$block = array( 'blockName' => 'core/latest-posts', 'attrs' => array( 'categories' => '7' ), 'innerBlocks' => array() );
return block_core_latest_posts_migrate_categories( $block )['attrs']['categories'];
