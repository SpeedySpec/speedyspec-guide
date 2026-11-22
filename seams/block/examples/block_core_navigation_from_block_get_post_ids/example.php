<?php
// The post IDs of a Navigation Link or Submenu block of kind post-type and of its inner blocks.
$list = new WP_Block_List( parse_blocks( '<!-- wp:navigation-submenu {"id":6,"kind":"post-type","label":"B"} --><!-- wp:navigation-link {"id":7,"kind":"post-type","label":"C"} /--><!-- /wp:navigation-submenu -->' ) );
return block_core_navigation_from_block_get_post_ids( $list[0] );
