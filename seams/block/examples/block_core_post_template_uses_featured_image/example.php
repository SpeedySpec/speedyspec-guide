<?php
// Whether blocks include one that shows the featured image, so the Post Template can prime thumbnail caches.
$with = new WP_Block_List( parse_blocks( '<!-- wp:post-title /--><!-- wp:post-featured-image /-->' ) );
$without = new WP_Block_List( parse_blocks( '<!-- wp:post-title /-->' ) );
return array( block_core_post_template_uses_featured_image( $with ), block_core_post_template_uses_featured_image( $without ) );
